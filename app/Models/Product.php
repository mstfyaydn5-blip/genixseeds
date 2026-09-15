<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_category_id', 'brand', 'sku', 'name_en', 'name_ar', 'slug',
        'short_description_en', 'short_description_ar', 'description_en', 'description_ar',
        'image', 'gallery', 'specifications', 'unit_en', 'unit_ar', 'price',
        'meta_title_en', 'meta_title_ar', 'meta_description_en', 'meta_description_ar',
        'order', 'is_featured', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'specifications' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'price' => 'decimal:2',
        ];
    }

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getShortDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->short_description_ar : $this->short_description_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }

    public function getUnitAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->unit_ar : $this->unit_en;
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBrand($query, $brand)
    {
        return $query->where('brand', $brand);
    }
}
