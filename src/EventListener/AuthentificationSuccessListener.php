<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Http\Event\LoginSuccessEvent;

#[AsEventListener(event: LoginSuccessEvent::class, method: 'onLoginSuccess')]
class AuthentificationSuccessListener
{
    private LoggerInterface $logger;
    private EntityManagerInterface $em;

    public function __construct(LoggerInterface $logger, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->logger = $logger;
    }

    public function onLoginSuccess(LoginSuccessEvent $event): void
    {
        $user = $event->getUser();
        $eMail = $user->getUserIdentifier();

        $this->logger->info('onLoginSuccess->email user : '. $eMail);

        $userLastConnected = $this->em->getRepository(User::class)->findOneBy(['email' => $eMail]);

        if(!is_null($userLastConnected)) {
            $this->logger->info('onLoginSuccess->mise a jour de la table user');
            $userLastConnected->setStartcnxAt(new \DateTime());
            $this->em->flush();
            $this->logger->info('onLoginSuccess->fin de la mise a jour de la table user');
        }
    }

}