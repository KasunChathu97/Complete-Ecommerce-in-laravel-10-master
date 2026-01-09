<?php

namespace App\Console\Commands;

use App\Models\SmsLog;
use Illuminate\Console\Command;

class SmsLogNotifyTest extends Command
{
    protected $signature = 'smslog:notify-test {--phone=1000000000} {--message=Test SMS Log entry} {--order_id=}';

    protected $description = 'Creates a test sms_logs row to trigger email/SMS notifications and prints the resulting status.';

    public function handle(): int
    {
        $smsLog = SmsLog::create([
            'order_id' => $this->option('order_id') ?: null,
            'phone' => (string) $this->option('phone'),
            'message' => (string) $this->option('message'),
            'provider' => null,
            'status' => 'queued',
            'sent_at' => null,
            'provider_response' => null,
            'created_by' => null,
        ]);

        // Reload to get observer updates
        $smsLog->refresh();

        $this->info('Created SmsLog #'.$smsLog->id);
        $this->line('status: '.$smsLog->status);
        $this->line('provider: '.($smsLog->provider ?? 'null'));
        $this->line('provider_response: '.($smsLog->provider_response ?? 'null'));

        $this->comment('Tip: Set SMS_ENABLED=true + Twilio env vars to actually send SMS.');

        return self::SUCCESS;
    }
}
