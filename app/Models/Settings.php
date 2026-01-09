<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=[
        'short_des',
        'description',
        'vision',
        'mission',
        'commitment_energy_independence',
        'specialized_product_range',
        'why_choose_delimach_lanka',
        'photo',
        'address',
        'phone',
        'email',
        'logo',
        'facebook',
        'instagram',
        'youtube',
        'twitter',
        'whatsapp',
    ];
}
