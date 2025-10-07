<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(8);
        return view('frontend.news.index', compact('news'));
    }

    public function show($slug)
    {
        $item = News::where('slug', $slug)->firstOrFail();
        return view('frontend.news.show', compact('item'));
    }
}
