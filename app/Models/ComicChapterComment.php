<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicChapterComment extends Model
{
    use HasFactory;
    protected $table = 'story_chapter_comments';
    protected $fillable = ['user_id', 'chapter_id', 'parent_id', 'body'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(ComicChapterComment::class, 'parent_id')->orderByDesc('created_at');
    }
}
