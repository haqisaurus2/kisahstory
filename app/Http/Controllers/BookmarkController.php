<?php

namespace App\Http\Controllers;

use App\Models\ComicBookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function getBookmark(Request $request) { 
        $bookmarks = ComicBookmark::where("user_id", Auth::user()->id)->orderByDesc("created_at")->paginate(10);
        return view('pages.bookmark', [
            "bookmarks" => $bookmarks
        ]);
    }
}
