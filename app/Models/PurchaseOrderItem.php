<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderItem extends Model
{
    use HasFactory;
    use Auditable;

    protected $fillable = [
        'purchase_order_id',
        'product_variant_id',
        'product_name',
        'sku',
        'quantity',
        'received_quantity',
        'unit_cost',
        'total',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'received_quantity' => 'integer',
            'unit_cost' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function productVariant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function getTotalAttribute(): float
    {
        return (float) $this->quantity * (float) $this->unit_cost;
    }
}