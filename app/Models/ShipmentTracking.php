<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentTracking extends Model
{
    protected $fillable = [
        'order_id',
        'status',
        'location',
        'description',
        'event_time',
        'created_by',
    ];

    protected $casts = [
        'event_time' => 'datetime',
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
