<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_request_id')->nullable();
            $table->string('checkout_request_id')->nullable()->index();
            $table->string('result_code')->nullable();
            $table->string('result_desc')->nullable();

            $table->string('amount')->nullable();
            $table->string('mpesa_receipt_number')->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('transaction_date')->nullable();

            $table->json('raw_payload')->nullable();
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('payments');
    }
};
