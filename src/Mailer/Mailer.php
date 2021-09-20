<?php

namespace App\Mailer;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

/**
 * Undocumented class
 */
class Mailer
{
    private const EMAIL = 'victor.besson@gmail.com';
    private $mailer;

    /**
     * Injecting templating and mailing
     *
     * @param \Swift_Mailer $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendEmailToMe($contact)
    {
        $message = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to(self::EMAIL)
            ->subject($contact->getSujet())
            ->text('Sending emails is fun again!')
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'firstName' => $contact->getNom(),
                'secondName' => $contact->getPrenom(),
                'message' => $contact->getMessage(),
                'userEmail' => $contact->getEmail(),
            ]);
        $this->mailer->send($message);
    }
}
