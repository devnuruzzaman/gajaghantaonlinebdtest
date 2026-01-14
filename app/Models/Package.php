<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'download_speed',
        'upload_speed',
        'type',
        'status',
        'validity_days',
        'notes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'download_speed' => 'integer',
        'upload_speed' => 'integer',
        'validity_days' => 'integer',
    ];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active' => '<span class="badge badge-success">Active</span>',
            'inactive' => '<span class="badge badge-secondary">Inactive</span>',
            default => '<span class="badge badge-secondary">Unknown</span>',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'pppoe' => 'PPPoE',
            'hotspot' => 'Hotspot',
            'static' => 'Static IP',
            default => 'Unknown',
        };
    }

    public function getSpeedLabelAttribute(): string
    {
        return "{$this->download_speed}Mbps/{$this->upload_speed}Mbps";
    }

    public function getCustomerCountAttribute(): int
    {
        return $this->customers()->count();
    }
}
