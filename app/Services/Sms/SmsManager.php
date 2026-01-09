<?php

namespace App\Services\Sms;

class SmsManager
{
    public function provider(): SmsProviderInterface
    {
        $provider = (string) config('services.sms.provider', 'twilio');

        if ($provider === 'twilio') {
            return new TwilioSmsProvider();
        }

        throw new \RuntimeException('Unsupported SMS provider: '.$provider);
    }
}
