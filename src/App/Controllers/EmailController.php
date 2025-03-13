<?php

namespace App\Controllers;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class EmailController
{
    /**
     * Send an Email
     * @return void
     */
    public static function sendEmail($to,$subject,$text,$html,$cc="",$bcc="",$replyTo="",$priority=false,)
    {
        $user = $_ENV["email"];
        $pass = $_ENV["password"];
        $dsn = "smtp://$user:$pass@smtp.gmail.com:587";
        $transport = Transport::fromDsn($dsn);
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from($user)
            ->to($to)
            ->subject($subject)
            ->text($text)
            ->html($html);
            if($priority) $email->priority(Email::PRIORITY_HIGH);
            if(!empty($cc)) $email->cc($cc);
            if(!empty($bcc)) $email->bcc($bcc);
            if(!empty($replyTo)) $email->replyTo($replyTo);
        $mailer->send($email);
    }
}