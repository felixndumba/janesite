<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Kept for compatibility if you later decide to implement verification.
            // Currently, reviews UI will no longer use a hard-coded verified label.
            $table->boolean('is_verified')->default(false)->after('organisation');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('is_verified');
        });
    }
};

