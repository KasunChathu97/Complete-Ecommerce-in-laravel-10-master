<?php

namespace App\Services\Sms;

interface SmsProviderInterface
{
    /**
     * @return array{provider:string,status?:string,provider_message_id?:string,raw?:string}
     */
    public function send(string $to, string $message): array;
}
