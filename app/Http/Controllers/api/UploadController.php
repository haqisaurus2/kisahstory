<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ComicArtist;
use App\Models\ComicAuthor;
use App\Models\ComicCategory;
use App\Models\ComicChapter;
use App\Models\ComicSection;
use App\Models\ComicStory;
use App\Models\ComicTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function postUpload(Request $request) {  
        $json = $request->all();  
        return $json;
        $author = ComicAuthor::where("name", $json["author"])->first();
        if ($author === null) {
            $author = ComicAuthor::create([
                "name" => $json["author"],
                "slug" => Str::slug($json["author"]),
                "user_id" => 1,
                "country" => "",
                "photo" => "",
            ]);
        }
        $artist = ComicArtist::where("name", $json["author"])->first();
        if ($artist === null) {
            $artist = ComicArtist::create([
                "name" => $json["author"],
                "slug" => Str::slug($json["author"]),
                "user_id" => 1, 
                "country" => "",
                "photo" => "",
            ]);
        }
        $category = ComicCategory::where("name", $json["genre"])->first();
        if ($category === null) {
            $artist = ComicCategory::create([
                "name" => $json["genre"],
                "slug" => Str::slug($json["genre"]),

            ]);
        }
        $story = ComicStory::where("title", $json["title"])->first();
        if ($story === null) {
            $story =   ComicStory::create([
                "title" => $json["title"],
                "source_url"  => $json["url"],
                "synopsis"  => $json["description"],
                "meta"  => $json["description"],
                "genre"  => $json["genre"],
                "how_to_read"  => $json["howToRead"],
                "last_chapter"  => $json["lastChapter"],
                "status"  => $json["status"],
                "bg"  => $json["bg"],
                "thumbnail"  => $json["thumbnail"], 
                "slug" => Str::slug($json["title"]),
                "author_id" => $author->id,
                "artist_id" => $artist->id,
                "category_id" => $category->id,
                "type" => "KOMIK",
                "reader_count" => 0,
                "rating" => 0,
                "reader_age" => 0,
            ]);
        }

        foreach ($json["tags"] as $tag) {
            $newTag = ComicTag::where([
                "name" => $tag,
                "slug" => Str::slug($tag),
            ])->firstOrCreate();

            $tagRel = ComicStory::where("id" , $story->id)->whereHas('tags', function($query) use ($newTag) {
                $query->where('id', $newTag->id);
            })->get(); 

            if ($tagRel->count() === 0) {
                $story->tags()->attach($newTag);  

            } 
        }
        foreach ($json["chapters"] as $chapterI) {
            $chapter = ComicChapter::where("story_id", $story->id)->where("order", $chapterI["order"])->first();
            if ($chapter === null) {
                 $chapter = ComicChapter::create([
                    "title" => $story->title . " chapter " . $chapterI["order"],
                    "meta" => "baca " . $story->type . " " . $story->category->name . " " . $story->title . " chapter " . $chapterI["order"],
                    "order" => $chapterI["order"],
                    "slug" => Str::slug("baca " . $story->type . " " . $story->category->name . " " . $story->title . " chapter " . $chapterI["order"] . " bahasa indonesia"),
                    "story_id" => $story->id,
                    "rating" => 0,
                    "reader_count" => 0,
                    "updated_at" => strtotime( $chapterI["update"]),
                 ]);
                $story->last_chapter = $chapterI["order"];
                $story->save();

                foreach ($chapterI["images"] as $image) {
                    $section = ComicSection::where("chapter_id", $chapter->id)->where("order", $image["order"])->first();
                    if ($section === null) {
                        $ext = pathinfo($image["src"], PATHINFO_EXTENSION);
                        $section = ComicSection::create([
                            "chapter_id" => $chapter->id,
                            "order" => $image["order"],
                            "slug" => Str::slug("baca " . $story->type . " " . $story->category->name . " " . $story->title . " chapter " . $chapterI["order"] . " bahasa indonesia " .  $image["order"] . ".". $ext),
                            "alt2" => $image["src"],
                            "alt1" => "",
                            "content" => "",
                        ]);
                    }
                }
            }
        }
        return $story;
    }
}
