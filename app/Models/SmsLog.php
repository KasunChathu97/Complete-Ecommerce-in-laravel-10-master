<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable = [
        'order_id',
        'phone',
        'message',
        'provider',
        'status',
        'sent_at',
        'provider_response',
        'created_by',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function creator()
    {
        return $this->belongsTo('App\\User', 'created_by');
    }
}
