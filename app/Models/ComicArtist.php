<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicArtist extends Model
{
    use HasFactory;
    protected $table = 'story_artists';
    protected $fillable = ['name', 'slug', 'user_id', "photo", "country" ];  

}
