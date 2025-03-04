<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class SendMail
{
    public static function send(string $toEmail, $className, array $data)
    {
        if (!$toEmail || !isset($data[0]) || !$className || !class_exists($className)) {
            return;
        }
        return Mail::to($toEmail)->send(
            new $className($data)
        );
    }
}
