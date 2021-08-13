<?php

namespace Mailer\Transport;

use Config\Config;

class Message
{
    public static function send(string $subject, string $templateName, array $vars, string $to): void
    {
        $config = Config::getConfig();
        $transport = new $config['defaultTransportType']();
        $mailer = new MailTransport($transport);
        $message = new \Swift_Message();

        $message->setSubject($subject);
        $message->setBody((new Message())->template($templateName, $vars), 'text/html');
        $message->setTo($to);
        $message->setFrom($config['services']['gmail']['username']);

        $mailer->getMailer()->send($message);
    }

    private function template($templateName, $vars): string
    {
        ob_start();
        extract($vars);

        include Config::getConfig()['templates']['path']."{$templateName}.php";

        return ob_get_clean();
    }
}
