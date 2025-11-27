<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Proforma;
use App\Entity\Bill;
use App\Entity\LineBill;
use App\Entity\IntercalBill;
use App\Entity\RefStatusBill;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

class UtilityService
{
    private EntityManagerInterface $_em;
    private MailerInterface $_mailer;
    private QrCodeService $_qrCodeService;

    /**
     * @param EntityManagerInterface $em
     * @param MailerInterface $mailer
     * @param QrCodeService $qrCodeService
     */
    public function __construct(EntityManagerInterface $em, MailerInterface $mailer, QrCodeService $qrCodeService)
    {
        $this->_em = $em;
        $this->_mailer = $mailer;
        $this->_qrCodeService = $qrCodeService;
    }

    /**
     * @param Proforma $proforma
     * @return true|false
     */
    public function proformaToBillTransformer(Proforma $proforma): bool
    {
        try {
            $bill = new Bill();
            $bill->setClient($proforma->getClient());
            $bill->setNumero($this->genereNumProformaOrBill());
            $bill->setTc1Base($proforma->getTc1Base());
            $bill->setCssBase($proforma->getCssBase());
            $bill->setTc1Taux($proforma->getTc1Taux());
            $bill->setCssTaux($proforma->getCssTaux());
            $bill->setTc1Amount($proforma->getTc1Amount());
            $bill->setCssAmount($proforma->getCssAmount());
            $bill->setTotHt($proforma->getTotHt());
            $bill->setTvaCssAmount($proforma->getTvaCssAmount());
            $bill->setTotTtc($proforma->getTotTtc());
            $bill->setDeposit($proforma->getDeposit());
            $bill->setNetPayable($proforma->getNetPayable());

            $slugCodeSecret = $this->generateUniqueLongFileName();
            $this->_qrCodeService->qrcodeGenerate('bill', $slugCodeSecret);
            $bill->setQrCode($slugCodeSecret.'.png');
            $bill->setSecretCode($slugCodeSecret);
            $bill->setProforma($proforma);

            // date echeance et de creation de la facture
            $dtDue = new \DateTime('now');
            $interval = new \DateInterval('P30D'); // echeance a 30 jours
            $dtDue->add($interval);
            //
            $bill->setDueDate($dtDue);
            $bill->setCreatedAt(new \DateTime('now'));

            // lignes de la facture
            foreach ($proforma->getLineProformas() as $lineProforma) {
                dump('lineProforma', $lineProforma);

                $lineBill = new LineBill();
                $lineBill->setBill($bill);
                $lineBill->setRefService($lineProforma->getRefService());
                $lineBill->setRefProduct($lineProforma->getRefProduct());
                $lineBill->setDesignation($lineProforma->getDesignation());
                $lineBill->setQte($lineProforma->getQte());
                $lineBill->setUnitPrice($lineProforma->getUnitPrice());
                $lineBill->setAmountHt($lineProforma->getAmountHt());
                $lineBill->setCreatedAt(new \DateTime('now'));

                dump('prctDiscount : ', $proforma->getPrctDiscount());

                // Calcul du montant de reduction si reduction
                if(!is_null($proforma->getPrctDiscount())) {
                    $mntProdOrService = ( intval($lineProforma->getUnitPrice()) * intval($lineProforma->getQte()) );
                    $mntDiscountProdOrService = ( ($mntProdOrService * intval($proforma->getPrctDiscount())) / 100);

                    dump('mntProdOrService', $mntProdOrService);
                    dump('mntDiscountProdOrService', $mntDiscountProdOrService);
                    //
                    $lineBill->setPrctDiscount($proforma->getPrctDiscount());
                    $lineBill->setAmountDiscount($mntDiscountProdOrService);
                } else {
                    $lineBill->setPrctDiscount(null);
                    $lineBill->setAmountDiscount(null);
                }

                $this->_em->persist($lineBill);
                $bill->addLineBill($lineBill);
            }

            $bill->setSubject($proforma->getSubject());
            $bill->setWfAmount($proforma->getWfAmount());
            $bill->setPrctDiscount($proforma->getPrctDiscount());
            $bill->setPeriod(null);
            $bill->setTxtNumber(null);

            // lignes intercallaires de la facture
            foreach ($proforma->getIntercalProformas() as $intercalProforma) {
                $intercaBill = new IntercalBill();
                $intercaBill->setBill($bill);
                $intercaBill->setNumero($intercalProforma->getNumero());
                $intercaBill->setContent($intercalProforma->getContent());
                $intercaBill->setCreatedAt(new \DateTime('now'));
                $this->_em->persist($intercaBill);
                $bill->addIntercalBill($intercaBill);
            }

            $bill->setDetailMainOeuvre($proforma->getDetailMainOeuvre());
            $bill->setPaymentMethod(null);
            $bill->setStatusBill($this->_em->getRepository(RefStatusBill::class)->find(1));

            $this->_em->persist($bill);
            $this->_em->flush();

            return true;
        } catch (\Exception $e) {

            dump('Exception->proformaToBillTransformer : '. $e->getMessage());

            return false;
        }
    }
    /**
     * @param array $data
     * @return bool
     * @throws TransportExceptionInterface
     */
    public function sendMailToRecipient(array $data): bool
    {
        try {
            $email = (new TemplatedEmail())
                ->from('contact@b2mtechnologies.ga')
                ->bcc('d.biy-nze@b2mtechnologies.ga')
                ->to($data['to'])
                ->subject('[B2MT] - '. $data['subject'])
                ->htmlTemplate('emails/mail-send-recipient.html')
                ->context([
                    'subject' => $data['subject'],
                    'message' => $data['message'],
                ])
            ;

            // Envoyer l'email
            $this->_mailer->send($email);
            return true;
        } catch (\Exception $e) {
            //dump('sendMailToRecipient->Exception: ' . $e->getMessage());
            return false;
        }
    }
    /**
     * @param array $data
     * @return bool
     * @throws TransportExceptionInterface
     */
    public function sendMailToEditor(array $data): bool
    {
        try {
            $email = (new TemplatedEmail())
                ->from($data['from'])
                ->to($data['to'])
                ->bcc('d.biy-nze@b2mtechnologies.ga')
                ->subject('[B2M TECHNOLOGIES] - '. $data['subject'])
                ->htmlTemplate('emails/mail-send-editor.html')
                ->context([
                    'subject' => $data['subject'],
                    'message' => $data['message'],
                    'client' => $data['client'],
                ])
            ;

            // Envoyer l'email
            $this->_mailer->send($email);
            return true;
        } catch (\Exception $e) {
            //dump('UtilityService->sendMailToEditor->Exception: ' . $e->getMessage());
            return false;
        }
    }
    /**
     * @throws \Exception
     */
    public function genereNumProformaOrBill(): string
    {
        //return random_int(10, 99) . date('dm') . random_int(20, 99);
        return date('d') . random_int(10, 99) . random_int(20, 99);
    }
    /**
     * @param $path
     * @return string
     */
    public function imageToBase64($path): string
    {
        try {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);

            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        } catch (\Exception $e) {
            //dump('path', $path);
            return "";
        }
    }
    /**
     * @return string
     */
    public function generateUniqueLongFileName(): string
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}