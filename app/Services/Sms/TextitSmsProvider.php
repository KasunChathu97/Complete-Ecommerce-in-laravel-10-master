<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TextitSmsProvider implements SmsProviderInterface
{
    private function normalizeRecipient(string $phone): string
    {
        $phone = trim($phone);
        if ($phone === '') {
            return '';
        }

        $defaultCountryCode = trim((string) config('services.sms.default_country_code', ''));
        $ccDigits = preg_replace('/\D+/', '', $defaultCountryCode) ?? '';

        // Keep digits only.
        $digits = preg_replace('/\D+/', '', $phone) ?? '';
        if ($digits === '') {
            return '';
        }

        // If the user entered a national format starting with 0 (e.g., 077xxxxxxx), convert using configured country code.
        if ($ccDigits !== '' && str_starts_with($digits, '0')) {
            $digits = substr($digits, 1);
            $digits = $ccDigits.$digits;
        }

        // If a default country code is configured and the number doesn't start with it, prefix it.
        if ($ccDigits !== '' && !str_starts_with($digits, $ccDigits)) {
            // Heuristic: if it already looks like an international number (>= 11 digits), keep as-is.
            if (strlen($digits) <= 10) {
                $digits = $ccDigits.$digits;
            }
        }

        return $digits;
    }

    public function send(string $to, string $message): array
    {
        $baseUrl = (string) config('services.sms.textit.base_url', 'https://api.textit.biz/');
        $apiVersion = (string) config('services.sms.textit.api_version', 'v1');
        $authorization = trim((string) config('services.sms.textit.authorization', ''));
        $timeout = (int) config('services.sms.textit.timeout', 10);

        if ($authorization === '') {
            throw new \RuntimeException('Textit SMS is not configured. Set TEXTIT_AUTHORIZATION (example: "Basic <token>").');
        }

        $to = $this->normalizeRecipient($to);
        if ($to === '') {
            throw new \InvalidArgumentException('Recipient phone number is empty/invalid.');
        }

        $response = Http::withHeaders([
            'Accept' => '*/*',
            'X-API-VERSION' => $apiVersion,
            'Authorization' => $authorization,
        ])
            ->timeout($timeout)
            ->asJson()
            ->post($baseUrl, [
                'to' => $to,
                'text' => $message,
            ]);

        if (!$response->successful()) {
            $status = $response->status();
            $body = $response->body();
            throw new \RuntimeException('Textit send failed (HTTP '.$status.'): '.Str::limit($body, 800));
        }

        $payload = $response->json();

        return [
            'provider' => 'textit',
            'status' => 'sent',
            'provider_message_id' => is_array($payload) ? ($payload['id'] ?? ($payload['message_id'] ?? null)) : null,
            'raw' => is_array($payload) ? json_encode($payload) : $response->body(),
        ];
    }
}
