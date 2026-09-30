<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')
                ->constrained('companies')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->string('category');

            $table->string('description');

            $table->decimal('amount', 15, 2);

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'paid',
            ])->default('pending');

            $table->date('expense_date');

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('company_id');
            $table->index('user_id');
            $table->index(['company_id', 'status']);
            $table->index(['company_id', 'expense_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};