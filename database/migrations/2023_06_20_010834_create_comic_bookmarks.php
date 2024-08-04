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
        Schema::create('story_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->foreignId('story_id')->nullable()->references('id')->on('stories')->onDelete('cascade'); 
            $table->foreignId('chapter_id')->nullable()->references('id')->on('story_chapters')->onDelete('cascade'); 
            $table->foreignId('section_id')->nullable()->references('id')->on('story_sections')->onDelete('cascade'); 
            $table->foreignId('user_id')->nullable()->references('id')->on('auth_users')->onDelete('cascade'); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_bookmarks');
    }
};
