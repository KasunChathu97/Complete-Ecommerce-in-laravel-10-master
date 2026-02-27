<?php

namespace App\Http\Controllers;

use App\Models\SmsLog;
use Illuminate\Http\Request;

class SmsLogController extends Controller
{
    public function index()
    {
        $query = SmsLog::with(['order', 'creator'])->latest();

        if (auth()->check() && auth()->user()->role === 'sales_admin') {
            $query->whereHas('order', function ($q) {
                $q->where('sales_staff_id', auth()->id());
            });
        }

        $smsLogs = $query->paginate(50);

        return view('backend.sms-log.index', compact('smsLogs'));
    }
}
