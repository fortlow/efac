<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Proforma;
use App\Entity\Client;
use App\Entity\LineProforma;
use App\Entity\IntercalProforma;
use App\Entity\RefProduct;
use App\Entity\RefService;
use App\Entity\RefStatusProforma;
use App\Repository\ProformaRepository;
use App\Repository\LineProformaRepository;
use App\Repository\IntercalProformaRepository;
use App\Form\ProformaType;
use App\Service\QrCodeService;
use App\Service\UtilityService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;
/*use Symfony\Component\Security\Http\Attribute\IsGranted;*/

class ProformaController extends AbstractController
{
    private EntityManagerInterface $_em;
    private UtilityService $_utilityService;
    private QrCodeService $_qrCodeService;

    /**
     * @param EntityManagerInterface $em
     * @param UtilityService $utileSrv
     * @param QrCodeService $qrCodeService
     */
    public function __construct(EntityManagerInterface $em, UtilityService $utileSrv, QrCodeService $qrCodeService)
    {
        $this->_em = $em;
        $this->_utilityService = $utileSrv;
        $this->_qrCodeService = $qrCodeService;
    }
    #[Route('/bo/proforma', name: 'app_proforma')/*, IsGranted('ROLE_SALE')*/]
    public function index(ProformaRepository $proformaRepository): Response
    {
        return $this->render('proforma/index.html.twig', [
            'proformas' => $proformaRepository->findAll(),
        ]);
    }
    #[Route('/bo/proforma/add', name: 'app_proforma_add')/*, IsGranted('ROLE_SALE')*/]
    public function add(Request $request): Response
    {
        try {
            $numeroProforma = $this->_utilityService->genereNumProformaOrBill();
        } catch (\Exception $e) { $numeroProforma = null; }

        $form = $this->createForm(ProformaType::class, null, [
            'label' => $numeroProforma,
            'translator' => 'create',
            'translation_domain' => '',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $proforma = $form->getData();
                $proforma->setSubject(mb_strtoupper($proforma->getSubject(), 'UTF-8'));
                $proforma->setCreatedAt(new \DateTime('now'));
                $typePro = $_POST['proforma']['targetpro'];

                $slugCodeSecret = $this->generateUniqueLongCodeSecret();
                $this->_qrCodeService->qrcodeGenerate('proforma', $slugCodeSecret);
                $proforma->setQrCode($slugCodeSecret.'.png');
                $proforma->setSecretCode($slugCodeSecret);
                $proforma->setStatus($this->_em->getRepository(RefStatusProforma::class)->find(2));

                $this->_em->persist($proforma);
                $this->_em->flush();
                $this->addFlash('success', 'Etape 1 de la création de la proforma exécutée avec succès.');

                return $this->redirectToRoute('app_proforma_add_next', [
                    'id' => $proforma->getId(),
                    'mode' => $typePro
                ]);
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de création de la proforma.');
            }
        }

        return $this->render('proforma/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/bo/proforma/add/next/{id}/{mode}', name: 'app_proforma_add_next')/*, IsGranted('ROLE_SALE')*/]
    public function addNext(ProformaRepository $proformaRepository, int $id, string $mode): Response
    {
        $proforma = $proformaRepository->find($id);
        $produits = $this->_em->getRepository(RefProduct::class)->findAll();
        $services = $this->_em->getRepository(RefService::class)->findAll();

        if (!empty($_POST)) {
            try {
                //dump('_post', $_POST);
                //die('stop');

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

                    $lineProforma = new LineProforma();
                    $lineProforma->setProforma($proforma);
                    $lineProforma->setQte(intval($_POST['qte_'.$i]));
                    $lineProforma->setUnitPrice($_POST['price_'.$i]);
                    $lineProforma->setAmountHt($_POST['mnt_'.$i]);
                    $lineProforma->setCreatedAt(new \DateTime('now'));
                    $lineProforma->setDesignationCpt($_POST['cplref_'.$i]);

                    if($mode === 1) { // proforma sur les produits
                        $tProduit = $this->_em->getRepository(RefProduct::class)->findBy(['reference' => $ref]);
                        if(is_array($tProduit) && count($tProduit) > 0) {
                            $produit = $tProduit[0];
                            $lineProforma->setRefProduct($produit);
                            $lineProforma->setDesignation($produit->getName());
                        }
                    }
                    elseif($mode === 2) { // proforma sur les services
                        $tService = $this->_em->getRepository(RefService::class)->findBy(['reference' => $ref]);
                        if(is_array($tService) && count($tService) > 0) {
                            $service = $tService[0];
                            $lineProforma->setRefService($service);
                            $lineProforma->setDesignation($service->getName());
                        }
                    }
                    else { // proforma sur les produits et services
                        if($typeOpe === 'P') { // Produit
                            $tProduit = $this->_em->getRepository(RefProduct::class)->findBy(['reference' => $ref]);

                            if(is_array($tProduit) && count($tProduit) > 0) {
                                $product = $tProduit[0];
                                $lineProforma->setRefProduct($product);
                                $lineProforma->setDesignation($product->getName());
                                $lineProforma->setRefService(null);
                            }

                        } elseif ($typeOpe === 'S') { // Service
                            $tService = $this->_em->getRepository(RefService::class)->findBy(['reference' => $ref]);

                            if(is_array($tService) && count($tService) > 0) {
                                $service = $tService[0];
                                $lineProforma->setRefService($service);
                                $lineProforma->setDesignation($service->getName());
                                $lineProforma->setRefProduct(null);
                            }
                        }
                    }

                    $this->_em->persist($lineProforma);
                }

                // Gestion des intercalaires
                for($i=0; $i <= 20; $i++)
                {
                    $intercalVal = $_POST['interval_'. $i];

                    if(strlen($intercalVal) > 0 ) {
                        $intercaProforma = new IntercalProforma();
                        $intercaProforma->setProforma($proforma);
                        $intercaProforma->setNumero($i);
                        $intercaProforma->setContent($_POST['interval_'. $i]);
                        $intercaProforma->setCreatedAt(new \DateTime('now'));
                        $this->_em->persist($intercaProforma);
                    }
                }

                $this->_em->flush();
                $this->addFlash('success', 'Proforma créée avec succès.');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de création de la proforma.');
            }

            return $this->redirectToRoute('app_proforma');
        }

        return $this->render('proforma/add-next-step.html.twig', [
            'proforma' => $proforma,
            'produits' => $produits,
            'services' => $services,
            'mode' => $mode,
            'idproforma' => $id,
        ]);
    }
    #[Route('/bo/proforma/edit/{id}', name: 'app_proforma_edit')/*, IsGranted('ROLE_SALE')*/]
    public function edit(Request $request, int $id): Response
    {
        $proforma = $this->_em->getRepository(Proforma::class)->find($id);
        $refServiceRepository= $this->_em->getRepository(RefService::class);
        $refProductRepository = $this->_em->getRepository(RefProduct::class);
        $lineProformaRepository = $this->_em->getRepository(LineProforma::class);

        $numeroProforma = $proforma->getNumero();
        $produits = $refProductRepository->findAll();
        $services = $refServiceRepository->findAll();

        if(!is_null($proforma->getStatus()) && $proforma->getStatus()->getId() >= 3) {
            $this->addFlash('danger', 'Pro Forma validée ou refusée. Elle ne peut donc pas être modifiée.');
            return $this->redirectToRoute('app_proforma');
        }

        // recuperation des lignes de la proforma
        $lineProformas = null;
        $nbLines = 0;
        $targetPro = null;

        if(!is_null($proforma->getLineProformas())) {
            $lineProformas = $proforma->getLineProformas()->toArray();
            $nbLines = count($lineProformas);

            foreach ($lineProformas as $lineProforma) {
                if(!is_null($lineProforma->getRefService())) {
                    $targetPro = 2;
                } else {
                    $targetPro = 1;
                }
                break;
            }
        }

        $form = $this->createForm(ProformaType::class, $proforma, [
            'label' => $numeroProforma,
            'translator' => 'edit',
            'translation_domain' => $targetPro,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $proforma = $form->getData();
                $proforma->setSubject(mb_strtoupper($_POST['proforma']['subject'], 'UTF-8'));

                for($i=1; $i <= $nbLines; $i++)
                {
                    $idxProforma = 'id_'.$i;
                    if(isset($_POST[$idxProforma]))
                    {
                        $lineProforma = $lineProformaRepository->find($_POST[$idxProforma]);
                        $tRef = explode('-', $_POST['ref_'.$i]);

                        if(isset($tRef[1]))
                        {
                            $ref = $tRef[1];
                            $prefixRef = $tRef[0];

                            // ----- mise à jour des lignes de produit ou service de la proforma  -----
                            $qte = $_POST['qte_'.($i)];
                            $unitPrice = $_POST['price_'.($i)];
                            $mntHt = (intval($qte) * intval($unitPrice));
                            $cplref = $_POST['cplref_'.($i)];
                            //
                            $lineProforma->setProforma($proforma);
                            $lineProforma->setQte(intval($qte));
                            $lineProforma->setUnitPrice($unitPrice);
                            $lineProforma->setAmountHt(strval($mntHt));
                            $lineProforma->setDesignationCpt($cplref);
                            //
                            if($prefixRef == 'P') { // produit
                                $tRefReference = $refProductRepository->findBy(['reference' => $ref]);
                                if(is_array($tRefReference) && count($tRefReference) == 1) {
                                    $produit = $tRefReference[0];
                                    $lineProforma->setRefProduct($produit);
                                    $lineProforma->setRefService(null);
                                    $lineProforma->setDesignation($produit->getName());
                                }
                            } else { // service
                                $tRefReference = $refServiceRepository->findBy(['reference' => $ref]);
                                if(is_array($tRefReference) && count($tRefReference) == 1) {
                                    $service = $tRefReference[0];
                                    $lineProforma->setRefService($service);
                                    $lineProforma->setRefProduct(null);
                                    $lineProforma->setDesignation($service->getName());
                                }
                            }
                            // ----- /.mise a jour des lignes produit ou service de la proforma  -----
                        }
                    } // end if isset
                } // end for

                $this->_em->flush();
                $this->addFlash('success', 'Proforma modifiée avec succès.');

                return $this->redirectToRoute('app_proforma');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de modification de la proforma.');
                //dump('Exception', $exception->getMessage());
            }
        }

        return $this->render('proforma/edit.html.twig', [
            'form' => $form->createView(),
            'lineProformas' => $lineProformas,
            'nbLines' => $nbLines,
            'produits' => $produits,
            'services' => $services,
        ]);
    }
    #[Route('/bo/proforma/delete/{id}', name: 'app_proforma_delete')/*, IsGranted('ROLE_MANAGER')*/]
    public function delete(ProformaRepository $proformaRepository,
                           LineProformaRepository $lineProformaRepository,
                           IntercalProformaRepository $intercalProformaRepository, int $id): Response
    {
        try {
            $proforma = $proformaRepository->find($id);

            // suppression line_proforma
            $lineProformaRepository->removeLineProforma($proforma);

            // suppression intercalaires
            $intercalProformaRepository->removeIntercalProforma($proforma);

            // suppression de la proforma
            $this->_em->remove($proforma);

            $this->_em->flush();
            $this->addFlash('success', 'Proforma supprimée avec succès.');
        } catch (\Exception $exception) {
            $this->addFlash('danger', 'Echec de suppression de la proforma.');
            //dump('Exception', $exception->getMessage());
        }

        return $this->redirectToRoute('app_proforma');
    }
    #[Route('/bo/proforma/transform/to/bill/{id}', name: 'app_proforma_transform_to_bill')/*, IsGranted('ROLE_SALE')*/]
    public function transformToBill(ProformaRepository $proformaRepository, UtilityService $utilityService,int $id): Response
    {
        try {
            $proforma = $proformaRepository->find($id);
            $statusValidProforma = $this->_em->getRepository(RefStatusProforma::class)->find(3);

            if($utilityService->proformaToBillTransformer($proforma)) {
                $proforma->setFlagTrans(true);;
                $proforma->setStatus($statusValidProforma);
                $this->_em->flush();
                $this->addFlash('success', 'Proforma transformée en facture avec succès.');
            } else {
                $this->addFlash('danger', 'Échec de transformation de la Proforma en Facture.');
            }
        } catch (\Exception $e) {
            dump('Exception->transformToBill : '. $e->getMessage());
        }

        return $this->redirectToRoute('app_bill');
    }
    #[Route('/bo/proforma/view/{id}', name: 'app_proforma_view_proforma')/*, IsGranted('ROLE_SALE')*/]
    public function getPdfProforma(ProformaRepository $proformaRepository,
                                   IntercalProformaRepository $intercalProformaRepository, int $id): Response
    {
        setlocale(LC_TIME, 'fr_FR');
        date_default_timezone_set('Europe/Paris');
        ob_start();

        $proforma = $proformaRepository->find($id);
        $intercalaires = $intercalProformaRepository->findBy(['proforma' => $proforma]);

        $tabNumInterca = [];
        $tabContentInterca = [];
        if(count($intercalaires) > 0) {
            foreach ($intercalaires as $intercalaire) {
                $tabNumInterca[] = $intercalaire->getNumero();
                $tabContentInterca[$intercalaire->getNumero()] = $intercalaire->getContent();
            }
        }

        $client = (!is_null($proforma))?$proforma->getClient():null;
        $lineProformas = (!is_null($proforma))?$proforma->getLineProformas()->toArray():null;

        if(!is_null($proforma) && !is_null($client) && !is_null($lineProformas))
        {
            if (
                (is_null($proforma->getQrCode()) && is_null($proforma->getSecretCode())) ||
                (strlen($proforma->getQrCode()) == 0 && strlen($proforma->getSecretCode()) == 0)
            ) {
                $slugCodeSecret = $this->generateUniqueLongCodeSecret();
                $this->_qrCodeService->qrcodeGenerate('proforma', $slugCodeSecret);
                $proforma->setQrCode($slugCodeSecret.'.png');
                $proforma->setSecretCode($slugCodeSecret);
                $this->_em->flush($proforma);
            }

            $dompdf = $this->getDompdfProforma($lineProformas, $proforma, $tabContentInterca, $tabNumInterca, $client); // Rendre le HTML au format PDF
            $filenamePdf = $_ENV['DIR_PDF_PRO']. '/proforma_' . $id . '.pdf'; // Exporter le PDF généré vers le navigateur
            //dump($dompdf);
            //die('stop');
            //
            $fontMetrics = $dompdf->getFontMetrics();
            $font = $fontMetrics->getFont('helvetica', '9');

            $textOneFooter = $_ENV['APP_FOOTER_PDF_ONE'];
            $textTwoFooter = $_ENV['APP_FOOTER_PDF_TWO'];
            //$textThreeFooter = 'Compte bancaire : UBA Boulevard Libreville - 40025  05811  81101100245  53 / Nº CNSS : 018-0213523-K - Nº CNAMGS : 072-100-030-639';

            $canvas = $dompdf->getCanvas();
            //$canvas->page_text(75, 791, $textOneFooter, $font, 8, [0,0,0]);
            //$canvas->page_text(100, 802, $textTwoFooter, $font, 8, [0,0,0]);
            //$canvas->page_text(68, 802, $textThreeFooter, $font, 8, [0,0,0]);
            $canvas->page_text(270, 817, '{PAGE_NUM} / {PAGE_COUNT}', $font, 9, [0,0,0]);

            ob_end_clean();
            $dompdf->stream($filenamePdf, ['Attachment' => false]);
            //$dompdf->render();

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
    #[Route('/bo/proforma/view/proforma/test/{id}', name: 'app_proforma_view_proforma_test')/*, IsGranted('ROLE_SALE')*/]
    public function getPdfProformaTest(ProformaRepository $proformaRepository,
                                       IntercalProformaRepository $intercalProformaRepository,
                                       UtilityService $utileSrv, int $id): Response
    {
        setlocale(LC_TIME, 'fr_FR');
        date_default_timezone_set('Europe/Paris');
        ob_start();

        $proforma = $proformaRepository->find($id);
        $intercalaires = $intercalProformaRepository->findBy(['proforma' => $proforma]);

        $tabNumInterca = [];
        $tabContentInterca = [];
        if(count($intercalaires) > 0) {
            foreach ($intercalaires as $intercalaire) {
                $tabNumInterca[] = $intercalaire->getNumero();
                $tabContentInterca[$intercalaire->getNumero()] = $intercalaire->getContent();
            }
        }

        $client = (!is_null($proforma))?$proforma->getClient():null;
        $lineProformas = (!is_null($proforma))?$proforma->getLineProformas()->toArray():null;

        $typeOpe = 'produit';
        foreach ($lineProformas as $line) {
            if (is_null($line->getRefProduct())) {
                $typeOpe = 'service';
            }
        }

        if(!is_null($proforma) && !is_null($client) && !is_null($lineProformas))
        {
            if (
                (is_null($proforma->getQrCode()) && is_null($proforma->getSecretCode())) ||
                (strlen($proforma->getQrCode()) == 0 && strlen($proforma->getSecretCode()) == 0)
            ) {
                $slugCodeSecret = $this->generateUniqueLongCodeSecret();
                $this->_qrCodeService->qrcodeGenerate('proforma', $slugCodeSecret);
                $proforma->setQrCode($slugCodeSecret.'.png');
                $proforma->setSecretCode($slugCodeSecret);
                $this->_em->flush($proforma);
            }
        }

        $textOneFooter = $_ENV['APP_FOOTER_PDF_ONE'];
        $textTwoFooter = $_ENV['APP_FOOTER_PDF_TWO'];

        return $this->render('admin/pdf/proforma-test.html.twig', [
            'logoB2m' => $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/pdf/logob.png'),
            'qrCode' => $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/qr-code/' . $proforma->getQrCode()),
            'proforma' => $proforma,
            'intercalaires' => $tabContentInterca,
            'numeroInterca' => $tabNumInterca,
            'client' => $client,
            'lineProformas' => $lineProformas,
            'typeOpe' => $typeOpe,
            'textOneFooter' => $textOneFooter,
            'textTwoFooter' => $textTwoFooter,
            //'textThreeFooter' => $textThreeFooter,
        ]);
    }
    #[Route('/bo/proforma/send/proforma/{id}', name: 'app_proforma_send_proforma')/*, IsGranted('ROLE_SALE')*/]
    public function sendPdfProforma(ProformaRepository $proformaRepository,
                                    IntercalProformaRepository $intercalProformaRepository, MailerInterface $mailer,
                                    int $id): Response
    {
        try {
            setlocale(LC_TIME, 'fr_FR');
            date_default_timezone_set('Europe/Paris');

            $proforma = $proformaRepository->find($id);
            $intercalaires = $intercalProformaRepository->findBy(['proforma' => $proforma]);

            $tabNumInterca = [];
            $tabContentInterca = [];
            if(count($intercalaires) > 0) {
                foreach ($intercalaires as $intercalaire) {
                    $tabNumInterca[] = $intercalaire->getNumero();
                    $tabContentInterca[$intercalaire->getNumero()] = $intercalaire->getContent();
                }
            }

            $client = (!is_null($proforma))?$proforma->getClient():null;
            $lineProformas = (!is_null($proforma))?$proforma->getLineProformas()->toArray():null;
            //dd($client->getUser());

            if(!is_null($proforma) && !is_null($client) && !is_null($lineProformas))
            {
                $dompdf = $this->getDompdfProforma($lineProformas, $proforma, $tabContentInterca, $tabNumInterca, $client); // Rendre le HTML au format PDF

                $fontMetrics = $dompdf->getFontMetrics();
                $font = $fontMetrics->getFont('helvetica', '9');

                $textOneFooter = $_ENV['APP_FOOTER_PDF_ONE'];
                $textTwoFooter = $_ENV['APP_FOOTER_PDF_TWO'];

                $canvas = $dompdf->getCanvas();
                $canvas->page_text(75, 791, $textOneFooter, $font, 8, [0,0,0]);
                $canvas->page_text(100, 802, $textTwoFooter, $font, 8, [0,0,0]);
                //$canvas->page_text(68, 802, $textThreeFooter, $font, 8, array(0,0,0));
                $canvas->page_text(270, 817, '{PAGE_NUM} / {PAGE_COUNT}', $font, 9, [0,0,0]);
                $pdfOutput = $dompdf->output(); // Récupérer le contenu PDF

                // Créer l'email
                if ($client->getEmail()) {
                    $email = (new TemplatedEmail())
                        ->from($_ENV['APP_MAIL_FROM'])
                        ->to($client->getEmail())
                        ->subject('['. $_ENV['APP_NAME_COMPANY'] .'] - Votre Proforma: '. $proforma->getSubject())
                        ->htmlTemplate('emails/mail-send-pdf.html')
                        ->context([
                            'nom' => $client->getSreason(),
                            'proforma' => $proforma,
                            'subject' => 'Votre proforma : '. $proforma->getSubject(),
                        ])
                        ->attach($pdfOutput, 'Proforma-'. $proforma->getNumero() .'.pdf', 'application/pdf');
                    // Accusé de réception
                    $email->getHeaders()
                        ->addTextHeader('Return-Receipt-To', $_ENV['APP_MAIL_FROM'])
                        ->addTextHeader('Disposition-Notification-To', $_ENV['APP_MAIL_FROM']);

                    // Envoyer l'email
                    $mailer->send($email);
                    $statusProforma = $this->_em->getRepository(RefStatusProforma::class)->find(1);
                    $proforma->setStatus($statusProforma);
                    $this->_em->flush();
                    $this->addFlash('success', 'Email envoyé avec succès.');

                } else $this->addFlash('danger', 'Impossible de récupérer l\'adresse mail du client!');
            } else $this->addFlash('danger', 'Erreur de génération du PDF!');

        } catch (\Exception|TransportExceptionInterface $e) {
            dump('Exception->sendPdfProforma', $e->getMessage());
        }

        return $this->redirectToRoute('app_proforma');
    }
    /**
     * @param array $lineProformas
     * @param Proforma $proforma
     * @param array $tabContentInterca
     * @param array $tabNumInterca
     * @param Client $client
     * @return Dompdf
     */
    public function getDompdfProforma(array $lineProformas, Proforma $proforma, array $tabContentInterca,
                                      array $tabNumInterca, Client $client): Dompdf
    {
        $typeOpe = 'produit';
        foreach ($lineProformas as $line) {
            if (is_null($line->getRefProduct())) {
                $typeOpe = 'service';
            }
        }
        // Configuration de Dompdf
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Courier');
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($pdfOptions);
        $data = [
            'logoB2m' => $this->_utilityService->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/pdf/logo.png'),
            'qrCode' => $this->_utilityService->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/qr-code/' . $proforma->getQrCode()),
            'proforma' => $proforma,
            'intercalaires' => $tabContentInterca,
            'numeroInterca' => $tabNumInterca,
            'client' => $client,
            'lineProformas' => $lineProformas,
            'typeOpe' => $typeOpe,
        ];

        $template = $this->renderView('pdf/proforma.html.twig', $data);
        $dompdf->loadHtml($template); // Chargement du HTML dans Dompdf
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf;
    }
    public function generateUniqueLongCodeSecret(): string
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    #[Route('/bo/proforma/line/delete', name: 'app_proforma_delete_line')]
    public function deleteLineProforma(Request $request, LineProformaRepository $lineProformaRepository): JsonResponse
    {
        try {
            $idLine = $request->get('id');
            $lineProforma = $lineProformaRepository->find(intval($idLine));
            $this->_em->remove($lineProforma);
            $this->_em->flush();

            return $this->json(true);

        } catch (\Exception $e) {
            dump('Exception deleteLineProforma', $e->getMessage());
            return $this->json(false);
        }

    }
}
