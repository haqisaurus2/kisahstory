<?php

namespace App\Http\Controllers;

use App\Models\ArticleStory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function getArticles(Request $request) { 
        $articles = ArticleStory::where("status", "PUBLISHED")->orderByDesc('created_at')->paginate(10);
        $articles->withPath($request->url());
        return view('pages.articles', [
            "articles" => $articles
        ]);
    }
    public function getArticleDetail(string $slug) { 
        $article = ArticleStory::where("slug", $slug)->orderByDesc('created_at')->first();

        $prevArticle =  ArticleStory::where("created_at", "<", $article->created_at)->orderByDesc('created_at')->first();
        $nextArticle =  ArticleStory::where("created_at", ">", $article->created_at)->orderBy('created_at')->first();
        return view('pages.article', [
            "article" => $article,
            "prevArticle" => $prevArticle,
            "nextArticle" => $nextArticle,
        ]);
    }
}
