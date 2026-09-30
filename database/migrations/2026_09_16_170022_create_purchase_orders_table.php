<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('supplier_id')
                ->constrained('suppliers')
                ->restrictOnDelete();

            $table->foreignId('warehouse_id')
                ->constrained('warehouses')
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('po_number');

            $table->enum('status', [
                'draft',
                'pending_approval',
                'approved',
                'partially_received',
                'received',
                'cancelled',
            ])->default('draft');

            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('shipping_cost', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            $table->text('notes')->nullable();

            $table->timestamp('ordered_at')->nullable();
            $table->timestamp('expected_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('received_at')->nullable();

            $table->timestamps();

            $table->unique(['company_id', 'po_number']);

            $table->index('company_id');
            $table->index(['company_id', 'status']);
            $table->index(['company_id', 'ordered_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};