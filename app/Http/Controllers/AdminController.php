<?php

namespace App\Http\Controllers;

use App\Models\ArticleStory;
use App\Models\mongo\Chapter;
use App\Models\mongo\Comic;
use App\Models\mongo\Image;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function getComicLIst(Request $request) { 
        $comics = Comic::orderByDesc("updated_at")->paginate(50);
        $appurl = config('app.url'); 
        $comics->withPath($appurl . '/' . $request->path());
        return view('pages.admin.list', [
             'comics' => $comics
        ]);
    }
    public function getComicChapterLIst(int $id, Request $request) { 
        $chapters = Chapter::where("comic_id", $id)->orderByDesc("order")->paginate(500); 
        $appurl = config('app.url'); 
        $chapters->withPath($appurl . '/' . $request->path());
        $comic = Comic::where("id", $id)->first(); 
        
        return view('pages.admin.chapter', [
            "chapters" => $chapters, 
            "comic" => $comic
        ]);
    }

    public function getComicImages(int $id) { 
        $images = Image::where("chapter_id", $id)->orderBy("order")->get(); 
        $chapter = Chapter::where("id", $id)->first(); 
        
        return view('pages.admin.images', [
            "images" => $images, 
            "id" => $chapter->comic->id
        ]);
    }
}
