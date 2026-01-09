<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TwilioSmsProvider implements SmsProviderInterface
{
    private function normalizeE164(string $phone): string
    {
        $phone = trim($phone);
        if ($phone === '') {
            return '';
        }

        $defaultCountryCode = trim((string) config('services.sms.default_country_code', ''));
        if ($defaultCountryCode !== '' && !str_starts_with($defaultCountryCode, '+')) {
            $defaultCountryCode = '+'.preg_replace('/\D+/', '', $defaultCountryCode);
        }

        $hasPlus = str_starts_with($phone, '+');

        // Keep only digits; re-add leading + if it existed.
        $digits = preg_replace('/\D+/', '', $phone) ?? '';
        $normalized = $hasPlus ? ('+'.$digits) : $digits;

        if ($normalized === '' || $normalized === '+') {
            return '';
        }

        // Twilio expects E.164 for most use-cases: +<countrycode><number>
        if (!str_starts_with($normalized, '+')) {
            // If a default country code is configured, convert local/national numbers into E.164.
            if ($defaultCountryCode !== '') {
                $ccDigits = preg_replace('/\D+/', '', $defaultCountryCode) ?? '';
                if ($ccDigits !== '' && str_starts_with($normalized, $ccDigits)) {
                    return '+'.$normalized;
                }

                // Drop leading 0 commonly used in national formats (e.g., 077xxxxxxx)
                if (str_starts_with($normalized, '0')) {
                    $normalized = substr($normalized, 1);
                }

                return $defaultCountryCode.$normalized;
            }

            throw new \InvalidArgumentException('Phone number must be in E.164 format (example: +94777820662). Got: '.$phone);
        }

        return $normalized;
    }

    public function send(string $to, string $message): array
    {
        $accountSid = (string) config('services.sms.twilio.account_sid');
        $authToken = (string) config('services.sms.twilio.auth_token');
        $from = (string) config('services.sms.twilio.from');

        if ($accountSid === '' || $authToken === '' || $from === '') {
            throw new \RuntimeException('Twilio SMS is not configured. Set TWILIO_ACCOUNT_SID, TWILIO_AUTH_TOKEN, TWILIO_FROM.');
        }

        $endpoint = 'https://api.twilio.com/2010-04-01/Accounts/'.rawurlencode($accountSid).'/Messages.json';

        $to = $this->normalizeE164($to);
        $from = $this->normalizeE164($from);

        $response = Http::withBasicAuth($accountSid, $authToken)
            ->asForm()
            ->post($endpoint, [
                'To' => $to,
                'From' => $from,
                'Body' => $message,
            ]);

        if (!$response->successful()) {
            $body = $response->body();
            $status = $response->status();
            throw new \RuntimeException('Twilio send failed (HTTP '.$status.'): '.Str::limit($body, 800));
        }

        $payload = $response->json();

        return [
            'provider' => 'twilio',
            'status' => $payload['status'] ?? 'sent',
            'provider_message_id' => $payload['sid'] ?? null,
            'raw' => json_encode($payload),
        ];
    }
}
