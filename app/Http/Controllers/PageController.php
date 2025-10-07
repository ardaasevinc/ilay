<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();

        // Galeri ilişkisini yükle
        $page->load('galleries');
        return view('frontend.page.show', compact('page'));
    }
}
