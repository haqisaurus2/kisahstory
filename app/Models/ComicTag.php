<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ComicTag extends Model
{
    use HasFactory;
    protected $table = 'story_tags';
    protected $fillable = ['name', 'slug']; 
     public function stories(): BelongsToMany
    {
        return $this->belongsToMany(ComicStory::class, 'stories_tags', 'tag_id', 'story_id') ;
    }
}
