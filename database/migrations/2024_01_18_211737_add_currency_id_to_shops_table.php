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
        Schema::table('shops', function (Blueprint $table) {
            $table->foreignId('currency_id')->constrained()->onDelete('cascade')->after('subdomain')->default(1);
        });

        Schema::table('user_points_histories', function (Blueprint $table) {
            $table->foreignId('currency_id')->constrained()->onDelete('cascade')->after('import');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->dropConstrainedForeignId('currency_id');
        });

        Schema::table('user_points_histories', function (Blueprint $table) {
            $table->dropConstrainedForeignId('currency_id');
            $table->dropColumn('deleted_at');
        });
    }
};
