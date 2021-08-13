<?php

namespace Mailer\Transport;

interface TransportInterface
{
    public function getInstance(): \Swift_Transport;
}
