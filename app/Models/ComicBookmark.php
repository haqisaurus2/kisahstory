<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComicBookmark extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'story_id', 'chapter_id', "section_id" ]; 
    public function user(): BelongsTo
    {
        return $this->belongsTo(AuthUser::class, 'user_id');
    }
    public function story(): BelongsTo
    {
        return $this->belongsTo(ComicStory::class, 'story_id');
    }
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(ComicChapter::class, 'chapter_id');
    }
    public function section(): BelongsTo
    {
        return $this->belongsTo(ComicSection::class, 'section_id');
    }
}
