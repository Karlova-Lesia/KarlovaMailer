<?php

namespace Mailer\Transport;

use Config\Config;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Message
{
    public static function send(string $subject, string $templateName, array $vars, string $to): void
    {
        $config = Config::getConfig();
        $transport = new $config['defaultTransportType']();
        $mailer = new MailTransport($transport);
        $message = new \Swift_Message();

        $log = new Logger('mailer');
        $log->pushHandler(new StreamHandler($config['logs']['path'], Logger::INFO));
        $log->info('Sending', ['subject' => $subject, 'to' => $to]);

        try {
            $message->setSubject($subject);
            $message->setBody((new Message())->template($templateName, $vars), 'text/html');
            $message->setTo($to);
            $message->setFrom($config['services']['gmail']['username']);
            $mailer->getMailer()->send($message);
        } catch (\Throwable $e) {
            $log->pushHandler(new StreamHandler($config['logs']['path'], Logger::WARNING));
            $log->warning('There isn`t enough data for sending');
        }
    }

    private function template($templateName, $vars): string
    {
        ob_start();
        extract($vars);

        include Config::getConfig()['templates']['path']."{$templateName}.php";

        return ob_get_clean();
    }
}
