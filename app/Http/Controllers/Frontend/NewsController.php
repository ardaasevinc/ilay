<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // Set Turkish locale for dates
        Carbon::setLocale('tr');

        $query = News::where('is_active', 1)->with(['news_category']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('desc', 'like', '%' . $searchTerm . '%');
            });
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(6);

        // Get recent news for sidebar
        $recentNews = News::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get categories with news count for sidebar
        $categories = NewsCategory::where('is_active', 1)
            ->withCount(['news' => function ($query) {
                $query->where('is_active', 1);
            }])
            ->get();

        // Get tags (if you have tags functionality)
        $tags = collect(); // Empty for now

        return view('frontend.news.index', compact('news', 'recentNews', 'categories', 'tags'));
    }

    public function show($slug)
    {
        // Set Turkish locale for dates
        Carbon::setLocale('tr');

        $news = News::where('slug', $slug)
            ->where('is_active', 1)
            ->with(['news_category', 'galleries'])
            ->firstOrFail();

        // Get previous and next news
        $previousNews = News::where('id', '<', $news->id)
            ->where('is_active', 1)
            ->orderBy('id', 'desc')
            ->first();

        $nextNews = News::where('id', '>', $news->id)
            ->where('is_active', 1)
            ->orderBy('id', 'asc')
            ->first();

        // Get related news (same category)
        $relatedNews = News::where('news_category_id', $news->news_category_id)
            ->where('id', '!=', $news->id)
            ->where('is_active', 1)
            ->limit(4)
            ->get();

        // Get recent news for sidebar
        $recentNews = News::where('is_active', 1)
            ->where('id', '!=', $news->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get categories with news count for sidebar
        $categories = NewsCategory::where('is_active', 1)
            ->withCount(['news' => function ($query) {
                $query->where('is_active', 1);
            }])
            ->get();

        return view('frontend.news.show', compact(
            'news',
            'previousNews',
            'nextNews',
            'relatedNews',
            'recentNews',
            'categories'
        ));
    }

    public function category($slug)
    {
        // Set Turkish locale for dates
        Carbon::setLocale('tr');

        $category = NewsCategory::where('slug', $slug)
            ->where('is_active', 1)
            ->firstOrFail();

        $news = News::where('news_category_id', $category->id)
            ->where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        // Get recent news for sidebar
        $recentNews = News::where('is_active', 1)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get categories with news count for sidebar
        $categories = NewsCategory::where('is_active', 1)
            ->withCount(['news' => function ($query) {
                $query->where('is_active', 1);
            }])
            ->get();

        $tags = collect(); // Empty for now

        return view('frontend.news.category', compact('news', 'category', 'recentNews', 'categories', 'tags'));
    }

    public function tag($slug)
    {
        // For now, just redirect to main news page since we don't have tags implemented yet
        return redirect()->route('frontend.news.index');
    }
}
