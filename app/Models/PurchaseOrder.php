<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    use HasFactory;
    use Auditable;

    protected $fillable = [
        'company_id',
        'supplier_id',
        'warehouse_id',
        'user_id',
        'po_number',
        'status',
        'subtotal',
        'tax',
        'shipping_cost',
        'total',
        'notes',
        'ordered_at',
        'expected_at',
        'approved_at',
        'received_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'tax' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
            'total' => 'decimal:2',
            'ordered_at' => 'datetime',
            'expected_at' => 'datetime',
            'approved_at' => 'datetime',
            'received_at' => 'datetime',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isOrdered(): bool
    {
        return $this->status === 'ordered';
    }

    public function isReceived(): bool
    {
        return $this->status === 'received';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'Draft',
            'pending' => 'Pending',
            'approved' => 'Approved',
            'ordered' => 'Ordered',
            'received' => 'Received',
            'cancelled' => 'Cancelled',
            default => ucfirst($this->status),
        };
    }
}