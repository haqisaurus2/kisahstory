<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class ComicStory extends Model
{
    use HasFactory;
    protected $table = 'stories';
    protected $fillable = ['title', 'meta','slug','synopsis','status','reader_count','how_to_read','rating','type','bg','last_chapter', 'reader_age', 'thumbnail', 'artist_id', 'author_id', 'category_id', 'source_url' ]; 

    public function category(): BelongsTo
    {
        return $this->belongsTo(ComicCategory::class, 'category_id');
    }
    public function artist(): BelongsTo
    {
        return $this->belongsTo(ComicArtist::class, 'artist_id');
    }
    public function author(): BelongsTo
    {
        return $this->belongsTo(ComicAuthor::class, 'author_id');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(ComicChapter::class, 'story_id', 'id')->orderByDesc('order');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ComicTag::class, 'stories_tags', 'story_id', 'tag_id') ;
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ComicComment::class, 'story_id', 'id')->whereNull('parent_id')->orderByDesc('created_at'); 
    }
}
