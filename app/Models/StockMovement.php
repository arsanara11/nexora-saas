<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StockMovement extends Model
{
    use HasFactory;
    use Auditable;

    protected $fillable = [
        'company_id',
        'warehouse_id',
        'product_variant_id',
        'user_id',
        'type',
        'quantity',
        'reference_type',
        'reference_id',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            'purchase' => 'Purchase',
            'sale' => 'Sale',
            'adjustment' => 'Adjustment',
            'transfer' => 'Transfer',
            'return' => 'Return',
            default => ucfirst($this->type),
        };
    }
}