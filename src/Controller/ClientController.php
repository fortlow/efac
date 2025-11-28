<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Client;
use App\Entity\StatusClient;
use App\Form\ClientType;
use App\Form\ContactClientType;
use App\Form\FormSendMailType;
use App\Repository\ClientRepository;
use App\Repository\ContactClientRepository;
use App\Service\UtilityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class ClientController extends AbstractController
{
    private EntityManagerInterface $_em;
    private UtilityService $_utilService;

    /**
     * @param EntityManagerInterface $em
     * @param UtilityService $utilityService
     */
    public function __construct(EntityManagerInterface $em, UtilityService $utilityService)
    {
        $this->_em = $em;
        $this->_utilService = $utilityService;
    }

    #[Route('/bo/client', name: 'app_client'), IsGranted('ROLE_SALE')]
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    #[Route('/bo/client/add', name: 'app_client_add'), IsGranted('ROLE_SALE')]
    public function add(Request $request): Response
    {
        $form = $this->createForm(ClientType::class, null, [
            'label' => null,
            'translator' => 'created',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $client = $form->getData();
                $client->setCreatedAt(new \DateTime('now'));
                $client->setSreason(strtoupper($client->getSreason()));
                $statusClient = $this->_em->getRepository(StatusClient::class)->find(1);
                $client->setStatusClient($statusClient);

                $this->_em->persist($client);
                $this->_em->flush();
                $this->addFlash('success', 'Client créé avec succès.');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de création du client.');
            }

            return $this->redirectToRoute('app_client');
        }

        return $this->render('client/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/bo/client/edit/{id}', name: 'app_client_edit'), IsGranted('ROLE_SALE')]
    public function edit(Request $request, ClientRepository $repository, int $id): Response
    {
        $client = $repository->find($id);
        $form = $this->createForm(ClientType::class, $client, [
            'label' => null,
            'translator' => 'edit',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $client = $form->getData();
                $client->setCreatedAt(new \DateTime('now'));
                $client->setSreason(strtoupper($client->getSreason()));
                $this->_em->flush();
                $this->addFlash('success', 'Client modifié avec succès.');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de modification du client.');
            }

            return $this->redirectToRoute('app_client');
        }

        return $this->render('client/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/bo/client/delete/{id}', name: 'app_client_delete'), IsGranted('ROLE_SALE')]
    public function delete(int $id, ClientRepository $clientRepository): Response
    {
        try {
            $client = $clientRepository->find($id);
            $this->_em->remove($client);
            $this->_em->flush();
            $this->addFlash('success', 'Client supprimé avec succès.');
        } catch (\Exception $exception) {
            $this->addFlash('danger', 'Echec de suppression du client.');
        }

        return $this->redirectToRoute('app_client');
    }

    #[Route('/bo/client/contact/{id}', name: 'app_client_contact'), IsGranted('ROLE_SALE')]
    public function listContact(ClientRepository $clientRepository, int $id): Response
    {
        $client = $clientRepository->find($id);
        $contacts = $client->getContactClients()->toArray();

        return $this->render('client/list-contact.html.twig', [
            'contacts' => $contacts,
            'client' => $client,
        ]);
    }

    #[Route('/bo/bo/client/contact/add/{id}', name: 'app_client_add_contact'), IsGranted('ROLE_SALE')]
    public function addContact(Request $request, int $id): Response
    {
        $client = $this->_em->getRepository(Client::class)->find($id);
        $form = $this->createForm(ContactClientType::class, null, [
            'label' => $id
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $contact = $form->getData();
                $contact->setCreatedAt(new \DateTime('now'));
                $contact->setLastname(strtoupper($contact->getLastname()));
                $contact->setFirstname(ucfirst($contact->getFirstname()));
                $contact->setClient($client);

                // ----------------------------------------------------------------------------------------------
                // Ajout de la photo
                $photo = $form['photo']->getData();
                dump('photo', $photo);

                if (!is_null($photo)) {
                    $file = new File($photo->getPathname());
                    $fileName = $this->_utilService->generateUniqueLongFileName() . '.' . $file->guessExtension();
                    $realPath = $_ENV['DIR_PHOTO'];
                    try {
                        $file->move($realPath, $fileName);
                        $contact->setPhoto($fileName);
                    }
                    catch (\Exception $e) {
                        $this->addFlash('danger', 'Echec de récupération de la photo.');
                    }
                }
                // ----------------------------------------------------------------------------------------------

                $this->_em->persist($contact);
                $this->_em->flush();
                $this->addFlash('success', 'Contact créé avec succès.');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de création du contact.');
            }

            return $this->redirectToRoute('app_client_contact', ['id' => $id]);
        }

        return $this->render('client/add-contact.html.twig', [
            'form' => $form->createView(),
            'id' => $id,
            'client' => $client,
        ]);
    }

    #[Route('/bo/client/contact/edit/{id}/{idCli}', name: 'app_client_edit_contact'), IsGranted('ROLE_SALE')]
    public function editContact(Request $request, ClientRepository $clientRepository,
                                ContactClientRepository $contactClientRepository,
                                int $id, int $idCli): Response
    {
        $contact = $contactClientRepository->find($id);
        $client = $clientRepository->find($idCli);
        $form = $this->createForm(ContactClientType::class, $contact, ['label' => $idCli]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $contact = $form->getData();
                $contact->setLastname(strtoupper($contact->getLastname()));
                $contact->setFirstname(ucfirst($contact->getFirstname()));
                $contact->setClient($client);

                // ----------------------------------------------------------------------------------------------
                // Ajout de la photo
                $photo = $form['photo']->getData();

                if (!is_null($photo)) {
                    $file = new File($photo->getPathname());
                    $fileName = $this->_utilService->generateUniqueLongFileName() . '.' . $file->guessExtension();
                    $realPath = $_ENV['DIR_PHOTO'];
                    try {
                        $file->move($realPath, $fileName);
                        $contact->setPhoto($fileName);
                    }
                    catch (\Exception $e) {
                        $this->addFlash('danger', 'Echec de récupération de la photo.');
                    }
                }
                // ----------------------------------------------------------------------------------------------

                $this->_em->flush();
                $this->addFlash('success', 'Contact modifié avec succès.');
            } catch (\Exception $exception) {
                $this->addFlash('danger', 'Echec de modification du contact.');
            }

            return $this->redirectToRoute('app_client_contact', ['id' => $idCli]);
        }
        return $this->render('client/edit-contact.html.twig', [
            'form' => $form->createView(),
            'id' => $idCli,
            'client' => $client,
        ]);
    }

    #[Route('/bo/client/contact/delete/{id}/{idCli}', name: 'app_client_delete_contact'), IsGranted('ROLE_SALE')]
    public function deleteContact(int $id, int $idCli, ContactClientRepository $contactClientRepository): Response
    {
        try {
            $contact = $contactClientRepository->find($id);
            $this->_em->remove($contact);
            $this->_em->flush();
            $this->addFlash('success', 'Contact supprimé avec succès.');
        } catch (\Exception $exception) {
            $this->addFlash('danger', 'Echec de suppression du contact.');
        }

        return $this->redirectToRoute('app_client_contact', ['id' => $idCli]);
    }

    #[Route('/bo/client/send/mail/contact/{id}', name: 'app_send_mail_contact'), IsGranted('ROLE_SALE')]
    public function sendMailToContact(Request $request, ContactClientRepository $contactClientRepository, int $id): Response
    {
        $contact = $contactClientRepository->find($id);
        $email = '';
        if(!is_null($contact)) $email = $contact->getEmail();

        $form = $this->createForm(FormSendMailType::class, null, [
            'label' => $email,
            'translator' => $_ENV['APP_MAIL_FROM'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $data = $form->getData();
                if($this->_utilService->sendMailToRecipient($data)) {
                    $this->addFlash('success', 'Mail envoyé avec succès.');
                } else {
                    $this->addFlash('danger', "Problème lors de l'envoi du mail.");
                }
            } catch (\Exception|TransportExceptionInterface $exception) {
                $this->addFlash('danger', "Echec d'envoi du mail.");
            }

            return $this->redirectToRoute('app_client_contact', ['id' => $contact->getClient()->getId()]);
        }
        return $this->render('client/send-mail-contact.html.twig', [
            'form' => $form->createView(),
            'id' => $id,
            'contact' => $contact,
        ]);
    }
}
