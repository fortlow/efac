<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private EntityManagerInterface $_em;
    private MailerInterface $_mailer;
    private LoggerInterface $_logger;

    /**
     * @param EntityManagerInterface $em
     * @param MailerInterface $mailer
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManagerInterface $em, MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->_em = $em;
        $this->_mailer = $mailer;
        $this->_logger = $logger;
    }

    /**
     * @param User $user
     * @param $subject
     * @param $urlReNewPwd
     * @return bool
     */
    public function sendEmailForgetPassword(User $user, $subject, $urlReNewPwd): bool
    {
        // Envoi du mail de confirmation de la création du compte
        $email = (new TemplatedEmail())
            ->from('contact@efac.tech')
            ->to($user->getEmail())
            ->subject(subject: '[eFAC] - '. $subject)
            ->htmlTemplate('emails/forget-password.html')
            ->context([
                'user' => $user,
                'subject' => $subject,
                'urlrenewpwd' => $urlReNewPwd
            ]);

        try {
            $this->_mailer->send($email);

            return true;
        } catch (TransportExceptionInterface $e) {
            $this->addFlash('warning', "Impossible d'envoyer le mail.");

            $this->_logger->error('sendEmailForgetPassword() - Exception : '. $e->getMessage());

            return false;
        }
    }
}