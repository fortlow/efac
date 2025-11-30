<?php
declare(strict_types=1);

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Bundle\SecurityBundle\Security;

class LogoutSubscriber implements EventSubscriberInterface
{
    private UrlGeneratorInterface $urlGenerator;
    private EntityManagerInterface $em;
    private Security $security;

    public function __construct(UrlGeneratorInterface $urlGenerator, Security $security,
                                EntityManagerInterface $entityManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->em = $entityManager;
        $this->security = $security;
    }

    public static function getSubscribedEvents(): array
    {
        return [LogoutEvent::class => 'onLogout'];
    }

    public function onLogout(LogoutEvent $event): void
    {
        // get the security token of the session that is about to be logged out
        $token = $event->getToken();

        // get the current request
        $request = $event->getRequest();

        // get the current response, if it is already set by another listener
        $response = $event->getResponse();

        $user = $this->security->getUser();
        $email = $user->getUserIdentifier();
        $tUser = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        if(is_array($tUser) && count($tUser) > 0) {
            $user = $tUser[0];
            $user->setLastcnxAt(new \DateTime());
            $this->em->persist($user);
            $this->em->flush();
        }

        // configure a custom logout response to the homepage
        $response = new RedirectResponse($this->urlGenerator->generate('app_home'), RedirectResponse::HTTP_SEE_OTHER);
        $event->setResponse($response);
    }
}