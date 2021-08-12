<?php

namespace Mailer\Transport;

class SmtpTransport implements TransportInterface
{
    public function getInstance(): \Swift_Transport
    {
        $config = (new Message())->getConfig();

        return (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername($config['services']['gmail']['username'])
            ->setPassword($config['services']['gmail']['password']);
    }
}
