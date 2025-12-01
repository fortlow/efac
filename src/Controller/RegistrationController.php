<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserAccountType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use App\Service\UtilityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;
    private EntityManagerInterface $_em;
    private Security $security;
    private RequestStack $requestStack;

    public function __construct(EmailVerifier $emailVerifier, EntityManagerInterface $em,
                                Security $security, RequestStack $requestStack)
    {
        $this->emailVerifier = $emailVerifier;
        $this->_em = $em;
        $this->security = $security;
        $this->requestStack = $requestStack;
    }

    #[Route('/users', name: 'app_user'), IsGranted('ROLE_MANAGER')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('registration/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/user/add', name: 'app_add_user'), IsGranted('ROLE_MANAGER')]
    public function add(Request $request, MailerInterface $mailer, UserPasswordHasherInterface $userPasswordHasher,
                        UtilityService $utilityService): Response
    {
        $form = $this->createForm(UserType::class, null, [
            'label' => 'create',
            'translator' => '',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $role = $_POST['user']['role'];
                $tRoles[] = $role;
                $user = $form->getData();
                $user->setLastname(strtoupper($user->getLastname()));
                $user->setFirstname(ucfirst($user->getFirstname()));
                $user->setRoles($tRoles);

                $userPwd = new User();
                $hashedPassword = $userPasswordHasher->hashPassword(
                    $userPwd,
                    $form->get('password')->getData()
                );
                $user->setPassword($hashedPassword);

                // Ajout de l'image
                $photo = $form['photo']->getData();

                if (!is_null($photo)) {
                    $file = new File($photo->getPathname());
                    $fileName = $utilityService->generateUniqueLongFileName() . '.' . $file->guessExtension();
                    $realPath = $_ENV['DIR_PHOTO'];
                    try {
                        $file->move($realPath, $fileName);
                        $user->setPhoto($fileName);
                    }
                    catch (\Exception $e) {
                        $this->addFlash('danger', 'Echec de récupération de la photo.');
                    }
                }

                $this->_em->persist($user);
                $this->_em->flush();

                // Envoi du mail de confirmation de la création du compte
                $email = (new TemplatedEmail())
                    ->from('contact@b2mtechnologies.ga')
                    ->to($user->getEmail())
                    ->subject('[eFAC] - Création de votre compte utilisateur')
                    ->htmlTemplate('emails/mail-create-user-account.html')
                    ->context([
                        'nom' => $user->getLastname(),
                        'prenom' => $user->getFirstname(),
                        'subject' => 'Création de votre compte utilisateur eFac',
                        'param1' => $user->getEmail(),
                        'param2' => $user->getRoles()[0],
                    ])
                ;

                try {
                    $mailer->send($email);
                } catch (TransportExceptionInterface $e) {
                    $this->addFlash('warning', "Impossible d'envoyer le mail.");
                }

                $this->addFlash('success', 'Utilisateur créé avec succès.');

            } catch (\Exception $exception) {
                $this->addFlash('danger', "Echec de création de l'utilisateur.");
            }

            return $this->redirectToRoute('app_user');
        }

        return $this->render('registration/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/edit/{id}', name: 'app_edit_user'), IsGranted('ROLE_MANAGER')]
    public function edit(int $id, Request $request, UserRepository $userRepository,
                         UtilityService $utilityService): Response
    {
        $user = $userRepository->find($id);
        $photoSave = $user->getPhoto();

        $form = $this->createForm(UserType::class, $user, [
            'label' => 'edit',
            'translator' => $user->getRoles()[0],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            try {
                $role = $_POST['user']['role'];
                $tRoles[] = $role;

                $user = $form->getData();
                $user->setLastname(strtoupper($user->getLastname()));
                $user->setFirstname(ucfirst($user->getFirstname()));
                $user->setRoles($tRoles);

                // Ajout de l'image
                $photo = $form['photo']->getData();

                if (!is_null($photo)) {
                    $file = new File($photo->getPathname());
                    $fileName = $utilityService->generateUniqueLongFileName() . '.' . $file->guessExtension();
                    $realPath = $_ENV['DIR_PHOTO'];
                    try {
                        $file->move($realPath, $fileName);
                        $user->setPhoto($fileName);
                    }
                    catch (\Exception $e) {
                        $this->addFlash('danger', 'Echec de récupération de la photo.');
                    }
                } else {
                    $user->setPhoto($photoSave);
                }

                $this->_em->flush();
                $this->addFlash('success', 'Utilisateur modifié avec succès.');

            } catch (\Exception $exception) {
                $this->addFlash('danger', "Echec de modification de l'utilisateur.");
            }

            return $this->redirectToRoute('app_user');
        }

        return $this->render('registration/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/user/delete/{id}', name: 'app_delete_user'), IsGranted('ROLE_MANAGER')]
    public function delete(int $id, UserRepository $userRepository): Response
    {
        try {
            $user = $userRepository->find($id);
            $this->_em->remove($user);
            $this->_em->flush();
            $this->addFlash('success', 'Utilisateur supprimée avec succès.');
        } catch (\Exception $exception) {
            //dump('exception', $exception->getMessage());
            $this->addFlash('danger', "Echec de suppression de l'Utilisateur.");
        }

        return $this->redirectToRoute('app_user');
    }
    #[Route('/user/my/account', name: 'app_user_my_account'), IsGranted('ROLE_USER')]
    public function modifyMyAccount(Request $request, UserPasswordHasherInterface $userPasswordHasher,
                                    UtilityService $utilityService): Response
    {
        //$user = $this->getUser();
        $user = $this->security->getUser();

        if(!is_null($user))
        {
            $flag = false;
            $form = $this->createForm(UserAccountType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                try {
                    $user = $form->getData();
                    $user->setLastname(strtoupper($user->getLastname()));
                    $user->setFirstname(ucfirst($user->getFirstname()));
                    $MyPassword = $form->get('new_password')->getData();

                    // Traitement du mot de passe, on écrase l'ancien mot de passe à tous les coups.
                    if(!is_null($MyPassword) && strlen($MyPassword)>0)
                    {
                        $userPwd = new User();
                        $user->setPassword($userPasswordHasher->hashPassword($userPwd, $MyPassword));
                        $flag = true;
                    }
                    // Traitement de la photo de l'image
                    $photo = $form['photo']->getData();

                    if (!is_null($photo)) {
                        $file = new File($photo->getPathname());
                        $fileName = $utilityService->generateUniqueLongFileName() . '.' . $file->guessExtension();
                        $realPath = $_ENV['DIR_PHOTO'];
                        try {
                            $file->move($realPath, $fileName);
                            $user->setPhoto($fileName);
                        }
                        catch (\Exception $e) {
                            $this->addFlash('danger', 'Echec de récupération de la photo.');
                        }
                    }

                    $this->_em->flush();
                    $this->addFlash('success', 'Compte utilisateur modifié avec succès.');
                    if($flag) {
                        return $this->redirectToRoute('app_logout');
                    }

                } catch (\Exception $exception) {
                    $this->addFlash('danger', 'Echec de modification du compte utilisateur.');
                    dump('exception', $exception->getMessage());
                }
            }

            return $this->render('registration/account-user.html.twig', [
                'form' => $form->createView(),
                'user' => $user,
            ]);
        } else {
            $this->addFlash('danger', 'Problème d\'authentification! Impossible d\'accéder à votre compte.');
            return $this->redirectToRoute('app_home');
        }
    }


    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            /** @var User $user */
            $user = $this->getUser();
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        $this->addFlash('success', 'Validation de votre adresse mail réussie.');

        return $this->redirectToRoute('app_register');
    }
}
