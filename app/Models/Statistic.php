<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $fillable = ['label_en', 'label_ar', 'value', 'suffix', 'icon', 'order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function getLabelAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->label_ar : $this->label_en;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
