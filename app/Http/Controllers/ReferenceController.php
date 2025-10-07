<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    /**
     * Referansları listele
     */
    public function index()
    {
        $references = Reference::with(['services.service_category'])
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.reference.index', compact('references'));
    }

    /**
     * Referans detay sayfası
     */
    public function show($slug)
    {
        $reference = Reference::with(['services.service_category', 'galleries'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // İlgili referanslar (aynı kategorideki diğer referanslar)
        $relatedReferences = Reference::with(['services.service_category'])
            ->where('is_active', true)
            ->where('id', '!=', $reference->id)
            ->whereHas('services', function ($query) use ($reference) {
                if ($reference->services->isNotEmpty()) {
                    $serviceIds = $reference->services->pluck('id')->toArray();
                    $query->whereIn('services.id', $serviceIds);
                }
            })
            ->orderBy('sort_order', 'asc')
            ->take(3)
            ->get();

        // Eğer ilgili referans bulunamazsa, rastgele 3 referans getir
        if ($relatedReferences->count() < 3) {
            $relatedReferences = Reference::with(['services.service_category'])
                ->where('is_active', true)
                ->where('id', '!=', $reference->id)
                ->inRandomOrder()
                ->take(3)
                ->get();
        }

        return view('frontend.reference.show', compact('reference', 'relatedReferences'));
    }

    /**
     * Kategoriye göre referansları filtrele (gelecekte kullanım için)
     */
    public function category($categorySlug)
    {
        // Bu metod gelecekte kategori bazlı filtreleme için kullanılabilir
        $references = Reference::with(['services.service_category'])
            ->whereHas('services.service_category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.reference.index', compact('references'));
    }
}
