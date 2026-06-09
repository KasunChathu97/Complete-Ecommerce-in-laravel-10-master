<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $fillable = [
        'name',
        'hotline',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}