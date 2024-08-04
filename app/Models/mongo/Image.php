<?php

namespace App\Models\mongo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory; 
    protected $guarded = [];
    protected $table = 'mongo_images';
    protected $fillable = ['src', 'order',  'chapter_id'];
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
}
