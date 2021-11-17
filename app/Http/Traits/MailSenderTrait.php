<?php

namespace App\Http\Traits;

trait MailSenderTrait
{
    /**
        @throws EmailSendingException
     */
    function sendEmail(string $subject, string $body, string $email): void
    {

    }
}
