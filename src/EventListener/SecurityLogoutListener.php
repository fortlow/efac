<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: LogoutEvent::class, method: 'onSecurityLogout')]
class SecurityLogoutListener
{
    private LoggerInterface $logger;
    private EntityManagerInterface $em;

    public function __construct(LoggerInterface $logger, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->logger = $logger;
    }

    public function onSecurityLogout(LogoutEvent $event): void
    {
        if( !is_null($event->getToken()) )
        {
            $user = $event->getToken()->getUser();
            $eMail = $user->getUserIdentifier();

            $this->logger->info('onSecurityLogout->email user : '. $eMail);

            $userLastConnected = $this->em->getRepository(User::class)->findOneBy(['email' => $eMail]);

            if(!is_null($userLastConnected)) {
                $this->logger->info('onSecurityLogout->mise a jour de la table user');
                $userLastConnected->setLastcnxAt(new \DateTime());
                $this->em->flush();
                $this->logger->info('onSecurityLogout->fin de la mise a jour de la table user');
            }
        }
    }
}
