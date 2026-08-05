<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Courier;
use App\Models\SalesAdminProductStock;
class Product extends Model
{
    protected $appends = ['product_number'];

    protected $fillable=[
        'title','slug','summary','description','see_more_description','youtube_link','cat_id','child_cat_id','price','purchase_price','sale_price','wholesale_price','wholesale_min_qty','brand_id','discount','status','photo','size','stock','is_featured','condition','warranty','returns',
        'bulk_discount_type','bulk_discount_threshold','bulk_discount_amount','bulk_discount_amount_type',
        'weight',
        'free_shipping',
        'free_shipping_enabled',
        'courier_id',
        'seller_edit_count'
    ];

    protected $casts = [
        'free_shipping' => 'boolean',
        'free_shipping_enabled' => 'boolean',
    ];

    public function getPriceAttribute($value)
    {
        // Backwards compatible: treat sale_price as the canonical selling price.
        // Existing code across the app expects to read `$product->price`.
        $salePrice = $this->attributes['sale_price'] ?? null;
        return $salePrice !== null ? $salePrice : $value;
    }

    public function setSalePriceAttribute($value): void
    {
        $this->attributes['sale_price'] = $value;
        // Keep legacy column in sync (many queries/exports rely on `price`).
        $this->attributes['price'] = $value;
    }

    public function setPriceAttribute($value): void
    {
        // Legacy writes: if something sets `price`, also set sale_price.
        $this->attributes['price'] = $value;
        if (!array_key_exists('sale_price', $this->attributes) || $this->attributes['sale_price'] === null) {
            $this->attributes['sale_price'] = $value;
        }
    }

    public function getProductNumberAttribute(): string
    {
        $id = (string) ($this->attributes['id'] ?? '');
        if ($id === '') {
            return '';
        }
        return 'PRD-' . str_pad($id, 6, '0', STR_PAD_LEFT);
    }

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','child_cat_id');
    }
    public static function getAllProduct(){
        return Product::with(['cat_info','sub_cat_info','brand'])->orderBy('id','desc')->paginate(10);
    }
    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    public function getReview(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    public static function getProductBySlug($slug){
        return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();
    }
    public static function countActiveProduct(){
        $data=Product::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }


    public function brand(){
        return $this->hasOne(Brand::class,'id','brand_id');
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }

    public function salesAdminStocks()
    {
        return $this->hasMany(SalesAdminProductStock::class, 'product_id');
    }

}
