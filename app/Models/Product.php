<?php

namespace App\Models;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['name', 'description'];

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,);
    }
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'product_id');
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }
    public function colorproduct()
    {
        return $this->belongsToMany(ProductColor::class, 'product_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}