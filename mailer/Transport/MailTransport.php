<?php

namespace Mailer\Transport;

class MailTransport implements MailerInterface
{
    private ?object $mailer;

    public function __construct($transport)
    {
        $this->mailer = new \Swift_Mailer($transport->getInstance());
    }

    public function getMailer(): object
    {
        return $this->mailer;
    }
}
