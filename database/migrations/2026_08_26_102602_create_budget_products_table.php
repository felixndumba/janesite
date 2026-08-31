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
        Schema::create('budget_products', function (Blueprint $table) {
            $table->id();

            // Product information
            $table->string('name');
            $table->text('description')->nullable();

            // Price in Kenyan Shillings
            $table->decimal('price', 10, 2);

            // Public PDF preview
            $table->string('preview_file')->nullable();

            // Private Excel file
            $table->string('excel_file');

            // Allow admin to enable/disable product
            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_products');
    }
};