<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Specialized;

class SitemapController extends Controller
{
    public function __invoke()
    {
        $base = rtrim(config('app.frontend_url', 'https://www.a1laparoscopyhospital.com'), '/');
        $paths = ['', 'about-clinic', 'about-doctor', 'Contact', 'Reviews', 'blogs',
            'image-gallery', 'video-gallery', 'book-appointment', 'dr-prathyusha-gynecologist',
            'bariatric-surgery-visakhapatnam', 'hernia-repair-visakhapatnam',
            'laparoscopic-surgery-visakhapatnam', 'gallstone-surgery-visakhapatnam',
            'appendectomy-visakhapatnam', 'hysterectomy-visakhapatnam',
            'hysteroscopy-visakhapatnam', 'piles-fistula-treatment-visakhapatnam'];
        foreach (Page::pluck('slug') as $slug) {
            $paths[] = 'page/' . rawurlencode($slug);
        }
        foreach (Blog::where('status', 1)->pluck('slug') as $slug) {
            $paths[] = 'blog/' . rawurlencode($slug);
        }
        foreach (Specialized::pluck('title') as $title) {
            $slug = preg_replace('/[^\w-]+/', '', preg_replace('/\s+/', '-', strtolower($title)));
            $paths[] = 'page/' . rawurlencode($slug);
        }
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach (array_unique($paths) as $path) {
            $xml .= '<url><loc>' . htmlspecialchars($base . '/' . $path, ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc></url>';
        }
        return response($xml . '</urlset>', 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=300',
        ]);
    }
}
