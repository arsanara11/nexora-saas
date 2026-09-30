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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_order_id')
                ->constrained('purchase_orders')
                ->cascadeOnDelete();

            $table->foreignId('product_variant_id')
                ->constrained('product_variants')
                ->restrictOnDelete();

            $table->string('product_name');
            $table->string('sku');

            $table->integer('quantity');
            $table->integer('received_quantity')->default(0);

            $table->decimal('unit_cost', 15, 2);
            $table->decimal('total', 15, 2);

            $table->timestamps();

            $table->index('purchase_order_id');
            $table->index('product_variant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};