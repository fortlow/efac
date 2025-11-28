<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\LineBill;
use App\Entity\IntercalBill;
use App\Entity\RefProduct;
use App\Entity\RefService;
use App\Repository\BillRepository;
use App\Repository\LineBillRepository;
use App\Repository\IntercalBillRepository;
use App\Form\BillType;
use App\Service\QrCodeService;
use App\Service\UtilityService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class BillController extends AbstractController
{
    private EntityManagerInterface $_em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->_em = $em;
    }

    #[Route('/bo/bill', name: 'app_bill'), IsGranted('ROLE_SALE')]
    public function index(BillRepository $billRepository): Response
    {
        return $this->render('bill/index.html.twig', [
            'bills' => $billRepository->findBillClientClassic(),
        ]);
    }
    #[Route('/bo/bill/add', name: 'app_bill_add'), IsGranted('ROLE_SALE')]
    public function add(Request $request, UtilityService $utilityService, QrCodeService $qrCodeService): Response
    {
        try {
            $numeroBill = $utilityService->genereNumProformaOrBill();
        } catch (\Exception $e) {
            $numeroBill = date('d') . date('i'). date('s');
        }

        $form = $this->createForm(BillType::class, null, [
            'label' => $numeroBill,
            'translator' => 'create',
            'translation_domain' => '',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $bill = $form->getData();
                $bill->setCreatedAt(new \DateTime('now'));
                $bill->setSubject(mb_strtoupper($bill->getSubject(), 'UTF-8'));
                $typePro = $_POST['bill']['targetpro'];

                $slugCodeSecret = $this->generateUniqueLongCodeSecret();
                $qrCodeService->qrcodeGenerate('bill', $slugCodeSecret);
                $bill->setQrCode($slugCodeSecret.'.png');
                $bill->setSecretCode($slugCodeSecret);

                $this->_em->persist($bill);
                $this->_em->flush();
                $this->addFlash('success', 'Etape 1 de la création de la facture exécutée avec succès.');

                return $this->redirectToRoute('app_bill_add_next', [
                    'id' => $bill->getId(),
                    'mode' => $typePro
                ]);
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de création de la facture.');
                //dump('Exception', $exception->getMessage());
                //die('stop add');
            }
        }

        return $this->render('bill/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/bo/bill/add/next/{id}/{mode}', name: 'app_bill_add_next'), IsGranted('ROLE_SALE')]
    public function addNext(BillRepository $billRepository, int $id, string $mode): Response
    {
        $bill = $billRepository->find($id);
        $produits = $this->_em->getRepository(RefProduct::class)->findAll();
        $services = $this->_em->getRepository(RefService::class)->findAll();

        if (!empty($_POST))
        {
            //dump('_POST', $_POST);

            try {
                $nbLine = intval($_POST['nbline']);
                $mode = intval($_POST['mode']);
                $typeOpe = null;

                for($i=1; $i <= $nbLine; $i++)
                {
                    $ref = $_POST['ref_'.$i];
                    $tRef = explode('-', $ref);

                    if(count($tRef) === 2) {
                        $typeOpe = $tRef[0];
                        $ref = $tRef[1];
                    }

                    //dump('ref', $ref);

                    $lineBill = new LineBill();
                    $lineBill->setBill($bill);
                    $lineBill->setQte(intval($_POST['qte_'.$i]));
                    $lineBill->setUnitPrice($_POST['price_'.$i]);
                    $lineBill->setAmountHt($_POST['mnt_'.$i]);
                    $lineBill->setCreatedAt(new \DateTime('now'));
                    $lineBill->setDesignationCpt($_POST['cplref_'.$i]);

                    if($mode === 1) { // facture sur les produits
                        $tProduit = $this->_em->getRepository(RefProduct::class)->findBy(['reference' => $ref]);
                        if(is_array($tProduit) && count($tProduit) > 0) {
                            $produit = $tProduit[0];
                            $lineBill->setRefProduct($produit);
                            $lineBill->setDesignation($produit->getName());
                        }
                    }
                    elseif($mode === 2) { // proforma ou facture sur les services
                        $tService = $this->_em->getRepository(RefService::class)->findBy(['reference' => $ref]);
                        if(is_array($tService) && count($tService) > 0) {
                            $service = $tService[0];
                            $lineBill->setRefService($service);
                            $lineBill->setDesignation($service->getName());
                        }
                    }
                    else { // proforma ou facture sur les produits et les services

                        if($typeOpe === 'P') { // Produit
                            $tProduit = $this->_em->getRepository(RefProduct::class)->findBy(['reference' => $ref]);

                            if(is_array($tProduit) && count($tProduit) > 0) {
                                $product = $tProduit[0];
                                $lineBill->setRefProduct($product);
                                $lineBill->setDesignation($product->getName());
                                $lineBill->setRefService(null);
                            }

                        } elseif ($typeOpe === 'S') { // Service
                            $tService = $this->_em->getRepository(RefService::class)->findBy(['reference' => $ref]);

                            if(is_array($tService) && count($tService) > 0) {
                                $service = $tService[0];
                                $lineBill->setRefService($service);
                                $lineBill->setDesignation($service->getName());
                                $lineBill->setRefProduct(null);
                            }
                        }
                    }
                    $this->_em->persist($lineBill);
                }

                // Gestion des intercalaires
                for($i=0; $i <= 20; $i++)
                {
                    $intercalVal = $_POST['interval_'. $i];

                    if(strlen($intercalVal) > 0 ) {
                        $intercaBill = new IntercalBill();
                        $intercaBill->setBill($bill);
                        $intercaBill->setNumero($i);
                        $intercaBill->setContent($_POST['interval_'. $i]);
                        $intercaBill->setCreatedAt(new \DateTime('now'));
                        $this->_em->persist($intercaBill);
                    }
                }

                $this->_em->flush();
                $this->addFlash('success', 'Facture créée avec succès.');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de création de la facture.');
                dump('Exception', $exception->getMessage());
                die('stop add next');
            }

            return $this->redirectToRoute('app_bill');
        }

        return $this->render('bill/add-next-step.html.twig', [
            'bill' => $bill,
            'produits' => $produits,
            'services' => $services,
            'mode' => $mode,
        ]);
    }
    #[Route('/bo/bill/edit/{id}', name: 'app_bill_edit'), IsGranted('ROLE_SALE')]
    public function edit(Request $request, BillRepository $billRepository, int $id): Response
    {
        $lineBillRepository = $this->_em->getRepository(LineBill::class);
        $refProductRepository = $this->_em->getRepository(RefProduct::class);
        $refServiceRepository = $this->_em->getRepository(RefService::class);
        //
        $bill = $billRepository->find($id);
        $numeroBill = $bill->getNumero();
        $produits = $refProductRepository->findAll();
        $services = $refServiceRepository->findAll();

        //dump('produits', $produits);
        //dump('services', $services);
        //die('stop');

        // recuperation des lignes de la proforma
        $lineBills = null;
        $nbLines = 0;
        $targetPro = null;

        if(!is_null($bill->getLineBills())) {
            $lineBills = $bill->getLineBills()->toArray();
            $nbLines = count($lineBills);

            foreach ($lineBills as $lineBill) {
                if(!is_null($lineBill->getRefService())) {
                    $targetPro = 2;
                } else { $targetPro = 1; }
                break;
            }
        }
        //dd($targetPro);

        $form = $this->createForm(BillType::class, $bill, [
            'label' => $numeroBill,
            'translator' => 'edit',
            'translation_domain' => $targetPro,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dd($_POST);
            try {
                $bill = $form->getData();
                $bill->setSubject(mb_strtoupper($_POST['bill']['subject'], 'UTF-8'));

                for ($i = 1; $i <= $nbLines; $i++)
                {
                    $idxBill = 'id_' . $i;
                    if (isset($_POST[$idxBill]))
                    {
                        $lineBill = $lineBillRepository->find($_POST[$idxBill]);
                        $tRef = explode('-', $_POST['ref_' . $i]);

                        if (isset($tRef[1]))
                        {
                            $ref = $tRef[1];
                            $prefixRef = $tRef[0];

                            // -----. mise à jour des lignes, produit ou service de la facture  -----
                            $qte = $_POST['qte_' . ($i)];
                            $unitPrice = $_POST['price_' . ($i)];
                            $mntHt = (intval($qte) * intval($unitPrice));
                            $cplref = $_POST['cplref_'.($i)];
                            //
                            $lineBill->setBill($bill);
                            $lineBill->setQte(intval($qte));
                            $lineBill->setUnitPrice($unitPrice);
                            $lineBill->setAmountHt(strval($mntHt));
                            $lineBill->setDesignationCpt($cplref);
                            //
                            if ($prefixRef == 'P') { // produit
                                $tRefReference = $refProductRepository->findBy(['reference' => $ref]);
                                if (is_array($tRefReference) && count($tRefReference) == 1) {
                                    $produit = $tRefReference[0];
                                    $lineBill->setRefProduct($produit);
                                    $lineBill->setRefService(null);
                                    $lineBill->setDesignation($produit->getName());
                                }
                            } else { // service
                                $tRefReference = $refServiceRepository->findBy(['reference' => $ref]);
                                if (is_array($tRefReference) && count($tRefReference) == 1) {
                                    $service = $tRefReference[0];
                                    $lineBill->setRefService($service);
                                    $lineBill->setRefProduct(null);
                                    $lineBill->setDesignation($service->getName());
                                }
                            }
                            // ----- /.mise a jour des lignes produit ou service de la facture  -----
                        }
                    }
                } // end for

                $this->_em->flush();
                $this->addFlash('success', 'Facture modifiée avec succès.');

                return $this->redirectToRoute('app_bill');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de modification de la facture.');
                //dump('Exception', $exception->getMessage());
            }
        }

        return $this->render('bill/edit.html.twig', [
            'form' => $form->createView(),
            'lineBills' => $lineBills,
            'nbLines' => $nbLines,
            'produits' => $produits,
            'services' => $services,
            'mode' => $targetPro,
        ]);
    }
    #[Route('/bo/bill/delete/{id}', name: 'app_bill_delete'), IsGranted('ROLE_MANAGER')]
    public function delete(Request $request, BillRepository $billRepository, LineBillRepository $lineBillRepository,
                           IntercalBillRepository $intercaBillRepository, int $id): Response
    {
        try {
            $bill = $billRepository->find($id);

            if(!is_null($bill) && $bill->getClient()->isIsBlrClient()) $flagBlr = true;

            // suppression des lignes line_bill
            $lineBillRepository->removeLineBillBlrForClient($bill);

            // suppression des lignes intercalaires
            $intercaBillRepository->removeIntercalaireBill($bill);

            // remise en place de la fonction de transformation en facture
            if(!is_null($bill) && !is_null($bill->getProforma())) {
                $proforma = $bill->getProforma();
                $proforma->setFlagTrans(false);
            }

            // suppression de la facture
            $this->_em->remove($bill);

            $this->_em->flush();
            $this->addFlash('success', 'Facture supprimée avec succès.');
        } catch (\Exception $exception) {
            $this->addFlash('danger', 'Echec de suppression de la facture.');
            //dump('Exception', $exception->getMessage());
        }

        // Retour à l'url précédemment visitée
        $previousUrl = $request->headers->get('referer');

        return $this->redirect($previousUrl);
    }
    #[Route('/bo/bill/view/{id}', name: 'app_bill_view_bill'), IsGranted('ROLE_SALE')]
    public function getPdfBill(BillRepository $billRepository, IntercalBillRepository $intercalBillRepository,
                               UtilityService $utileSrv, QrCodeService $qrCodeService, int $id): Response
    {
        setlocale(LC_TIME, 'fr_FR');
        date_default_timezone_set('Europe/Paris');

        $bill = $billRepository->find($id);
        $intercalaires = $intercalBillRepository->findBy(['bill' => $bill]);
        $client = (!is_null($bill))?$bill->getClient():null;
        $lineBills = (!is_null($bill))?$bill->getLineBills()->toArray():null;

        $tabNumInterca = [];
        $tabContentInterca = [];
        if(count($intercalaires) > 0) {
            foreach ($intercalaires as $intercalaire) {
                $tabNumInterca[] = $intercalaire->getNumero();
                $tabContentInterca[$intercalaire->getNumero()] = $intercalaire->getContent();
            }
        }

        if(!is_null($bill) && !is_null($client) && !is_null($lineBills))
        {
            if (
                (is_null($bill->getQrCode()) && is_null($bill->getSecretCode())) ||
                (strlen($bill->getQrCode()) == 0 && strlen($bill->getSecretCode()) == 0)
            ) {
                $slugCodeSecret = $this->generateUniqueLongCodeSecret();
                $qrCodeService->qrcodeGenerate('bill', $slugCodeSecret);
                $bill->setQrCode($slugCodeSecret . '.png');
                $bill->setSecretCode($slugCodeSecret);
                $this->_em->flush($bill);
            }

            $typeOpe = 'produit';
            foreach ($lineBills as $line) {
                if(is_null($line->getRefProduct())) {
                    $typeOpe = 'service';
                }
            }
            // Configuration de Dompdf
            $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Courier');
            $pdfOptions->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($pdfOptions);
            $data = [
                'logoB2m'  => $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/pdf/logob.png'),
                'qrCode' => $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/qr-code/' . $bill->getQrCode()),
                'bill' => $bill,
                'intercalaires' => $tabContentInterca,
                'numeroInterca' => $tabNumInterca,
                'client' => $client,
                'lineBills' => $lineBills,
                'typeOpe'  => $typeOpe,
            ];

            $template = $this->renderView('pdf/bill.html.twig', $data);
            $dompdf->loadHtml($template); // Chargement du HTML dans Dompdf
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render(); // Rendre le HTML au format PDF
            $filenamePdf = $_ENV['DIR_PDF_PRO']. '/bill_' . $id . '.pdf'; // Exporter le PDF généré vers le navigateur
            //
            $fontMetrics = $dompdf->getFontMetrics();
            $font = $fontMetrics->getFont('helvetica', '9');

            /*$textOneFooter = 'B2M TECHNOLOGIES - SARL au Capital Social de 5 000 000 FCFA – 100 Rue Gaston Rapotchombo, Quartier Louis, Libreville - Gabon';
            $textTwoFooter = 'Tel: +241 011 73 49 49 / +241 076 23 39 75 - Nº RCCM: GA LBV-01-2022-B12-00140 - Nº NIF: 202201003877-K';
            $textThreeFooter = 'Compte bancaire : UBA Boulevard Libreville - 40025  05811  81101100245  53 / Nº CNSS : 018-0213523-K - Nº CNAMGS : 072-100-030-639';

            $canvas = $dompdf->getCanvas();
            $canvas->page_text(75, 780, $textOneFooter, $font, 8, [0,0,0]);
            $canvas->page_text(100, 791, $textTwoFooter, $font, 8, [0,0,0]);
            $canvas->page_text(68, 802, $textThreeFooter, $font, 8, [0,0,0]);
            $canvas->page_text(270, 817, "{PAGE_NUM} / {PAGE_COUNT}", $font, 9, [0,0,0]);*/

            $textOneFooter = $_ENV['APP_FOOTER_PDF_ONE'];
            $textTwoFooter = $_ENV['APP_FOOTER_PDF_TWO'];

            $canvas = $dompdf->getCanvas();
            $canvas->page_text(270, 817, '{PAGE_NUM} / {PAGE_COUNT}', $font, 9, [0,0,0]);

            $dompdf->stream($filenamePdf, ['Attachment' => false]);

            return new Response(
                $filenamePdf,
                Response::HTTP_OK,
                ['content-type' => 'application/pdf']
            );
        }

        return new Response(
            'Erreur de génération du PDF!',
            Response::HTTP_NOT_FOUND,
            ['content-type' => 'text/plain']
        );
    }
    #[Route('/bo/bill/view/test/{id}', name: 'app_bill_view_bill_test'), IsGranted('ROLE_MANAGER')]
    public function getPdfBillTest(BillRepository $billRepository, IntercalBillRepository $intercalBillRepository,
                                   UtilityService $utileSrv, QrCodeService $qrCodeService, int $id): Response
    {
        setlocale(LC_TIME, 'fr_FR');
        date_default_timezone_set('Europe/Paris');

        $typeOpe = null;
        $bill = $billRepository->find($id);

        $intercalaires = $intercalBillRepository->findBy(['bill' => $bill]);
        $client = (!is_null($bill))?$bill->getClient():null;
        $lineBills = (!is_null($bill))?$bill->getLineBills()->toArray():null;

        $tabNumInterca = [];
        $tabContentInterca = [];
        if(count($intercalaires) > 0) {
            foreach ($intercalaires as $intercalaire) {
                $tabNumInterca[] = $intercalaire->getNumero();
                $tabContentInterca[$intercalaire->getNumero()] = $intercalaire->getContent();
            }
        }

        if(!is_null($bill) && !is_null($client) && !is_null($lineBills))
        {
            if (
                (is_null($bill->getQrCode()) && is_null($bill->getSecretCode())) ||
                (strlen($bill->getQrCode()) == 0 && strlen($bill->getSecretCode()) == 0)
            ) {
                $slugCodeSecret = $this->generateUniqueLongCodeSecret();
                $qrCodeService->qrcodeGenerate('bill', $slugCodeSecret);
                $bill->setQrCode($slugCodeSecret . '.png');
                $bill->setSecretCode($slugCodeSecret);
                $this->_em->flush($bill);
            }

            $typeOpe = 'produit';
            foreach ($lineBills as $line) {
                if(is_null($line->getRefProduct())) {
                    $typeOpe = 'service';
                }
            }
        }

        return $this->render('pdf/bill-test.html.twig', [
            'logoB2m'  => $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/pdf/logo.png'),
            'qrCode' => $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/qr-code/' . $bill->getQrCode()),
            'bill' => $bill,
            'intercalaires' => $tabContentInterca,
            'numeroInterca' => $tabNumInterca,
            'client' => $client,
            'lineBills' => $lineBills,
            'typeOpe'  => $typeOpe,
            'textOneFooter' => $_ENV['APP_FOOTER_PDF_ONE'],
            'textTwoFooter' => $_ENV['APP_FOOTER_PDF_TWO'],
        ]);

    }
    #[Route('/bo/bill/send/{id}', name: 'app_bill_send_bill'), IsGranted('ROLE_MANAGER')]
    public function sendPdfBill(BillRepository $billRepository, IntercalBillRepository $intercalBillRepository,
                                UtilityService $utileSrv, MailerInterface $mailer, int $id): Response
    {
        setlocale(LC_TIME, 'fr_FR');
        date_default_timezone_set('Europe/Paris');

        $bill = $billRepository->find($id);
        $intercalaires = $intercalBillRepository->findBy(['bill' => $bill]);
        $client = (!is_null($bill))?$bill->getClient():null;
        $lineBills = (!is_null($bill))?$bill->getLineBills()->toArray():null;

        $tabNumInterca = [];
        $tabContentInterca = [];
        if(count($intercalaires) > 0) {
            foreach ($intercalaires as $intercalaire) {
                $tabNumInterca[] = $intercalaire->getNumero();
                $tabContentInterca[$intercalaire->getNumero()] = $intercalaire->getContent();
            }
        }

        if(!is_null($bill) && !is_null($client) && !is_null($lineBills))
        {
            $typeOpe = 'produit';
            foreach ($lineBills as $line) {
                if(is_null($line->getRefProduct())) {
                    $typeOpe = 'service';
                }
            }
            // Configuration de Dompdf
            $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Courier');
            $pdfOptions->set('isRemoteEnabled', true);

            $dompdf = new Dompdf($pdfOptions);
            $data = [
                'logoB2m'  => $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/pdf/logo.png'),
                'qrCode' => $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/qr-code/' . $bill->getQrCode()),
                'bill' => $bill,
                'intercalaires' => $tabContentInterca,
                'numeroInterca' => $tabNumInterca,
                'client' => $client,
                'lineBills' => $lineBills,
                'typeOpe'  => $typeOpe,
            ];

            $template = $this->renderView('pdf/bill.html.twig', $data);
            $dompdf->loadHtml($template); // Chargement du HTML dans Dompdf
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render(); // Rendre le HTML au format PDF
            //
            $fontMetrics = $dompdf->getFontMetrics();
            $font = $fontMetrics->getFont('helvetica', '9');

            $textOneFooter = $_ENV['APP_FOOTER_PDF_ONE'];
            $textTwoFooter = $_ENV['APP_FOOTER_PDF_TWO'];

            $canvas = $dompdf->getCanvas();
            $canvas->page_text(75, 791, $textOneFooter, $font, 8, [0,0,0]);
            $canvas->page_text(100, 802, $textTwoFooter, $font, 8, [0,0,0]);
            $canvas->page_text(270, 817, '{PAGE_NUM} / {PAGE_COUNT}', $font, 9, [0,0,0]);

            $pdfOutput = $dompdf->output(); // Récupérer le contenu PDF

            // Créer l'email
            if ($client->getEmail()) {
                $email = (new TemplatedEmail())
                    ->from($_ENV['APP_MAIL_FROM'])
                    ->to($client->getEmail())
                    ->subject('[eFac] - Votre Facture')
                    ->htmlTemplate('emails/mail-send-bill-pdf.html')
                    ->context([
                        'nom' => $client->getSreason(),
                        'proforma' => $bill,
                        'subject' => 'Votre facture : '. $bill->getSubject(),
                        'bill' => $bill,
                    ])
                    ->attach($pdfOutput, 'Facture-' . $bill->getNumero() .'.pdf', 'application/pdf');
                // Accusé de réception
                $email->getHeaders()
                    ->addTextHeader('Return-Receipt-To', $_ENV['APP_MAIL_FROM'])
                    ->addTextHeader('Disposition-Notification-To', $_ENV['APP_MAIL_FROM']);

                // Envoyer l'email
                try {
                    $mailer->send($email);
                    $this->addFlash('success', 'Email envoyé avec succès.');
                } catch (TransportExceptionInterface $e) {
                    $this->addFlash('danger', 'Echec d\'envoi du mail au client!');
                }
            } else {
                $this->addFlash('danger', 'Impossible de récupérer l\'adresse mail du client!');
            }
        } else $this->addFlash('danger', 'Erreur de génération du PDF!');

        return $this->redirectToRoute('app_bill');
    }

    public function generateUniqueLongCodeSecret(): string
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}