<?php

namespace App\Models\mongo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comic extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'mongo_comics';
    protected $fillable = ['uuid', 'title', 'author', 'url', 'bg', 'uuid', 'genre', 'how_to_read', 'status', 'thumbnail', 'description', 'last_chapter', 'tags'];

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, 'comic_id', 'id')->orderByDesc('order');
    }
    // this is a recommended way to declare event handlers
    protected static function booted () {
        static::deleting(function(Comic $comic) { // before delete() method call this
             $comic->chapters()->delete();
             // do the rest of the cleanup...
        });
    }
}
