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
        Schema::create('budget_purchases', function (Blueprint $table) {
            $table->id();

            $table->foreignId('budget_product_id')
                ->constrained('budget_products')
                ->cascadeOnDelete();

            // Customer details
            $table->string('customer_name')->nullable();
            $table->string('customer_email');
            $table->string('customer_phone');

            // Payment information
            $table->decimal('amount', 10, 2);

            $table->string('checkout_request_id')
                ->nullable()
                ->index();

            $table->string('merchant_request_id')
                ->nullable();

            $table->string('mpesa_receipt')
                ->nullable();

            $table->enum('status', [
                'pending',
                'paid',
                'failed',
            ])->default('pending')->index();

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_purchases');
    }
};