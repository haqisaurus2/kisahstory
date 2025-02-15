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
        Schema::table('story_sections', function (Blueprint $table) {
            $table->longText('base64')->nullable();
            $table->string('mime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('story_sections', function (Blueprint $table) {
            $table->dropColumn('base64');
            $table->dropColumn('mime');
        });
    }
};
