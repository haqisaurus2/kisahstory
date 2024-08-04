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
        Schema::create('mongo_chapters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('update');
            $table->float('order', 8, 2);
            $table->string('link', 500);
            $table->foreignId('comic_id')->references('id')->on('mongo_comics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mongo_chapters');
    }
};
