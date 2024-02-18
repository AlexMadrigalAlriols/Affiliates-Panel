<?php

use App\Models\ShopLevel;
use App\Models\ShopLog;
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
        Schema::table('user_levels', function (Blueprint $table) {
            $table->enum('type', ShopLevel::TYPES)->after('id')->default('level');
            $table->foreignId('shop_level_id')->after('exp_progress')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_levels', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
