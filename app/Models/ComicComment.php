<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicComment extends Model
{
    protected $table = 'story_comments';

    use HasFactory;
    protected $fillable = ['user_id', 'story_id', 'parent_id', 'body'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function replies()
    {
        return $this->hasMany(ComicComment::class, 'parent_id')->orderByDesc('created_at');
    }
}
