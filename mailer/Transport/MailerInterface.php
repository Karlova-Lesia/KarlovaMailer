<?php

namespace Mailer\Transport;

interface MailerInterface
{
    public function __construct(TransportInterface $transport);
}
