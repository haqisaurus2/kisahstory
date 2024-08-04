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
        Schema::create('article_stories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->string('title', 500);
            $table->longText('meta');
            $table->longText('content');
            $table->string('slug', 500);
            $table->string('status', 30);
            $table->bigInteger('reader_count');
            $table->float('rating', 8, 2);
            $table->string('thumbnail', 500);
            $table->foreignId('user_id')->references('id')->on('auth_users');
            $table->foreignId('category_id')->references('id')->on('article_categories');
            $table->foreignId('story_id')->references('id')->on('stories')->nullable();
            $table->string('source_url', 500);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_stories');
    }
};
