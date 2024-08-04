<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicCategory extends Model
{
    use HasFactory;
    protected $table = 'story_categories';
    protected $fillable = ['name', 'slug',   ]; 

}
