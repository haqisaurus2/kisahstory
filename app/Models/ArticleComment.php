<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    use HasFactory;
    protected $table = 'article_comments';
    protected $fillable = ['user_id', 'chapter_id', 'parent_id', 'body'];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(ArticleComment::class, 'parent_id')->orderByDesc('created_at');
    }
}
