<?php

namespace Config;

class Config implements ConfigInterface
{
    public static function getConfig(): array
    {
        return [
            'defaultTransportType' => \Mailer\Transport\SmtpTransport::class,
            'templates' => [
                'path' => '../templates/',
            ],
            'services' => [
                'gmail' => [
                    'smtp' => 'smtp.gmail.com',
                    'port' => 465,
                    'encryption' => 'ssl',
                    'username' => 'wardrobe0609@gmail.com',
                    'password' => 'September061998',
                ],
            ],
            'logs' => [
                'path' => '../logs/dev.log',
            ],
        ];
    }
}
