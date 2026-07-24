<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'sale_price',
        'badge',
        'stock',
        'image',
        'status',
    ];

    /* =========================
       Relationships
    ========================== */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /* =========================
       Accessors
    ========================== */

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('storage/' . $this->image))) {
            return asset('storage/' . $this->image);
        }

        return 'https://via.placeholder.com/400x400?text=No+Image';
    }

    public function getFinalPriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    public function getDiscountPercentAttribute()
    {
        if (!$this->sale_price) return 0;

        return round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    public function getReviewCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function isOnSale()
    {
        return !is_null($this->sale_price);
    }
}