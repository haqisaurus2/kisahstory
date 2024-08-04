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
        Schema::create('story_chapters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->string('title', 300);
            $table->string('slug', 500);
            $table->longText('meta');
            $table->float('order', 8, 2);
            $table->float('rating', 8, 2);
            $table->bigInteger('reader_count');
            $table->foreignId('story_id')->references('id')->on('stories');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_chapters');
    }
};
