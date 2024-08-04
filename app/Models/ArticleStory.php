<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleStory extends Model
{
    use HasFactory;
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }
    public function comic(): BelongsTo
    {
        return $this->belongsTo(ComicStory::class, 'story_id');
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ArticleTag::class, 'article_stories_tags', 'article_id', 'tag_id') ;
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(ArticleComment::class, 'article_id', 'id')->whereNull('parent_id')->orderByDesc('created_at');
    }
}
