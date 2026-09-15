<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    public static function get(string $key, $default = null)
{
    try {
        $settings = Cache::rememberForever('settings.all', function () {
            return static::all()->pluck('value', 'key')->toArray();
        });
    } catch (\Throwable $e) {
        Cache::forget('settings.all');
        $settings = static::all()->pluck('value', 'key')->toArray();
    }

    return $settings[$key] ?? $default;
}

    public static function set(string $key, $value, string $group = 'general'): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
        Cache::forget('settings.all');
    }

    protected static function booted()
    {
        static::saved(fn () => Cache::forget('settings.all'));
        static::deleted(fn () => Cache::forget('settings.all'));
    }
}
