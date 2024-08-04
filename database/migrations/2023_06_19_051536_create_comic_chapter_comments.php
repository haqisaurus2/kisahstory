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
        Schema::create('story_chapter_comments', function (Blueprint $table) {
            $table->id(); 
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->foreignId('parent_id')->nullable()->references('id')->on('story_chapter_comments')->onDelete('cascade'); 
            $table->foreignId('user_id')->references('id')->on('auth_users')->onDelete('cascade'); 
            $table->foreignId('chapter_id')->references('id')->on('story_chapters')->onDelete('cascade'); 
            $table->text('body');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_chapter_comments');
    }
};
