<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ComicChapter extends Model
{
    use HasFactory;
    protected $table = 'story_chapters';
    protected $fillable = ['title', 'slug', 'meta', 'order', 'rating', 'reader_count', 'story_id', 'created_at']; 
    public function story(): BelongsTo
    {
        return $this->belongsTo(ComicStory::class, 'story_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(ComicSection::class, 'chapter_id', 'id')->orderBy('order');
    }
    public function sectionFirst()
    {
        return $this->hasOne(ComicSection::class, 'chapter_id', 'id')->latestOfMany();
    }
    public function comments(): HasMany
    {
        return $this->hasMany(ComicChapterComment::class, 'chapter_id', 'id')->whereNull('parent_id')->orderByDesc('created_at');
    }
}
