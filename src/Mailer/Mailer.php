<?php

namespace App\Mailer;

use Twig\Environment;

/**
 * Undocumented class
 */
class Mailer
{
    private const EMAIL = 'victor.besson@gmail.com';
    private $mailer;
    private $twig;

    /**
     * Injecting templating and mailing
     *
     * @param Environment $twig
     * @param \Swift_Mailer $mailer
     */
    public function __construct(Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }


    public function sendEmailToMe($contact)
    {
        $message = (new \Swift_Message($contact->getSujet()))
            ->setFrom($contact->getEmail())
            ->setTo(self::EMAIL)
            ->setBody(
                $this->twig->render(
                    'emails/contact.txt.twig',
                    [
                        'firstName' => $contact->getNom(),
                        'secondName' => $contact->getPrenom(),
                        'message' => $contact->getMessage()
                    ]
                ),
                'text/text'
            );
        $this->mailer->send($message);
    }
}
