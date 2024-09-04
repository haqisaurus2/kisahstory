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
use App\Models\mongo\Chapter;
use App\Models\mongo\Comic;
use App\Models\mongo\Image;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Str;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class ScraperController extends Controller
{
    private $client;
    public function __construct()
    {
        $this->client = new HttpBrowser(HttpClient::create([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.5845.96 Safari/537.36',
                "Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
                // "Accept-Encoding" => "gzip, deflate, br, zstd",
                "Accept-Language" => "id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7",
                "Cache-Control" => "max-age=0",
                "Priority" => "u=0, i",
                "Referer" => "https://komiku.id/",
                "Sec-Ch-Ua" => "\"Not)A;Brand\";v=\"99\", \"Google Chrome\";v=\"127\", \"Chromium\";v=\"127\"",
                "Sec-Ch-Ua-Mobile" => "?0",
                "Sec-Ch-Ua-Platform" => "\"macOS\"",
                "Sec-Fetch-Dest" => "document",
                "Sec-Fetch-Mode" => "navigate",
                "Sec-Fetch-Site" => "same-site",
                "Sec-Fetch-User" => "?1",
                "Upgrade-Insecure-Requests" => "1"
            ],
        ]));
    }
    //
    public function scrap(Request $request)
    {
        try {
            $response = $this->client->get('https://komiku.id/manga/kyokuto-necromance/'); // URL, where you want to fetch the content
            // get content and pass to the crawler
            $content = $response->getBody()->getContents();
            $crawler = new Crawler($content);

            $title = $crawler->filter('#Judul > h1')->text();
            $genre = $crawler->filter('#Informasi > table  tr:nth-child(3) > td:nth-child(2)')->text();


            $author = $crawler->filter("#Informasi > table  tr:nth-child(5) > td:nth-child(2)")->text();
            $status = $crawler->filter("#Informasi > table  tr:nth-child6) > td:nth-child(2)")->text();
            $howToRead = $crawler->filter("#Informasi > table  tr:nth-child(8) > td:nth-child(2)")->text();

            $description = $crawler->filter("#Judul > p.desc")->text();
            $thumbnail = $crawler->filter("#Informasi > div > img")->attr("src");
            $bg = $crawler->filter("#Informasi > div > img")->attr("src");
            $tags = $crawler->filter("#Informasi > ul > li")->each(function (Crawler $node) {
                $tag = trim($node->filter("a")->text());
                return $tag;
            });

            $chapters = $crawler->filter("#Daftar_Chapter tr")->each(function (Crawler $node, $i) {
                if ($i > 0) {
                    $title = trim($node->filter(".judulseries")->text());
                    $tanggal = trim($node->filter(".tanggalseries")->text());
                    $link = $node->filter(".judulseries a")->attr("href");
                    //echo $title;
                    $title = preg_replace('/[^0-9.]/', "", $title);

                    return ['order' => $title, 'tanggal' => $tanggal, 'link' => "https://komiku.id" . $link, 'images' => []];
                }
            });
            array_shift($chapters);
            $chapters = array_reverse($chapters);
            return
                [
                    'title' => $title,
                    'genre' => $genre,
                    'author' => $author,
                    'status' => $status,
                    'howToRead' => $howToRead,
                    'description' => $description,
                    'thumbnail' => $thumbnail,
                    'bg' => $bg,
                    'tags' => $tags,
                    'chapters' => $chapters,
                ];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return 'da';
    }

    public function scrapImage(Request $request)
    {
        try {
            $response = $this->client->get('https://komiku.id/ch/httpsadmin-komiku-orgone-piece-chapter-1086-hq/'); // URL, where you want to fetch the content
            // get content and pass to the crawler
            $content = $response->getBody()->getContents();
            $crawler = new Crawler($content);

            $images = $crawler->filter("#Baca_Komik > img")->each(function (Crawler $node) {
                $tag = trim($node->attr("src"));
                return $tag;
            });

            return
                [
                    'images' => $images,

                ];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return 'da';
    }
    public function addComic(Request $request)
    {
        $url = $request->input("url");
        $data = ['uuid' => Str::uuid()];
        ini_set('max_execution_time', 1000);
        DB::beginTransaction();
        $response = null;
        $chapters = [];
        $story = null;
        $crawler = null;
        try {
            $response = $this->client->request('GET', $url); // URL, where you want to fetch the content
            // get content and pass to the crawler
            $content = $response->html();
            $crawler = new Crawler($content);

            $title = $crawler->filter('#Judul > h1')->text();
            $title = preg_replace('/Komik/', "", $title);
            $genre = $crawler->filter('#Informasi > table tr:nth-child(2)  > td:nth-child(2)')->text();


            $author = $crawler->filter("#Informasi > table  tr:nth-child(4) > td:nth-child(2)")->text();
            $status = $crawler->filter("#Informasi > table  tr:nth-child(5) > td:nth-child(2)")->text();
            $howToRead = $crawler->filter("#Informasi > table  tr:nth-child(8) > td:nth-child(2)")->text();

            $description = $crawler->filter("#Judul > p.desc")->text();
            $thumbnail = $crawler->filter("#Informasi > div > img")->attr("src");
            $bg = $crawler->filter("#Informasi > div > img")->attr("src");

            $story = Comic::where("url", $url)->first();
            if ($story === null) {
                $story = Comic::create([
                    'title' => $title,
                    'genre' => $genre,
                    'author' => $author,
                    'status' => strtoupper($status),
                    'how_to_read' => $howToRead,
                    'description' => $description,
                    'thumbnail' => $thumbnail,
                    'bg' => $bg,
                    'url' => $url,
                    'uuid' => $data['uuid'],
                    'last_chapter' => 0,
                    'tags' => "",
                    "scrap_date" => Carbon::now()
                ]);
            }


            $tags = $crawler->filter("#Informasi > ul > li")->each(function (Crawler $node) {
                $tag = trim($node->filter("a")->text());
                return $tag;
            });
            $story->tags = json_encode($tags);
            $story->save();
            $chapters = $crawler->filter("#Daftar_Chapter tr")->each(function (Crawler $node, $i) use ($story) {
                if ($i > 0) {
                    $title = trim($node->filter(".judulseries")->text());
                    $tanggal = trim($node->filter(".tanggalseries")->text());
                    $link = "https://komiku.id" . $node->filter(".judulseries a")->attr("href");
                    $title = preg_replace('/[^0-9.-]/', "", $title);
                    $title = (float) preg_replace('/-/', ".", $title);
                    $chapter = Chapter::where(["order" => $title, 'comic_id' => $story->id])->first();
                    error_log($link);
                    error_log($title);
                    if ($chapter === null) {
                        $chapter = Chapter::create([
                            'order' => $title,
                            'update' => date('Y-m-d', strtotime($tanggal)),
                            'link' => $link,
                            'comic_id' => $story->id
                        ]);
                    }
                    if ($story->last_chapter < $title) {
                        $story->last_chapter = $title;
                        $story->scrap_date = Carbon::now();
                        $story->save();
                    }
                    $images = [];
                    try {
                        $client = new HttpBrowser(HttpClient::create([
                            'headers' => [
                                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.5845.96 Safari/537.36',
                                "Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
                                // "Accept-Encoding" => "gzip, deflate, br, zstd",
                                "Accept-Language" => "id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7",
                                "Cache-Control" => "max-age=0",
                                "Priority" => "u=0, i",
                                "Referer" => "https://komiku.id/",
                                "Sec-Ch-Ua" => "\"Not)A;Brand\";v=\"99\", \"Google Chrome\";v=\"127\", \"Chromium\";v=\"127\"",
                                "Sec-Ch-Ua-Mobile" => "?0",
                                "Sec-Ch-Ua-Platform" => "\"macOS\"",
                                "Sec-Fetch-Dest" => "document",
                                "Sec-Fetch-Mode" => "navigate",
                                "Sec-Fetch-Site" => "same-site",
                                "Sec-Fetch-User" => "?1",
                                "Upgrade-Insecure-Requests" => "1"
                            ],
                        ]));
                        // get chapter images   
                        $responseChapter = $client->request('GET', $link); // URL, where you want to fetch the content


                        $content = $responseChapter->html();
                        $crawler = new Crawler($content);

                        $images = $crawler->filter("#Baca_Komik > img")->each(function (Crawler $node2, $j) use ($chapter) {
                            $img = trim($node2->attr("src"));
                            $image = Image::where(["order" => $j, 'chapter_id' => $chapter->id])->first();
                            if ($image === null) {
                                $image = Image::create([
                                    'src' => $img,
                                    'order' => $j,
                                    'chapter_id' => $chapter->id
                                ]);
                            }

                            return [
                                'src' => $img,
                                'order' => $j,
                            ];
                        });
                    } catch (Exception $er) {
                        $response = $er->getMessage();
                        error_log($response);
                        // $responseBodyAsString = $response->getBody()->getContents();
                        //echo $response->getStatusCode() . PHP_EOL;
                        //echo $responseBodyAsString;
                        //DB::rollBack(); 
                    }



                    return ['order' => $title, 'tanggal' => $tanggal, 'link' => $link, 'images' => $images];
                }
            });
            array_shift($chapters);
            $chapters = array_reverse($chapters);
            $data['title'] = $title;
            $data['genre'] = $genre;
            $data['author'] = $author;
            $data['status'] = $status;
            $data['howToRead'] = $howToRead;
            $data['description'] = $description;
            $data['thumbnail'] = $thumbnail;
            $data['bg'] = $bg;
            $data['tags'] = $tags;
            $max = $chapters[0]['order'];
            $data['lastChapter'] = $max;
            $data['chapters'] = $chapters;
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }




        return $data;
    }

    public function updateComic(Request $request)
    {
        ini_set('max_execution_time', 1000);
        DB::beginTransaction();
        try {
            $uuid = $request->input("uuid");
            $story = Comic::where("uuid", $uuid)->first();


            $response = $this->client->request('GET', $story->url);
            // get content and pass to the crawler
            $content = $response->html();
            $crawler = new Crawler($content);
            $chapters = $crawler->filter("#Daftar_Chapter tr")->each(function (Crawler $node, $i) {
                if ($i > 0) {
                    $title = trim($node->filter(".judulseries")->text());
                    $tanggal = trim($node->filter(".tanggalseries")->text());
                    $link = "https://komiku.id" . $node->filter(".judulseries a")->attr("href");
                    $title = preg_replace('/[^0-9.-]/', "", $title);
                    $title = preg_replace('/-/', ".", $title);

                    return ['order' => $title, 'tanggal' => $tanggal, 'link' => $link,];
                }
            });
            array_shift($chapters);
            $lastData = [];
            $chapters = array_reverse($chapters);
            foreach ($chapters as $chapter) {
                if ((float) $story->last_chapter < (float) $chapter["order"]) {
                    // get chapter images   
                    $responseChapter = $this->client->request('GET', $chapter["link"]);
                    $content = $responseChapter->html();
                    $crawler = new Crawler($content);
                    $ch = Chapter::where(["order" => $chapter["order"], 'comic_id' => $story->id])->first();
                    if ($ch === null) {
                        $ch = Chapter::create([
                            'order' => $chapter["order"],
                            'update' => date('Y-m-d', strtotime($chapter["tanggal"])),
                            'link' => $chapter["link"],
                            'comic_id' => $story->id
                        ]);
                    }

                    $images = $crawler->filter("#Baca_Komik > img")->each(function (Crawler $node2, $j) use ($ch) {
                        $img = trim($node2->attr("src"));
                        $image = Image::where(["order" => $j, 'chapter_id' => $ch->id])->first();
                        if ($image === null) {
                            $image = Image::create([
                                'src' => $img,
                                'order' => $j,
                                'chapter_id' => $ch->id
                            ]);
                        }
                        return [
                            'src' => $img,
                            'order' => $j,
                        ];
                    });
                    error_log($story->last_chapter);
                    error_log($chapter["order"]);
                    $story->last_chapter = (float) $chapter["order"];
                    $story->scrap_date = Carbon::now();
                    $story->save();
                    $chapter["images"] = $images;
                    array_push($lastData, $chapter);
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            echo $e->getMessage();
        }
        return $lastData;
    }

    public function deleteChapter(Request $request)
    {
        $comicID = $request->input("id");
        $comic = Comic::where("id", $comicID)->firstOrFail();
        $chapters = Chapter::where("comic_id", $comic->id, )->where('order', '>=', $request->input("chapter"))->get();
        foreach ($chapters as $chapter) {
            $chapter->images()->delete();
            $chapter->delete();
        }
        $comic->last_chapter = $request->input("chapter") - 1;
        $comic->save();
        return $chapters;
    }
    public function deleteComic(Request $request)
    {
        $comicID = $request->input("id");
        $comic = Comic::where("id", $comicID)->firstOrFail();
        foreach ($comic->chapters as $chapter) {
            $chapter->images()->delete();
        }
        $comic->chapters()->delete();
        $comic->delete();
        return "OK";
    }
    public function uploadJson(Request $request)
    {
        $title = $request->input("title");
        $url = $request->input("url");
        $author = $request->input("author");
        $bg = $request->input("bg");
        $description = $request->input("description");
        $genre = $request->input("genre");
        $howToRead = $request->input("howToRead");
        $status = $request->input("status");
        $thumbnail = $request->input("thumbnail");
        $uuid = $request->input("uuid");
        $lastChapter = $request->input("lastChapter");
        $chapters = $request->input("chapters");
        $tags = json_encode($request->input("tags"));
        DB::beginTransaction();
        try {
            $comic = Comic::firstOrNew(['url' => $url]);
            $comic->title = $title;
            $comic->bg = $bg;
            $comic->description = $description;
            $comic->author = $author;
            $comic->how_to_read = $howToRead;
            $comic->status = $status;
            $comic->genre = $genre;
            $comic->thumbnail = $thumbnail;
            $comic->uuid = $uuid;
            $comic->last_chapter = $lastChapter;
            $comic->tags = $tags;
            $comic->scrap_date = new Carbon();
            $comic->save();
            foreach ($chapters as $chapter) {
                $ch = Chapter::firstOrNew(['comic_id' => $comic->id, 'order' => $chapter['order']]);
                $ch->update = date('Y-m-d', strtotime($chapter['tanggal']));
                $ch->link = $chapter['link'];
                $ch->order = $chapter['order'];
                $ch->save();
                foreach ($chapter['images'] as $image) {
                    $img = Image::firstOrNew(['chapter_id' => $ch->id, 'order' => $image['order']]);
                    $img->src = $image['src'];
                    $img->save();
                }
                $comic->last_chapter = $ch->order;
                $comic->save();
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
        return $chapters;
    }

    public function syncToWeb(string $uuid)
    {
        ini_set('max_execution_time', 1000);
        $comic = Comic::with("chapters.images")->where("uuid", $uuid)->firstOrFail();
        $comic->tags = json_decode($comic->tags);
        DB::beginTransaction();

        try {
            $author = ComicAuthor::where("name", $comic->author)->first();
            if ($author === null) {
                $author = ComicAuthor::create([
                    "name" => $comic->author,
                    "slug" => Str::slug($comic->author),
                    "user_id" => 1,
                    "country" => "",
                    "photo" => "",
                ]);
            }
            $artist = ComicArtist::where("name", $comic->author)->first();
            if ($artist === null) {
                $artist = ComicArtist::create([
                    "name" => $comic->author,
                    "slug" => Str::slug($comic->author),
                    "user_id" => 1,
                    "country" => "",
                    "photo" => "",
                ]);
            }
            $category = ComicCategory::where("name", $comic->genre)->first();
            if ($category === null) {
                $category = ComicCategory::create([
                    "name" => $comic->genre,
                    "slug" => Str::slug($comic->genre),

                ]);
            }
            $story = ComicStory::where("title", $comic->title)->first();
            if ($story === null) {
                $story = ComicStory::create([
                    "title" => $comic->title,
                    "source_url" => $comic->url,
                    "synopsis" => $comic->description,
                    "meta" => $comic->description,
                    "genre" => $comic->genre,
                    "how_to_read" => $comic->how_to_read,
                    "last_chapter" => $comic->last_chapter,
                    "status" => $comic->status,
                    "bg" => $comic->bg,
                    "thumbnail" => $comic->thumbnail,
                    "slug" => Str::slug($comic->title),
                    "author_id" => $author->id,
                    "artist_id" => $artist->id,
                    "category_id" => $category->id,
                    "type" => "KOMIK",
                    "reader_count" => 0,
                    "rating" => 0,
                    "reader_age" => 0,
                    "uuid" => $uuid,

                ]);
            }

            foreach ($comic->tags as $tag) {
                $newTag = ComicTag::where([
                    "name" => $tag,
                    "slug" => Str::slug($tag),
                ])->first();
                if ($newTag === null) {
                    $newTag = ComicTag::create([
                        "name" => $tag,
                        "slug" => Str::slug($tag),
                    ]);
                }

                $tagRel = ComicStory::where("id", $story->id)->whereHas('tags', function ($query) use ($newTag) {
                    $query->where('id', $newTag->id);
                })->get();

                if ($tagRel->count() === 0) {
                    $story->tags()->attach($newTag);
                }
            }
            foreach ($comic->chapters as $chapterI) {
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
                        "updated_at" => strtotime($chapterI["update"]),
                    ]);

                    foreach ($chapterI->images as $image) {
                        $section = ComicSection::where("chapter_id", $chapter->id)->where("order", $image["order"])->first();
                        if ($section === null) {
                            $ext = pathinfo($image["src"], PATHINFO_EXTENSION);
                            $section = ComicSection::create([
                                "chapter_id" => $chapter->id,
                                "order" => $image["order"],
                                "slug" => Str::slug("baca " . $story->type . " " . $story->category->name . " " . $story->title . " chapter " . $chapterI["order"] . " bahasa indonesia " . $image["order"] . "." . $ext),
                                "alt2" => $image["src"],
                                "alt1" => "",
                                "content" => "",
                            ]);
                        }
                    }
                }
            }
            $story->last_chapter = $comic->last_chapter;
            $story->save();
            $comic->sync_date = Carbon::now();
            $comic->save();
            error_log($story->last_chapter);
            DB::commit();
            return $comic;
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function deleteChapterStory(Request $request)
    {
        $comicID = $request->input("id");
        $comic = ComicStory::where("id", $comicID)->firstOrFail();
        $chapters = ComicChapter::where("story_id", $comic->id, )->where('order', '>=', $request->input("chapter"))->get();
        foreach ($chapters as $chapter) {
            $chapter->sections()->delete();
            $chapter->delete();
        }
        $comic->last_chapter = $request->input("chapter") - 1;
        $comic->save();
        return $chapters;
    }
    public function test(Request $request)
    {
        $json = $request->all();
        Log::info($json);
        return $json;
    }
    public function rescrapChapter(int $chapterId)
    {
        DB::beginTransaction();
        $chapter = Chapter::where("id", $chapterId)->first();
        $chapter->images()->delete();
        try {
            $client = new \GuzzleHttp\Client();
            // get chapter images   
            $responseChapter = $client->request('GET', $chapter->link); // URL, where you want to fetch the content


            $content = $responseChapter->getBody()->getContents();
            $crawler = new Crawler($content);

            $images = $crawler->filter("#Baca_Komik > img")->each(function (Crawler $node2, $j) use ($chapter) {
                $img = trim($node2->attr("src"));
                $image = Image::where(["order" => $j, 'chapter_id' => $chapter->id])->first();
                if ($image === null) {
                    $image = Image::create([
                        'src' => $img,
                        'order' => $j,
                        'chapter_id' => $chapter->id
                    ]);
                }

                return [
                    'src' => $img,
                    'order' => $j,
                ];
            });
        } catch (GuzzleException $er) {
            $response = $er->getMessage();
            error_log($response);
            // $responseBodyAsString = $response->getBody()->getContents();
            //echo $response->getStatusCode() . PHP_EOL;
            //echo $responseBodyAsString;
            DB::rollBack();
        }
        DB::commit();
        $chapter = Chapter::where("id", $chapterId)->first();

        return [
            'message' => "OK",
            "data" => [
                "image_count" => count($chapter->images)
            ]
        ];
    }

    public function downloadJsonComic(string $url)
    {
        // $url = $request->input("url");

        $data = ['uuid' => Str::uuid()];
        ini_set('max_execution_time', 3000);
        // DB::beginTransaction();
        $response = null;
        $chapters = [];
        $story = null;
        $crawler = null;
        try {
            $response = $this->client->request('GET', $url); // URL, where you want to fetch the content
            // get content and pass to the crawler
            $content = $response->html();
            $crawler = new Crawler($content);

            $title = $crawler->filter('#Judul > h1')->text();
            $title = preg_replace('/Komik/', "", $title);
            $genre = $crawler->filter('#Informasi > table tr:nth-child(3)  > td:nth-child(2)')->text();


            $author = $crawler->filter("#Informasi > table  tr:nth-child(5) > td:nth-child(2)")->text();
            $status = $crawler->filter("#Informasi > table  tr:nth-child(6) > td:nth-child(2)")->text();
            $howToRead = $crawler->filter("#Informasi > table  tr:nth-child(8) > td:nth-child(2)")->text();

            $description = $crawler->filter("#Judul > p.desc")->text();
            $thumbnail = $crawler->filter("#Informasi > div > img")->attr("src");
            $bg = $crawler->filter("#Informasi > div > img")->attr("src");

            Log::debug($title); 
            $tags = $crawler->filter("#Informasi > ul > li")->each(function (Crawler $node) {
                $tag = trim($node->filter("a")->text());
                return $tag;
            });
            
            $chapters = $crawler->filter("#Daftar_Chapter tr")->each(function (Crawler $node, $i) use ($story) {
                if ($i > 0) {
                    $title = trim($node->filter(".judulseries")->text());
                    $tanggal = trim($node->filter(".tanggalseries")->text());
                    $link = "https://komiku.id" . $node->filter(".judulseries a")->attr("href");
                    $title = preg_replace('/[^0-9.-]/', "", $title);
                    $title = (float) preg_replace('/-/', ".", $title);
                    // $chapter = Chapter::where(["order" => $title, 'comic_id' => $story->id])->first();
                    error_log($link);
                    error_log($title);
                   
                    $images = [];
                    try {
                        $client = new HttpBrowser(HttpClient::create());
                        // get chapter images   
                        $responseChapter = $client->request('GET', $link); // URL, where you want to fetch the content


                        $content = $responseChapter->html();
                        $crawler = new Crawler($content);

                        $images = $crawler->filter("#Baca_Komik > img")->each(function (Crawler $node2, $j) {
                            $img = trim($node2->attr("src"));

                            return [
                                'src' => $img,
                                'order' => $j,
                            ];
                        });
                    } catch (Exception $er) {
                        $response = $er->getMessage();
                        error_log($response);
                    }

                    return ['order' => $title, 'tanggal' => $tanggal, 'link' => $link, 'images' => $images];
                }
            });
            array_shift($chapters);
            $chapters = array_reverse($chapters);
            $data['title'] = $title;
            $data['genre'] = $genre;
            $data['author'] = $author;
            $data['status'] = $status;
            $data['howToRead'] = $howToRead;
            $data['description'] = $description;
            $data['thumbnail'] = $thumbnail;
            $data['bg'] = $bg;
            $data['tags'] = $tags;
            $max = $chapters[count($chapters) - 1]['order'];
            $data['lastChapter'] = $max;
            $data['chapters'] = $chapters;
            $data['url'] = $url;
        } catch (Exception $e) {
            echo $e->getMessage();
        }


        // $response = Http::post('http://localhost:8000/api/upload-json', $data);
        $url = 'https://kisahstory.my.id/api/upload-json';

        // Create the context for the request
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/json\r\n",
                'content' => json_encode($data)
            )
        ));

        // Send the request
        $response = file_get_contents($url, FALSE, $context);

        // Check for errors
        if ($response === FALSE) {
            die('http Error');
        }



        return $data;
    }
    public function readExcel(Request $request)
    {

        ini_set('max_execution_time', 3000);
        set_time_limit(3000);
        $inputFileName = '../daftar komik.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $worksheet = null;
        $result = [];

        $worksheet = $spreadsheet->getSheetByName("Sheet1");
        $data = $worksheet->toArray();
        $jsonData = null;
        foreach ($data as $key => $value) {
            if ($key >= 9 && count($result) < 1 && $value[1] != 'uploaded') {
                error_log($key);
                array_push($result, $value);
                $jsonData = $this->downloadJsonComic($value[0]);
                $worksheet->getCell('B' . $key + 1)->setValue('uploaded');
            }
        }
        // Save the modified spreadsheet to a new file
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($inputFileName);
        return $jsonData;
    }

    public function cobalagi(Request $request)
    {
        $client = HttpClient::create([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.5845.96 Safari/537.36',
                "Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7",
                "Accept-Encoding" => "gzip, deflate, br, zstd",
                "Accept-Language" => "id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7",
                "Cache-Control" => "max-age=0",
                "Priority" => "u=0, i",
                "Referer" => "https://komiku.id/",
                "Sec-Ch-Ua" => "\"Not)A;Brand\";v=\"99\", \"Google Chrome\";v=\"127\", \"Chromium\";v=\"127\"",
                "Sec-Ch-Ua-Mobile" => "?0",
                "Sec-Ch-Ua-Platform" => "\"macOS\"",
                "Sec-Fetch-Dest" => "document",
                "Sec-Fetch-Mode" => "navigate",
                "Sec-Fetch-Site" => "same-site",
                "Sec-Fetch-User" => "?1",
                "Upgrade-Insecure-Requests" => "1"
            ],
        ]);

        $response = $client->request('GET', "https://echo.free.beeceptor.com"); // URL, where you want to fetch the content
        // Make a request

        // Get the raw content from the response body
        $textContent = $response->getContent();
        return $textContent;

    }

}