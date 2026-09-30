<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('invoice_id')
                ->constrained('invoices')
                ->restrictOnDelete();

            $table->decimal('amount', 15, 2);

            $table->enum('method', [
                'cash',
                'bank_transfer',
                'credit_card',
                'debit_card',
                'e_wallet',
                'other',
            ]);

            $table->enum('status', [
                'pending',
                'completed',
                'failed',
                'refunded',
            ])->default('completed');

            $table->string('reference')->nullable();

            $table->text('notes')->nullable();

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->index('company_id');
            $table->index('invoice_id');
            $table->index(['company_id', 'status']);
            $table->index(['company_id', 'paid_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};