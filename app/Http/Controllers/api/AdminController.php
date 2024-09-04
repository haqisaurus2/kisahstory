<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\ComicCategory;
use App\Models\ComicChapter;
use App\Models\mongo\Comic;
use App\Models\ComicStory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function getPrepareComicLIst(Request $request)
    {
        $comics = Comic::whereNotNull("url");
        $keyword = $request->input('keyword');
        if ($keyword) {
            $comics->where('title', 'like', '%'.$keyword.'%');
        }
        $sort = explode(',',$request->input('sort'));
        if (count($sort) > 1) {
            $column = $sort[0] != null ? $sort[0] : 'id';
            $dir = $sort[1] != null ? $sort[1] : 'DESC';
            $comics = (strcasecmp($dir, 'DESC') == 0) ?  $comics ->orderByDesc($column) : $comics ->orderBy($column);
        }
        $pageSize = $request->input('pageSize') != null ? $request->input('pageSize') :  100;

        error_log($comics->toRawSql());
        return $comics->paginate($pageSize);
    }

    public function getStoryLIst(Request $request)
    {
        $stories = ComicStory::orderByDesc("updated_at")->where('type', 'STORY')->paginate(50);
        return $stories;
    }

    public function getCategoryDropdown(Request $request)
    {
        $categories = ComicCategory::orderByDesc("id")->get();
        return  $categories->toJson();
    }
    public function addStory(Request $request)
    {
        $title = $request->input('title');
        $synopsis = $request->input('synopsis');
        $thumbnail = $request->input('thumbnail');
        $categoryId = $request->input('categoryId');
        $story = ComicStory::create([
            'title' => $title,
            'synopsis' => $synopsis,
            'meta' => $synopsis,
            'thumbnail' => $thumbnail, 
            "source_url" => "", 
            "genre" => "",
            "how_to_read" => "",
            "last_chapter" => "0",
            "status" => "",
            "bg" => "",
            "slug" => Str::slug($title),
            "author_id" => 6,
            "artist_id" => 6,
            "category_id" => $categoryId,
            "type" => "STORY",
            "reader_count" => 0,
            "rating" => 0,
            "reader_age" => 0,
        ]);
        return $story;
    }

    public function getChapterList(Request $request, string $storyId)
    {
        $chapters = ComicChapter::where(['story_id' => $storyId]);
        $keyword = $request->input('keyword');
        if ($keyword) {
            $chapters->where('title', 'like', '%'.$keyword.'%');
        }
        $sort = explode(',',$request->input('sort'));
        if (count($sort) > 1) {
            $column = $sort[0] != null ? $sort[0] : 'id';
            $dir = $sort[1] != null ? $sort[1] : 'DESC';
            $chapters = (strcasecmp($dir, 'DESC') == 0) ?  $chapters ->orderByDesc($column):$chapters ->orderBy($column);
        }
        error_log($chapters->toRawSql());
        return  $chapters->paginate(100);
    }
}