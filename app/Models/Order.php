<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable=[
        'user_id','sales_staff_id','order_number','offline_receipt_no',
        'sub_total','quantity','delivery_charge','status','order_source',
        'total_amount','first_name','last_name','country','post_code','address1','address2','address3','phone','email',
        'district',
        'payment_method','payment_gateway','payment_reference','payment_status',
        'shipping_id','courier_id','courier_name','courier_tracking_number','shipped_at','delivered_at',
        'returned_at','return_reason',
        'social_platform','social_order_ref',
        'coupon','notes',
        'emergency_contact'
    ];

    protected $casts = [
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public static function nextOrderNumber(): string
    {
        return static::nextAlphaNumericSequence('order_number', 'ORD');
    }

    /**
     * Generates next sequence like PREFIX-A0001 ... PREFIX-A9999 then PREFIX-B0001, etc.
     */
    private static function nextAlphaNumericSequence(string $column, string $prefix): string
    {
        $driver = DB::getDriverName();

        $pattern = '^' . $prefix . '-[A-Z][0-9]{4}$';
        $regex = '/^' . preg_quote($prefix, '/') . '-([A-Z])(\d{4})$/';

        $query = static::query()
            ->select([$column])
            ->whereNotNull($column)
            ->where($column, '!=', '');

        // Optimized ordering for MySQL/MariaDB so we can safely find the max sequence.
        if (in_array($driver, ['mysql', 'mariadb'], true)) {
            $letterPos = strlen($prefix) + 2; // after "PREFIX-"
            $numPos = strlen($prefix) + 3;

            $query
                ->where($column, 'REGEXP', $pattern)
                ->orderByRaw("SUBSTRING(`$column`, $letterPos, 1) DESC")
                ->orderByRaw("CAST(SUBSTRING(`$column`, $numPos, 4) AS UNSIGNED) DESC");
        } else {
            // Fallback: still works, but relies on recency.
            $query->where($column, 'like', $prefix . '-%')->orderByDesc('id');
        }

        $last = $query->first();
        if (!$last) {
            return sprintf('%s-A%04d', $prefix, 1);
        }

        $value = (string) ($last->{$column} ?? '');
        if (!preg_match($regex, $value, $m)) {
            return sprintf('%s-A%04d', $prefix, 1);
        }

        $letter = $m[1];
        $number = (int) $m[2];

        if ($number >= 9999) {
            $nextLetter = chr(ord($letter) + 1);
            if ($nextLetter > 'Z') {
                throw new \RuntimeException("$prefix sequence exhausted at Z9999");
            }
            $letter = $nextLetter;
            $number = 1;
        } else {
            $number++;
        }

        return sprintf('%s-%s%04d', $prefix, $letter, $number);
    }

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

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
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
