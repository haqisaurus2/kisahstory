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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->string('title', 500);
            $table->longText('meta');
            $table->string('slug', 500);
            $table->longText('synopsis');
            $table->string('status', 30);
            $table->bigInteger('reader_count');
            $table->string('how_to_read', 30);
            $table->float('rating', 8, 2);
            $table->string('type', 30);
            $table->string('bg', 500);
            $table->float('last_chapter', 8, 2);
            $table->bigInteger('reader_age');
            $table->string('thumbnail', 500);
            $table->foreignId('artist_id')->references('id')->on('story_artists');
            $table->foreignId('author_id')->references('id')->on('story_authors');
            $table->foreignId('category_id')->references('id')->on('story_categories');
             
            $table->string('source_url', 500);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories');
    }
};
