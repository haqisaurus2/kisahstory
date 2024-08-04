<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mongo_comics', function (Blueprint $table) {
             
            $table->timestamp('scrap_date')->nullable();
            $table->timestamp('sync_date')->nullable();
             
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mongo_comics', function (Blueprint $table) {
             
            $table->dropColumn('scrap_date');
            $table->dropColumn('sync_date');
             
        });
    }
};
