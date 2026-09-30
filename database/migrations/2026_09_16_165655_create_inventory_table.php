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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();

            $table->foreignId('warehouse_id')
                ->constrained('warehouses')
                ->cascadeOnDelete();

            $table->foreignId('product_variant_id')
                ->constrained('product_variants')
                ->cascadeOnDelete();

            $table->integer('quantity')->default(0);
            $table->integer('reserved_quantity')->default(0);
            $table->integer('reorder_level')->default(0);

            $table->timestamps();

            $table->unique([
                'warehouse_id',
                'product_variant_id'
            ]);

            $table->index('warehouse_id');
            $table->index('product_variant_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};