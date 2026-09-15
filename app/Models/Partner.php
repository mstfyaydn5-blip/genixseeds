<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'logo', 'website_url', 'order', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function getLogoUrlAttribute(): string
    {
        if (! $this->logo) {
            return 'https://dummyimage.com/160x60/e6f4ea/1b6b39.png&text=' . urlencode($this->name);
        }

        return str_starts_with($this->logo, 'http') ? $this->logo : asset('storage/' . $this->logo);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
