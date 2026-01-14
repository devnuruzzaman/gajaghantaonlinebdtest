<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    protected $casts = [
        'value' => 'string',
    ];

    /**
     * Get setting value by key with per-request memoization and long-term cache.
     */
    public static function get(string $key, $default = null)
    {
        // Per-request memoization
        static $memo = [];

        if (isset($memo[$key])) {
            return $memo[$key];
        }

        // Long-term cache (24 hours)
        $value = Cache::remember("setting.{$key}", now()->addHours(24), function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });

        $memo[$key] = $value;
        return $value;
    }

    /**
     * Set setting value by key and clear caches.
     */
    public static function set(string $key, $value, string $type = 'text', string $group = 'general')
    {
        $result = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
            ]
        );

        // Clear caches
        Cache::forget("setting.{$key}");
        static::clearRequestCache();

        return $result;
    }

    /**
     * Get all settings by group with caching.
     */
    public static function getByGroup(string $group)
    {
        return Cache::remember("settings.group.{$group}", now()->addHours(24), function () use ($group) {
            return static::where('group', $group)->pluck('value', 'key');
        });
    }

    /**
     * Clear request-level cache (useful after updates).
     */
    public static function clearRequestCache()
    {
        // No-op for now; static $memo resets per request automatically.
    }
}
