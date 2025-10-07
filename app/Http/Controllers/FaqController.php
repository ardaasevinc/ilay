<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     */
    public function index(): View
    {
        $faqs = Faq::active()
            ->published()
            ->ordered()
            ->get();

        return view('faqs.index', compact('faqs'));
    }

    /**
     * Display the specified FAQ.
     */
    public function show(string $slug): View
    {
        $faq = Faq::active()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('faqs.show', compact('faq'));
    }
}
