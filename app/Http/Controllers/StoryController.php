<?php

namespace App\Http\Controllers;

use App\Models\ComicComment;
use App\Models\ComicStory;  
use Illuminate\Http\Request; 
class StoryController extends Controller
{
    public function storyDetail(string $slug) {
        $story = ComicStory::where("slug", $slug)->firstOrFail();
		return view('pages.story', [
            'story' => $story
        ]);
    }

     public function postComment(Request $request)  {
    	$request->validate([
            'body'=>'required',
            'story_id'=>'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id; 
        ComicComment::create($input);
   
        return back();
    }
}
