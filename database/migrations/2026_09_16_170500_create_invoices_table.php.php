<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->restrictOnDelete();

            $table->string('invoice_number');

            $table->enum('status', [
                'draft',
                'issued',
                'paid',
                'overdue',
                'cancelled',
            ])->default('draft');

            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('shipping_cost', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);

            $table->timestamp('due_at')->nullable();
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('paid_at')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['company_id', 'invoice_number']);
            $table->unique('order_id');

            $table->index('company_id');
            $table->index(['company_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};