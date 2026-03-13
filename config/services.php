<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'github' => [
        'client_id' => 'YOUR_GITHUB_API', //Github API
        'client_secret' => 'YOUR_GITHUB_SECRET', //Github Secret
        'redirect' => 'http://localhost:8000/login/github/callback',
     ],
     'google' => [
        'client_id' => 'YOUR_GOOGLE_API', //Google API
        'client_secret' => 'YOUR_GOOGLE_SECRET', //Google Secret
        'redirect' => 'http://localhost:8000/login/google/callback',
     ],
     'facebook' => [
        'client_id' => 'YOUR_FACEBOOK_API', //Facebook API
        'client_secret' => 'YOUR_FACEBOK_SECRET', //Facebook Secret
        'redirect' => 'http://localhost:8000/login/facebook/callback',
     ],

    // SMS provider configuration (used for sending notifications when SmsLog entries are created)
    'sms' => [
        // Set to true to enable sending SMS via API
        'enabled' => env('SMS_ENABLED', false),

        // Set to true to also send email notifications when SmsLog entries are created
        'email_enabled' => env('SMS_EMAIL_ENABLED', true),

        // Currently supported: twilio, textit
        // Note: SmsManager also accepts aliases for Textit: textit.biz, textit_biz
        'provider' => env('SMS_PROVIDER', 'twilio'),

        // Optional default country code used to normalize phone numbers when they are stored
        // without a leading "+" (example: "+94"). Leave empty to require E.164 input.
        'default_country_code' => env('SMS_DEFAULT_COUNTRY_CODE', ''),

        'twilio' => [
            'account_sid' => env('TWILIO_ACCOUNT_SID'),
            'auth_token' => env('TWILIO_AUTH_TOKEN'),
            'from' => env('TWILIO_FROM'),
        ],

        'textit' => [
            'base_url' => env('TEXTIT_BASE_URL', 'https://api.textit.biz/'),
            'api_version' => env('TEXTIT_API_VERSION', 'v1'),
            // Expect full header value, e.g. "Basic ABCDEFGHIJKLKMNOPQRSTUV"
            'authorization' => env('TEXTIT_AUTHORIZATION'),
            'timeout' => env('TEXTIT_TIMEOUT', 10),
        ],
    ],

];
