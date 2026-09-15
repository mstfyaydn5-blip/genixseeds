<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name', 'position_en', 'position_ar', 'company', 'message_en', 'message_ar',
        'image', 'rating', 'order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function getPositionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->position_ar : $this->position_en;
    }

    public function getMessageAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->message_ar : $this->message_en;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
