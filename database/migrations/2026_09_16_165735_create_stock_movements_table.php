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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('warehouse_id')
                ->constrained('warehouses')
                ->restrictOnDelete();

            $table->foreignId('product_variant_id')
                ->constrained('product_variants')
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('type', [
                'purchase',
                'sale',
                'return',
                'damage',
                'adjustment',
                'transfer_in',
                'transfer_out',
            ]);

            $table->integer('quantity');

            $table->string('reference_type')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('company_id');
            $table->index(['company_id', 'created_at']);
            $table->index([
                'reference_type',
                'reference_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};