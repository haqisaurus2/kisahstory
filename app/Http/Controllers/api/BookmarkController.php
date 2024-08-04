<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ComicBookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookmarkController extends Controller
{
    //
    public function postBookmark(Request $request) {
        
        $bookmark = ComicBookmark::where("user_id", $request->input('uid'))
        ->where("story_id", $request->input('storyId'))
        ->where("chapter_id", $request->input('chapterId'))
        ->where("section_id", $request->input('sectionId'))
        ->first();
        if ($bookmark === null) {
            ComicBookmark::create([
                 "user_id" =>  $request->input('uid'),
                 "story_id" =>  $request->input('storyId'),
                 "chapter_id" =>  $request->input('chapterId'),
                 "section_id" =>  $request->input('sectionId'),
            ]);
        }
        return [
            "status" => true,
            "message" => "Bookmark disimpan!"
        ];
    }
}
