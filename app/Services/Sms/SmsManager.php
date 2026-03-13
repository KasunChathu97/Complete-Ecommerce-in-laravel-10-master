<?php

namespace App\Services\Sms;

class SmsManager
{
    public function provider(): SmsProviderInterface
    {
        $provider = (string) config('services.sms.provider', 'twilio');
        $provider = strtolower(trim($provider));

        if ($provider === 'twilio') {
            return new TwilioSmsProvider();
        }

        if ($provider === 'textit' || $provider === 'textit.biz' || $provider === 'textit_biz') {
            return new TextitSmsProvider();
        }

        throw new \RuntimeException('Unsupported SMS provider: '.$provider);
    }
}
