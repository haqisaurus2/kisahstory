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
        Schema::create('stories_tags', function (Blueprint $table) { 
            $table->foreignId('story_id')->references('id')->on('stories')->onDelete('cascade');  
            $table->foreignId('tag_id')->references('id')->on('story_tags')->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories_tags');
    }
};
