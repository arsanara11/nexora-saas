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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->string('sku');
            $table->string('name')->nullable();

            $table->decimal('price', 15, 2);
            $table->decimal('cost_price', 15, 2)->nullable();

            $table->string('barcode')->nullable();
            $table->json('attributes')->nullable();
            $table->string('image')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->unique(['company_id', 'sku']);
            $table->index('company_id');
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};