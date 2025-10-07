<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //

    public function index()
    {
        $serviceCategories = \App\Models\ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.service.index', compact('serviceCategories'));
    }

    public function show($slug)
    {
        $service = \App\Models\Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('frontend.service.show', compact('service'));
    }

    public function category($slug)
    {
        $category = \App\Models\ServiceCategory::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $servicesCat = $category->services()->where('is_active', true)->orderBy('sort_order')->get();
        return view('frontend.service.category', compact('category', 'servicesCat'));
    }
}
