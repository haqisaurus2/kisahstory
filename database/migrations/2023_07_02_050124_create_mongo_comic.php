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
        Schema::create('mongo_comics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('uuid');
            $table->string('title', 500);
            $table->string('author');
            $table->string('url', 500);
            $table->string('bg', 500);
            $table->string('genre');
            $table->string('how_to_read');
            $table->string('status');
            $table->string('thumbnail');
            $table->longText('description');
            $table->float('last_chapter', 8, 2);
            $table->longText('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mongo_comics');
    }
};
