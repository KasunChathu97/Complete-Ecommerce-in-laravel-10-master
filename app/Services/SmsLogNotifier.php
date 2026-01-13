<?php

namespace App\Services;

use App\Mail\SmsLogAlertMail;
use App\Models\Settings;
use App\Models\SmsLog;
use App\Services\Sms\SmsManager;
use App\User;
use Illuminate\Support\Facades\Mail;

class SmsLogNotifier
{
    public function notify(SmsLog $smsLog): void
    {
        $smsLog->loadMissing(['order.user']);

        $settings = Settings::query()->first();

        // Admin contact details come from Settings (as provided in the admin Settings page).
        // If Settings.email is missing for some reason, fall back to admin users.
        $adminEmails = [];
        if ($settings && !empty($settings->email)) {
            $adminEmails[] = $settings->email;
        } else {
            $adminEmails = User::query()
                ->where('role', 'admin')
                ->pluck('email')
                ->filter()
                ->values()
                ->all();
        }
        $adminEmails = array_values(array_unique(array_filter($adminEmails)));

        // Customer contact details come from checkout Order fields first.
        $customerEmail = null;
        if ($smsLog->order && !empty($smsLog->order->email)) {
            $customerEmail = $smsLog->order->email;
        } elseif ($smsLog->order && $smsLog->order->user && !empty($smsLog->order->user->email)) {
            $customerEmail = $smsLog->order->user->email;
        }

        // Email notifications
        // Email notifications (disabled)
        // foreach ($adminEmails as $email) {
        //     try {
        //         Mail::to($email)->send(new SmsLogAlertMail($smsLog, 'admin'));
        //     } catch (\Throwable $e) {
        //         logger()->error('SMS Log admin email send failed', [
        //             'sms_log_id' => $smsLog->id,
        //             'email' => $email,
        //             'error' => $e->getMessage(),
        //         ]);
        //     }
        // }

        // if (!empty($customerEmail)) {
        //     try {
        //         Mail::to($customerEmail)->send(new SmsLogAlertMail($smsLog, 'customer'));
        //     } catch (\Throwable $e) {
        //         logger()->error('SMS Log customer email send failed', [
        //             'sms_log_id' => $smsLog->id,
        //             'email' => $customerEmail,
        //             'error' => $e->getMessage(),
        //         ]);
        //     }
        // }

        // SMS notifications (via API)
        $enabled = (bool) config('services.sms.enabled', false);
        if (!$enabled) {
            // Don't overwrite final statuses; only annotate queued logs.
            if ($smsLog->status === 'queued' && empty($smsLog->provider_response)) {
                $smsLog->forceFill([
                    'status' => 'skipped',
                    'provider' => $smsLog->provider ?: config('services.sms.provider'),
                    'provider_response' => 'SMS sending disabled (services.sms.enabled=false).',
                ])->save();
            }
            return;
        }

        $smsManager = new SmsManager();
        $provider = $smsManager->provider();

        $customerPhone = (string) $smsLog->phone;
        $adminPhone = $settings ? (string) $settings->phone : '';

        try {
            // Send to customer (this is what the sms_logs entry represents)
            $resultCustomer = $provider->send($customerPhone, (string) $smsLog->message);

            $smsLog->forceFill([
                'provider' => $resultCustomer['provider'] ?? ($smsLog->provider ?: config('services.sms.provider')),
                'status' => 'sent',
                'sent_at' => now(),
                'provider_response' => $resultCustomer['raw'] ?? null,
            ])->save();

            // Also notify admin via SMS (do NOT create another SmsLog to avoid recursion)
            if ($adminPhone !== '' && $adminPhone !== $customerPhone) {
                $provider->send($adminPhone, (string) $smsLog->message);
            }
        } catch (\Throwable $e) {
            logger()->error('SMS Log SMS send failed', [
                'sms_log_id' => $smsLog->id,
                'error' => $e->getMessage(),
            ]);
            $smsLog->forceFill([
                'provider' => $smsLog->provider ?: config('services.sms.provider'),
                'status' => 'failed',
                'sent_at' => now(),
                'provider_response' => $e->getMessage(),
            ])->save();
        }
    }
}
