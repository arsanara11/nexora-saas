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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('customer_id')
                ->nullable()
                ->constrained('customers')
                ->nullOnDelete();

            $table->foreignId('warehouse_id')
                ->constrained('warehouses')
                ->restrictOnDelete();

            $table->string('order_number');

            $table->enum('status', [
                'pending',
                'confirmed',
                'processing',
                'completed',
                'cancelled',
            ])->default('pending');

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'refunded',
            ])->default('pending');

            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('shipping_cost', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            $table->text('notes')->nullable();

            $table->timestamp('ordered_at')->nullable();

            $table->timestamps();

            $table->unique(['company_id', 'order_number']);

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
        Schema::dropIfExists('orders');
    }
};