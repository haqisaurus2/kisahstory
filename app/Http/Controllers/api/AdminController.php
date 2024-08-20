<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\mongo\Comic;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function getPrepareComicLIst(Request $request) { 
        $comics = Comic::orderByDesc("updated_at")->paginate(50);
        return $comics;
    }

}