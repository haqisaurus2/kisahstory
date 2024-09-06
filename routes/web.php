<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberControllerController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'home']);
Route::get('/search', [HomeController::class, 'getSearch']);
Route::get('/story/{slug}', [StoryController::class, 'storyDetail']);
Route::post('/comment/story', [StoryController::class, 'postComment']);
Route::get('/chapter/{slug}', [ChapterController::class, 'chapterDetail']);
Route::post('/comment/chapter', [ChapterController::class, 'postComment']);
Route::get('/image/{imageId}', [ChapterController::class, 'getImage']);
Route::get('/category/{slug}', [CategoryController::class, 'getCategory']);
Route::get('/bookmarks', [BookmarkController::class, 'getBookmark'])->middleware("isLoginCheck");
Route::get('/articles', [ArticleController::class, 'getArticles']);
Route::get('/article/{slug}', [ArticleController::class, 'getArticleDetail']);


/**
 * socialite auth
 */
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
Route::get('/login', [HomeController::class, 'getLogin']);
Route::post('/logout', [SocialiteController::class, 'logout']);

Route::get('/sitemap.xml', [HomeController::class, 'sitemapBlade']); 
Route::get('/sitemap-{slug?}.xml', [HomeController::class, 'sitemapBladeStory']); 



Route::get('/mimin/list', [AdminController::class, 'getComicLIst']); 
Route::get('/mimin/list/{id}', [AdminController::class, 'getComicChapterLIst']); 
Route::get('/mimin/images/{id}', [AdminController::class, 'getComicImages']); 

Route::get('/member/{path?}', [MemberController::class, 'getIndexReact']); 

