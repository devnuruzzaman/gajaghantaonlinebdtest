<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'username',
        'password',
        'package_id',
        'router_id',
        'pop_id',
        'status',
        'is_waiver',
        'is_blocked',
        'is_online',
        'connection_date',
        'expiry_date',
        'billing_due_date',
        'is_extended',
        'monthly_fee',
        'notes',
    ];

    protected $casts = [
        'connection_date' => 'date',
        'expiry_date' => 'date',
        'billing_due_date' => 'date',
        'is_waiver' => 'boolean',
        'is_blocked' => 'boolean',
        'is_online' => 'boolean',
        'is_extended' => 'boolean',
        'monthly_fee' => 'decimal:2',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function router(): BelongsTo
    {
        return $this->belongsTo(Router::class);
    }

    public function pop(): BelongsTo
    {
        return $this->belongsTo(Pop::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'active' => '<span class="badge badge-success">Active</span>',
            'inactive' => '<span class="badge badge-secondary">Inactive</span>',
            'suspended' => '<span class="badge badge-warning">Suspended</span>',
            'expired' => '<span class="badge badge-danger">Expired</span>',
            default => '<span class="badge badge-secondary">Unknown</span>',
        };
    }

    public function getDaysUntilExpiryAttribute(): int
    {
        if (!$this->expiry_date) {
            return 0;
        }
        return max(0, now()->diffInDays($this->expiry_date));
    }

    public function isExpired(): bool
    {
        return $this->expiry_date && now()->isAfter($this->expiry_date);
    }

    public function isExpiringSoon(int $days = 7): bool
    {
        return $this->expiry_date && now()->copy()->addDays($days)->isAfter($this->expiry_date);
    }
}
