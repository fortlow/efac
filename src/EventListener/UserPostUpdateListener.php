<?php
// src/EventListener/UserPostUpdateListener.php
/*
namespace App\EventListener;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Events;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;

#[AsDoctrineListener(event: Events::postUpdate)]
class UserPostUpdateListener
{
    private EntityManagerInterface $_em;
    private LoggerInterface $_logger;
    private TexterInterface $_texter;
    private Request $_request;

    public function __construct(LoggerInterface $logger, EntityManagerInterface $em, TexterInterface $texter) {
        $this->_logger = $logger;
        $this->_em = $em;
        $this->_texter = $texter;
    }
*/
    /**

    public function postUpdate(PostUpdateEventArgs $args): void
    {
        $this->_logger->info('UserPostUpdateListener->postUpdate IN');

        $entity = $args->getObject();
        $entityManager = $args->getObjectManager();
        $className = get_class($entity); // Récupérer le nom de la classe de l'entité (la table)
        $changeSet = $entityManager->getUnitOfWork()->getEntityChangeSet($entity); // Pour voir ce qui a été modifié
        $urlFlag = ( ($_ENV['APP_ENV'] == 'prod') ? $_SERVER['REQUEST_URI'] : $_SERVER['PATH_INFO']);

        $this->_logger->info('UserPostUpdateListener->postUpdate : urlFlag = '. $urlFlag);

        if(('App\Entity\User' === $className) && ( ('/2fa' == $urlFlag) || ('/login' == $urlFlag) ) )
        {
            $user = $this->_em->getRepository(User::class)->find($entity->getId());

            if(!is_null($user))
            {
                $mobilePhone = $entity->getMobilePhone();
                $codeAuth = $user->getEmailAuthCode();

                if(!is_null($mobilePhone) && strlen($mobilePhone) > 8
                    && preg_match('/^(241)([6|7])(\\d+){7}/', $mobilePhone, $matches))
                {
                    $sms = new SmsMessage($mobilePhone, 'Votre code auth 2FA : '. $codeAuth);
                    $sentMessage = $this->_texter->send($sms);
                } else {
                    $this->_logger->error('UserPostUpdateListener->postUpdate : numero de téléphone incorrect!');
                }
            }
        }
        $this->_logger->info('UserPostUpdateListener->postUpdate OUT');
    }
}
    */