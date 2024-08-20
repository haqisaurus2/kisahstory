<?php

use App\Http\Controllers\api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\BookmarkController;
use App\Http\Controllers\api\UploadController;
use App\Http\Controllers\api\ScraperController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 
Route::post('/admin/update-mongo', [UploadController::class, 'postUpload']);
Route::post('/bookmark', [BookmarkController::class, 'postBookmark']);
Route::get('/scrap', [ScraperController::class, 'scrap']);
Route::get('/scrap/ch', [ScraperController::class, 'scrapImage']);


Route::post('/add-comic', [ScraperController::class, 'addComic']);
Route::post('/update-comic', [ScraperController::class, 'updateComic']);


Route::post('/upload-json', [ScraperController::class, 'uploadJson']);
Route::post('/delete-comic', [ScraperController::class, 'deleteComic']);
Route::post('/update-comic', [ScraperController::class, 'updateComic']);
Route::post('/delete-chapter', [ScraperController::class, 'deleteChapter']);
Route::get('/sync-comic/{uuid}', [ScraperController::class, 'syncToWeb']);
Route::get('/test', [ScraperController::class, 'cobalagi']);


Route::post('/delete-chapter-story', [ScraperController::class, 'deleteChapterStory']);
Route::get('/rescrap-chapter/{id}', [ScraperController::class, 'rescrapChapter']);
Route::post('/download-json', [ScraperController::class, 'downloadJsonComic']);
Route::get('/excel', [ScraperController::class, 'readExcel']);

Route::get('/get-prepare-list', [AdminController::class, 'getPrepareComicLIst']);
