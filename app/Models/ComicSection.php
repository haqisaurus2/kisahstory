<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicSection extends Model
{
    use HasFactory;
    protected $table = 'story_sections';
    protected $fillable = ['content', 'slug', 'alt1', 'order', 'alt2', 'chapter_id' ]; 
}
