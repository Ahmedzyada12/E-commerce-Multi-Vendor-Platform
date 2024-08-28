<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'street_address',
        'city',
        'postal_code',
        'country',
        'vendor_id',
        'user_id',
        'total_price',
        'coupon_code',
        'discount',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
  
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,);
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class,);
    }
    public function product()
    {
        return $this->belongsToMany(Product::class,);
    }
}