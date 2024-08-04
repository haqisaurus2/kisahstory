<?php

namespace App\Http\Controllers;

use App\Models\ComicStory;
use App\Models\ComicTag;
use Illuminate\Http\Request; 
use Symfony\Component\Console\Helper\Table; 

class CategoryController extends Controller
{
    public function getCategory(string $slug, Request $request) { 
        $stories = ComicStory::query();

        if ($request->has('startWith')) {
            $startWith = $request->input('startWith');
            $stories->where("title", "like", $startWith . "%");
        }
        if ($updateParam = $request->has('updateParam') && $request->has('updateParam') === 'updated') { 
            $stories->orderByDesc("updated_at");
        } else if ($updateParam = $request->has('updateParam') && $request->has('updateParam') === 'rate') { 
            $stories->orderByDesc("rating");
        }

        $stories = $stories->paginate(10); 
        $appurl = config('app.url'); 
        $stories->withPath($appurl . '/' . $request->path()); 
        
        $tags = ComicTag::all(); 
        return view('pages.category', [
             'slug' => $slug,
             'tags' => $tags,
             'startWith' => $request->input('startWith'),
             'updateParam' => $request->input('updateParam'),
             'tagParam' => $request->input('tagParam'),
             'statusParam' => $request->input('statusParam'),
             'stories' => $stories
        ]);
    }
}
