<?php

namespace App\Http\Controllers;

use App\Models\ComicCategory;
use App\Models\ComicChapter;
use App\Models\ComicStory;
use App\Models\ComicTag;
use Illuminate\Http\Request; 
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class HomeController extends Controller
{
    public function home(){
		$top3 = ComicStory::orderByDesc('reader_count')
               ->orderByDesc('rating')
               ->take(3)->get();

		$populars = ComicStory::orderByDesc('reader_count')
               ->take(20)->get();

		$recommendations = ComicStory::orderByDesc('rating') 
               ->take(20)->get();

		$updatedComics = ComicStory::orderByDesc('updated_at')->take(10)->get();

		$newComics = ComicStory::orderByDesc('created_at')->take(10)->get();

		$mangas = ComicStory::whereHas('category', function ($query) {
			$query->where('slug', 'manga');
		})->take(3)->get();
		$manhuas = ComicStory::whereHas('category', function ($query) {
			$query->where('slug', 'manhua');
		})->take(3)->get();
		$manhwas = ComicStory::whereHas('category', function ($query) {
			$query->where('slug', 'manhwa');
		})->take(3)->get();

		return view('pages.home', [
			'top3' => $top3,
			'populars' => $populars,
			'recommendations' => $recommendations,
			'newComics' => $newComics,
			'updatedComics' => $updatedComics,
			'mangas' => $mangas,
			'manhwas' => $manhwas,
			'manhuas' => $manhuas,
		]);
	}

    public function getLogin(Request $request){
		return view('pages.login');
	}
	
    public function getSearch(Request $request){
        $tags = ComicTag::all(); 
        $categories = ComicCategory::all(); 
        $results = ComicStory::query();
		if ($request->has('q')) {
            $q = $request->input('q');
            $results->where("title", "like", "%" . $q . "%");
        }
        if ($updateParam = $request->has('updateParam') && $request->has('updateParam') === 'updated') { 
            $results = $results->orderByDesc("updated_at");
        } else if ($updateParam = $request->has('updateParam') && $request->has('updateParam') === 'rate') { 
            $results = $results->orderByDesc("rating");
        }
		if ($request->has('tagParam')) {
			$tag_id = $request->has('tagParam');
			$results = $results->whereHas('tags', function ($b) use ($tag_id) {
				$b->where('id', '=', $tag_id);
			});
		}
		if ($request->has('categoryParam')) {
			$category_id = $request->has('categoryParam');
			$results = $results->whereHas('category', function ($b) use ($category_id) {
				$b->where('id', '=', $category_id);
			});
		} 
		$results = $results->paginate(10); 
		$appurl = config('app.url'); 
        $results->withPath($appurl . '/' . $request->path()); 

		return view('pages.search', [
			'results' => $results,
			'tags' => $tags,
			'categories' => $categories,
			'q' => $request->input('q'),
			'updateParam' => $request->input('updateParam'),
			'tagParam' => $request->input('tagParam'),
			'statusParam' => $request->input('statusParam'),
			'categoryParam' => $request->input('categoryParam'),
		]);
	}

	public function sitemap() {
		$sitemap = Sitemap::create();
		$sitemap->add(Url::create("https://kisahstory.my.id/")->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
		$sitemap->add(Url::create("https://kisahstory.my.id/category/manga")->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
		$sitemap->add(Url::create("https://kisahstory.my.id/category/manhua")->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));
		$sitemap->add(Url::create("https://kisahstory.my.id/category/manhwa")->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

		$stories = ComicStory::all();
		foreach ($stories as $story) {
			$sitemap->add(Url::create("https://kisahstory.my.id/story/{$story->slug}")->setPriority(1)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
		}
		$chapters = ComicChapter::all();
		foreach ($chapters as $chapter) {
			$sitemap->add(Url::create("https://kisahstory.my.id/chapter/{$chapter->slug}")->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY));
		}
		
		// $sitemap->writeToFile(public_path('/home/kisd2443/public_html/sitemap.xml'));
		echo getcwd().'/sitemap.xml';
		$sitemap->writeToFile(getcwd().'/sitemap.xml');
	}
}
