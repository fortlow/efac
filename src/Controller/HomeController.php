<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgetPasswordType;
use App\Repository\BillRepository;
use App\Repository\ProformaRepository;
use App\Service\MailerService;
use App\Service\UtilityService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{

    private EntityManagerInterface $_em;
    private MailerService $_mailer;
    private LoggerInterface $_logger;

    /**
     * @param EntityManagerInterface $em
     * @param MailerService $mailerService
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManagerInterface $em, MailerService $mailerService, LoggerInterface $logger)
    {
        $this->_em = $em;
        $this->_mailer = $mailerService;
        $this->_logger = $logger;
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    #[Route('/politique/confidentialite', name: 'app_confidentialite')]
    public function politiqueConfidentialite(): Response
    {
        return $this->render('home/politique-confidentialite.html.twig', []);
    }

    #[Route('/conditions/utilisation', name: 'app_condition_utilisation')]
    public function politiqueUtilisation(): Response
    {
        return $this->render('home/conditions-utilisation.html.twig', []);
    }

    #[Route('/politique/utilisation/cookies', name: 'app_utilisation_cookies')]
    public function politiqueCookie(): Response
    {
        return $this->render('home/politique-utilisation-cookie.html.twig', []);
    }

    #[Route('/document/verify/{target}/{slug}', name: 'app_document_verify')]
    public function verify(ProformaRepository $proformaRepository, BillRepository $billRepository,
                           UtilityService $utileSrv, string $target, string $slug): Response
    {
        $document = null;
        $qrCode = null;

        if($target === 'proforma') {
            $document = $proformaRepository->findOneBy(['secret_code' => $slug]);
            if (!is_null($document)) {
                $this->addFlash('success', 'Pro Forma authentifiée par eFac.');
                $qrCode = $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/qr-code/' . $document->getQrCode());
            } else {
                $this->addFlash('danger', 'Pro Forma non authentifiée par eFac.');
            }
        } elseif ($target === 'bill') {

            $document = $billRepository->findOneBy(['secret_code' => $slug]);
            if (!is_null($document)) {
                $this->addFlash('success', 'Facture authentifiée par eFac.');
                $qrCode = $utileSrv->imageToBase64($this->getParameter('kernel.project_dir') . '/public/img/qr-code/' . $document->getQrCode());
            } else {
                $this->addFlash('danger', 'Facture non authentifiée par eFac.');
            }
        }

        return $this->render('home/verify.html.twig', [
            'target' => $target,
            'document' => $document,
            'qrCode' => $qrCode,
        ]);
    }

    #[Route('/forget-password', name: 'app_forget_password')]
    public function forgetPassword(Request $request): Response
    {
        $form = $this->createForm(ForgetPasswordType::class, null);

        try {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())
            {
                $token = $this->generateToken();
                $data = $form->getData();
                $email = $data['email'];
                $user = $this->_em->getRepository(User::class)->findOneBy(['email' => $email]);

                // Verifie si le mail saisi existe dans la base de donnée et generation du token
                if (!is_null($user) /*&& count($user) > 0*/) {
                    $user->setToken($token);
                    $this->_em->flush();
                    //$user = $user[0];

                    // creation de l'Url de récuperation du mot de passe
                    $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
                    $urlReNewPwd = $baseurl . '/new-password/' . $user->getToken();
                    $subject = 'Nouveau mot de passe';

                    $this->_mailer->sendEmailForgetPassword(
                        $user,
                        $subject,
                        $urlReNewPwd
                    );

                    $this->addFlash('success', "Un message vient d'être envoyé a votre adresse email, veuillez consulter vos mails");

                    return $this->redirectToRoute('app_login');
                } else {
                    $this->addFlash('danger', "Cette adresse email n'existe pas, veuillez saisir une adresse valide");

                    return $this->render('home/forget_password.html.twig', [
                        'form' => $form->createView(),
                    ]);
                }
            }

            return $this->render('home/forget-password.html.twig', [
                'form' => $form->createView(),
            ]);
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Erreur lors du traitement, veuillez recommencer');

            $this->_logger->error('forgetPassword() - Exception : '. $e->getMessage());

            return $this->render('home/forget-password.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @throws RandomException
     */
    public function generateToken(): string
    {
        return rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');
    }
}
