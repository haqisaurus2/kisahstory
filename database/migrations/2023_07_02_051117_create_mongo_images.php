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
        Schema::create('mongo_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('order', 8, 2);
            $table->string('src', 500);
            $table->foreignId('chapter_id')->references('id')->on('mongo_chapters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mongo_images');
    }
};
