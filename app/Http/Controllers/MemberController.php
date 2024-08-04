<?php

namespace App\Http\Controllers;

use App\Models\ArticleStory;
use App\Models\mongo\Chapter;
use App\Models\mongo\Comic;
use App\Models\mongo\Image;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function getIndexReact(Request $request) { 
        
        return view('react', [
              
        ]);
    } 
}
