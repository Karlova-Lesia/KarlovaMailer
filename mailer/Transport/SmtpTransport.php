<?php

namespace Mailer\Transport;

use Config\Config;

class SmtpTransport implements TransportInterface
{
    public function getInstance(): \Swift_Transport
    {
        $config = Config::getConfig();

        return (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername($config['services']['gmail']['username'])
            ->setPassword($config['services']['gmail']['password'])
        ;
    }
}
