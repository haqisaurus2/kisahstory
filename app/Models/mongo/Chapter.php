<?php

namespace App\Models\mongo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    use HasFactory; 
    protected $guarded = [];
    protected $table = 'mongo_chapters';
    protected $fillable = ['update', 'order', 'link', 'comic_id'];
    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'chapter_id', 'id')->orderByDesc('order');
    }
    public function comic(): BelongsTo
    {
        return $this->belongsTo(Comic::class, 'comic_id');
    }
    protected static function booted () {
        static::deleting(function(Chapter $chapter) { // before delete() method call this
             $chapter->images()->delete();
             // do the rest of the cleanup...
        });
    }
}
