<?php

namespace App\Mail;

use App\Models\Settings;
use App\Models\SmsLog;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SmsLogAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public SmsLog $smsLog;
    public string $recipientType;

    public function __construct(SmsLog $smsLog, string $recipientType = 'admin')
    {
        $this->smsLog = $smsLog;
        $this->recipientType = $recipientType;
    }

    public function build()
    {
        $settings = Settings::query()->first();

        $fromAddress = (string) (config('mail.from.address') ?? '');
        if ($fromAddress === '') {
            if ($settings && !empty($settings->email)) {
                $this->from($settings->email, (string) config('app.name'));
            }
        }

        $orderNumber = optional($this->smsLog->order)->order_number;
        $subject = $orderNumber
            ? 'SMS Log: '.$orderNumber
            : 'SMS Log Notification';

        return $this->subject($subject)
            ->view('emails.sms-log-alert', [
                'appName' => (string) config('app.name'),
            ]);
    }
}
