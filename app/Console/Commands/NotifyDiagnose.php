<?php

namespace App\Console\Commands;

use App\Models\Settings;
use App\Services\Sms\SmsManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyDiagnose extends Command
{
    protected $signature = 'notify:diagnose {--email=} {--phone=} {--message=Test notification}';

    protected $description = 'Diagnose email/SMS notification configuration and optionally send a direct test email + SMS.';

    public function handle(): int
    {
        $settings = Settings::query()->first();

        $this->info('--- Email config ---');
        $this->line('MAIL_MAILER: '.config('mail.default'));
        $this->line('MAIL_HOST: '.(config('mail.mailers.smtp.host') ?? 'n/a'));
        $this->line('MAIL_PORT: '.(config('mail.mailers.smtp.port') ?? 'n/a'));
        $this->line('MAIL_FROM_ADDRESS: '.(config('mail.from.address') ?? 'n/a'));

        $this->newLine();
        $this->info('--- SMS config ---');
        $this->line('services.sms.enabled: '.(config('services.sms.enabled') ? 'true' : 'false'));
        $this->line('services.sms.provider: '.(string) config('services.sms.provider'));
        $this->line('services.sms.default_country_code: '.((string) config('services.sms.default_country_code') ?: 'null'));
        $this->line('TWILIO_ACCOUNT_SID set: '.(((string) config('services.sms.twilio.account_sid')) !== '' ? 'yes' : 'no'));
        $this->line('TWILIO_AUTH_TOKEN set: '.(((string) config('services.sms.twilio.auth_token')) !== '' ? 'yes' : 'no'));
        $this->line('TWILIO_FROM set: '.(((string) config('services.sms.twilio.from')) !== '' ? 'yes' : 'no'));
        $this->line('settings.email (admin email): '.($settings->email ?? 'null'));
        $this->line('settings.phone (admin phone): '.($settings->phone ?? 'null'));

        $email = (string) ($this->option('email') ?? '');
        $phone = (string) ($this->option('phone') ?? '');
        $message = (string) $this->option('message');

        if ($email !== '') {
            $this->newLine();
            $this->info('--- Sending test email ---');
            try {
                Mail::raw('Test email from notify:diagnose at '.now().'\n\n'.$message, function ($m) use ($email) {
                    $m->to($email)->subject('Test email (notify:diagnose)');
                });
                $this->info('Email send invoked successfully.');
            } catch (\Throwable $e) {
                $this->error('Email send failed: '.$e->getMessage());
                return self::FAILURE;
            }
        }

        if ($phone !== '') {
            $this->newLine();
            $this->info('--- Sending test SMS (API) ---');
            try {
                $provider = (new SmsManager())->provider();
                $result = $provider->send($phone, $message);
                $this->info('SMS sent.');
                $this->line('provider: '.($result['provider'] ?? 'n/a'));
                $this->line('status: '.($result['status'] ?? 'n/a'));
            } catch (\Throwable $e) {
                $this->error('SMS send failed: '.$e->getMessage());
                return self::FAILURE;
            }
        }

        $this->newLine();
        $this->comment('If things still do not arrive, check storage/logs/laravel.log for details.');

        return self::SUCCESS;
    }
}
