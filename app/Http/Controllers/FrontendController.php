<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;

class FrontendController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(6);
        return view('frontend.index', compact('articles'));
    }
}
