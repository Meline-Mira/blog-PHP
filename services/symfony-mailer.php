<?php

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;

function create_mailer(): Mailer
{
    $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
    return new Mailer($transport);
}
