<?php

namespace Mailer\Transport;

class Message
{
    public static function send(string $subject, string $templateName, array $vars, string $to): void
    {
        $config = (new Message())->getConfig();
        $transport = new $config['defaultTransportType']();
        $mailer = new MailTransport($transport);
        $message = new \Swift_Message();

        $message->setSubject($subject);
        $message->setBody((new Message())->template($templateName, $vars), 'text/html');
        $message->setTo($to);
        $message->setFrom((new Message())->getConfig()['services']['gmail']['username']);

        $mailer->getMailer()->send($message);
    }

    private function template($templateName, $vars): bool
    {
        ob_start();
        extract($vars);
        include $this->getConfig()['templates']['path'] . "$templateName.php";

        return ob_get_clean();
    }

    public function getConfig(): array
    {
        return require '../config/config.php';
    }
}
