<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\Slider::active()->ordered()->get();
        $news = \App\Models\News::where('is_active', true)->get();
        $references = \App\Models\Reference::with(['services.service_category'])
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $serviceCategories = \App\Models\ServiceCategory::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        $services = \App\Models\Service::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('frontend.index', compact('sliders', 'news', 'references', 'serviceCategories', 'services'));
    }
    public function contact()
    {
        return view('frontend.contact.index');
    }

    public function robots()
    {
        $siteUrl = config('app.url');

        // Site URL'sini temizle (trailing slash'ı kaldır)
        $siteUrl = rtrim($siteUrl, '/');

        $robotsTxt = "# Dinamik robots.txt - " . now()->format('Y-m-d H:i:s') . "\n";
        $robotsTxt .= "# Site: {$siteUrl}\n\n";

        $robotsTxt .= "# Tüm arama motoru botlarına izin ver\n";
        $robotsTxt .= "User-agent: *\n";
        $robotsTxt .= "Allow: /\n\n";

        $robotsTxt .= "# Admin panelini ve diğer özel dizinleri taramaya kapat\n";
        $robotsTxt .= "Disallow: /admin/\n";
        $robotsTxt .= "Disallow: /storage/\n";
        $robotsTxt .= "Disallow: /vendor/\n";
        $robotsTxt .= "Disallow: /.env\n";
        $robotsTxt .= "Disallow: /config/\n";
        $robotsTxt .= "Disallow: /bootstrap/\n";
        $robotsTxt .= "Disallow: /database/\n";
        $robotsTxt .= "Disallow: /tests/\n\n";

        // Özel durumlar (eğer varsa)
        if (config('app.env') === 'local') {
            $robotsTxt .= "# Geliştirme ortamı - tüm botları engelle\n";
            $robotsTxt .= "User-agent: *\n";
            $robotsTxt .= "Disallow: /\n\n";
        }

        $robotsTxt .= "# Crawl-delay (saniye cinsinden)\n";
        $robotsTxt .= "Crawl-delay: 1\n\n";

        $robotsTxt .= "# Site haritasının konumunu belirt\n";
        $robotsTxt .= "Sitemap: {$siteUrl}/sitemap.xml\n\n";

        $robotsTxt .= "# Ek bilgiler\n";
        $robotsTxt .= "# Bu dosya otomatik olarak oluşturulmuştur.\n";
        $robotsTxt .= "# Son güncelleme: " . now()->format('d.m.Y H:i:s') . "\n";

        return response($robotsTxt, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8'
        ]);
    }

    public function sitemap()
    {
        $siteUrl = rtrim(config('app.url'), '/');

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Ana sayfa
        $sitemap .= "\t<url>\n";
        $sitemap .= "\t\t<loc>{$siteUrl}</loc>\n";
        $sitemap .= "\t\t<lastmod>" . now()->format('Y-m-d') . "</lastmod>\n";
        $sitemap .= "\t\t<changefreq>daily</changefreq>\n";
        $sitemap .= "\t\t<priority>1.0</priority>\n";
        $sitemap .= "\t</url>\n";

        // Haberler
        $news = \App\Models\News::where('is_active', 1)->get();
        foreach ($news as $item) {
            $sitemap .= "\t<url>\n";
            $sitemap .= "\t\t<loc>{$siteUrl}/blog/{$item->slug}</loc>\n";
            $sitemap .= "\t\t<lastmod>" . $item->updated_at->format('Y-m-d') . "</lastmod>\n";
            $sitemap .= "\t\t<changefreq>weekly</changefreq>\n";
            $sitemap .= "\t\t<priority>0.8</priority>\n";
            $sitemap .= "\t</url>\n";
        }
        // Referanslar
        $references = \App\Models\Reference::where('is_active', 1)->get();
        foreach ($references as $reference) {
            $sitemap .= "\t<url>\n";
            $sitemap .= "\t\t<loc>{$siteUrl}/referans/{$reference->slug}</loc>\n";
            $sitemap .= "\t\t<lastmod>" . $reference->updated_at->format('Y-m-d') . "</lastmod>\n";
            $sitemap .= "\t\t<changefreq>monthly</changefreq>\n";
            $sitemap .= "\t\t<priority>0.7</priority>\n";
            $sitemap .= "\t</url>\n";
        }


        // Sayfalar
        $pages = \App\Models\Page::where('is_active', 1)->get();
        foreach ($pages as $page) {
            $sitemap .= "\t<url>\n";
            $sitemap .= "\t\t<loc>{$siteUrl}/sayfa/{$page->slug}</loc>\n";
            $sitemap .= "\t\t<lastmod>" . $page->updated_at->format('Y-m-d') . "</lastmod>\n";
            $sitemap .= "\t\t<changefreq>monthly</changefreq>\n";
            $sitemap .= "\t\t<priority>0.7</priority>\n";
            $sitemap .= "\t</url>\n";
        }

        // Hizmetler
        $services = \App\Models\Service::where('is_active', 1)->get();
        foreach ($services as $service) {
            $sitemap .= "\t<url>\n";
            $sitemap .= "\t\t<loc>{$siteUrl}/hizmet/{$service->slug}</loc>\n";
            $sitemap .= "\t\t<lastmod>" . $service->updated_at->format('Y-m-d') . "</lastmod>\n";
            $sitemap .= "\t\t<changefreq>monthly</changefreq>\n";
            $sitemap .= "\t\t<priority>0.8</priority>\n";
            $sitemap .= "\t</url>\n";
        }

        $sitemap .= '</urlset>';

        return response($sitemap, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8'
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return redirect()->route('frontend.index');
        }

        // Sayfalarda arama (Pages)
        $pages = \App\Models\Page::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('desc', 'LIKE', "%{$query}%")
                    ->orWhere('seo_desc', 'LIKE', "%{$query}%");
            })
            ->get();

        // Haberlerde arama (News)
        $news = \App\Models\News::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('desc', 'LIKE', "%{$query}%")
                    ->orWhere('seo_desc', 'LIKE', "%{$query}%");
            })
            ->with('news_category')
            ->get();

        // Haber kategorilerinde arama (News Categories)
        $newsCategories = \App\Models\NewsCategory::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('seo_desc', 'LIKE', "%{$query}%");
            })
            ->get();

        // Hizmetlerde arama (Services)
        $services = \App\Models\Service::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('desc', 'LIKE', "%{$query}%")
                    ->orWhere('seo_desc', 'LIKE', "%{$query}%");
            })
            ->with('service_category')
            ->get();

        // Hizmet kategorilerinde arama (Service Categories)
        $serviceCategories = \App\Models\ServiceCategory::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('desc', 'LIKE', "%{$query}%");
            })
            ->get();

        // Referanslarda arama (References)
        $references = \App\Models\Reference::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('desc', 'LIKE', "%{$query}%")
                    ->orWhere('seo_desc', 'LIKE', "%{$query}%");
            })
            ->with(['services.service_category'])
            ->get();

        // Toplam sonuç sayısı
        $totalResults = $pages->count() + $news->count() + $newsCategories->count() +
            $services->count() + $serviceCategories->count() + $references->count();

        return view('frontend.search.index', compact(
            'query',
            'pages',
            'news',
            'newsCategories',
            'services',
            'serviceCategories',
            'references',
            'totalResults'
        ));
    }
}
