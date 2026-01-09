<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'user_id','sales_staff_id','order_number','offline_receipt_no',
        'sub_total','quantity','delivery_charge','status','order_source',
        'total_amount','first_name','last_name','country','post_code','address1','address2','phone','email',
        'payment_method','payment_gateway','payment_reference','payment_status',
        'shipping_id','courier_name','tracking_number','shipped_at','delivered_at',
        'social_platform','social_order_ref',
        'coupon','notes'
    ];

    public function cart_info(){
        return $this->hasMany('App\Models\Cart','order_id','id');
    }
    public static function getAllOrder($id){
        return Order::with(['cart_info.product','shipping','user'])->find($id);
    }
    public static function countActiveOrder(){
        $data=Order::count();
        if($data){
            return $data;
        }
        return 0;
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function salesStaff()
    {
        return $this->belongsTo('App\User', 'sales_staff_id');
    }

    public function shipmentTrackings()
    {
        return $this->hasMany(ShipmentTracking::class);
    }

    public function smsLogs()
    {
        return $this->hasMany(SmsLog::class);
    }

}
