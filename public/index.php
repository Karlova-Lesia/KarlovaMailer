<?php

require_once '../vendor/autoload.php';

use Mailer\Transport\Message;

Message::send(
    'Registration',
    'confirmOfRegistr',
    ['title' => 'Registration'],
    'karlovalesa06@gmail.com'
);
