<?php

namespace App\Http\Controllers;

use App\Models\ComicChapter;
use App\Models\ComicChapterComment;
use App\Models\ComicSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

class ChapterController extends Controller
{
    public function chapterDetail(string $slug) {
        $chapter = ComicChapter::where("slug", $slug)->firstOrFail();
        $previousChapter = null;
        $nextChapter = null;
        

        $chapterIndex = $chapter->story->chapters->search(function($e) use ($chapter) {
            return $e->id === $chapter->id;
        });
         
        if ($chapterIndex < count($chapter->story->chapters) - 1) {
            $previousChapter = $chapter->story->chapters[$chapterIndex + 1];
        }

        if ($chapterIndex >= 1) {
            $nextChapter = $chapter->story->chapters[$chapterIndex - 1];
        } 

        $chapter->reader_count = $chapter->reader_count + 1;
        $chapter->save();
        $chapter->story->reader_count = $chapter->story->reader_count + 1;
        $chapter->story->save();
		return view('pages.chapter', [
            'chapter' => $chapter,
            'previousChapter' => $previousChapter,
            'nextChapter' => $nextChapter,
        ]);
    }

    public function getImage(int $imageId) {
        $section = ComicSection::where('id', $imageId)->firstOrFail();
        $imageUrl = $section->alt2;  
        if ($section->alt1 !== null && $section->alt1 !== "") {
            $imageUrl = $section->alt1; 
        } 
        
        if (empty($imageUrl)) {
            return response('Missing image URL', 400);
        }

        $imageContents = Http::get($imageUrl);

        if ($imageContents->failed()) {
            return response('Failed to fetch image', 500);
        }

        $mimeType = $imageContents->header('content-type');
        return Response::make($imageContents->body(), 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline',
        ]);
    }

    public function postComment(Request $request)  {
    	$request->validate([
            'body'=>'required',
            'chapter_id'=>'required',
        ]);
   
        $input = $request->all();
        $input['user_id'] = auth()->user()->id; 
        ComicChapterComment::create($input);
   
        return back();
    }
}
