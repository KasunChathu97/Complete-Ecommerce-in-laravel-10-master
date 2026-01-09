<?php

namespace App\Observers;

use App\Models\SmsLog;
use App\Services\SmsLogNotifier;

class SmsLogObserver
{
    public function created(SmsLog $smsLog): void
    {
        app(SmsLogNotifier::class)->notify($smsLog);
    }
}
