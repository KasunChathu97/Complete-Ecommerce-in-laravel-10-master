<?php

namespace App\Http\Controllers;

use App\Models\SmsLog;
use Illuminate\Http\Request;

class SmsLogController extends Controller
{
    public function index()
    {
        $smsLogs = SmsLog::with(['order', 'creator'])
            ->latest()
            ->paginate(50);

        return view('backend.sms-log.index', compact('smsLogs'));
    }
}
