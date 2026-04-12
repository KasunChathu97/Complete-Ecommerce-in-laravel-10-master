<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesAdminProductStock extends Model
{
    protected $fillable = [
        'sales_admin_id',
        'product_id',
        'quantity',
    ];

    public function salesAdmin()
    {
        return $this->belongsTo('App\\User', 'sales_admin_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
