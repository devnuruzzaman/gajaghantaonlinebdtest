<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Router extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ip_address',
        'username',
        'password',
        'port',
        'type',
        'description',
        'status',
        'last_seen',
        'notes',
    ];

    protected $casts = [
        'port' => 'integer',
        'last_seen' => 'datetime',
    ];

    protected $hidden = [
        'password',
    ];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'online' => '<span class="badge badge-success">Online</span>',
            'offline' => '<span class="badge badge-danger">Offline</span>',
            'error' => '<span class="badge badge-warning">Error</span>',
            default => '<span class="badge badge-secondary">Unknown</span>',
        };
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'mikrotik' => 'MikroTik',
            'cisco' => 'Cisco',
            'other' => 'Other',
            default => 'Unknown',
        };
    }

    public function getCustomerCountAttribute(): int
    {
        return $this->customers()->count();
    }

    public function isOnline(): bool
    {
        return $this->status === 'online';
    }

    public function getConnectionUrlAttribute(): string
    {
        return "{$this->ip_address}:{$this->port}";
    }
}
