<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Models\Banner;
use App\Models\Highlights;
use App\Models\Firstgallery;
use App\Models\Aboutitems;
use App\Models\Specialized;
use App\Models\Depratments;
use App\Models\Imagegallery;
use App\Models\GeneralSetting;
use App\Models\Category;
use App\Models\Page;
use App\Models\Ytvideo;
use App\Models\Reviews;
use App\Models\Blog;
use App\Models\BlogLike;
use App\Models\Testimonial;

class HomepageController extends Controller
{
    /**
     * Cache duration in seconds (5 minutes)
     */
    protected const CACHE_TTL = 300;

    /**
     * Helper to return cached JSON response with HTTP Cache-Control headers
     */
    protected function cachedResponse(string $key, int $ttl, callable $callback)
    {
        if (request()->query('refresh')) {
            Cache::forget($key);
        }

        $data = Cache::remember($key, $ttl, $callback);

        return response()->json($data, 200, [
            'Cache-Control' => 'public, max-age=300, stale-while-revalidate=600',
        ]);
    }

    /**
     * Consolidated homepage data endpoint - replaces 15 individual HTTP calls with 1
     */
    public function getHomepageData()
    {
        return $this->cachedResponse('client_homepage_data', self::CACHE_TTL, function () {
            return [
                'banners' => Banner::where('active', 1)->orderBy('order_position', 'ASC')->get(),
                'highlights' => Highlights::orderBy('id', 'ASC')->get(),
                'firstgallery' => Firstgallery::orderBy('id', 'ASC')->get(),
                'aboutitems' => Aboutitems::orderBy('id', 'ASC')->get(),
                'specialized' => Specialized::select('id', 'title', 'image', 'short_description')->orderBy('id', 'ASC')->get(),
                'departments' => Depratments::select('id', 'title', 'image')->orderBy('id', 'ASC')->get(),
                'imagegallery' => Imagegallery::orderBy('id', 'ASC')->limit(8)->get(),
                'videogallery' => Ytvideo::orderBy('id', 'ASC')->get(),
                'testimonials' => Testimonial::where('status', 1)->orderBy('id', 'ASC')->get(),
                'home_h2' => \App\Models\HomeH2Section::first(),
                'about_page' => \App\Models\AboutPage::first(),
                'reviews' => Reviews::orderBy('id', 'ASC')->get(),
                'general_settings' => GeneralSetting::first(),
                'categories' => Category::select('id', 'name', 'slug', 'order_no')
                    ->has('pages')
                    ->orderBy('order_no', 'ASC')
                    ->with(['pages' => function ($q) {
                        $q->select('id', 'category_id', 'page_name', 'slug');
                    }])
                    ->get(),
            ];
        });
    }

    // banners list api
    public function getBanners()
    {
        return $this->cachedResponse('client_banners', self::CACHE_TTL, function () {
            return Banner::where('active', 1)->orderBy('order_position', 'ASC')->get();
        });
    }

    // appointment diseases api
    public function getAppointmentDiseases()
    {
        return $this->cachedResponse('client_appointment_diseases', 600, function () {
            return \App\Models\AppointmentDisease::where('status', 1)->get();
        });
    }

    // home h2 section api
    public function getHomeH2Section()
    {
        return $this->cachedResponse('client_home_h2_section', self::CACHE_TTL, function () {
            return \App\Models\HomeH2Section::first();
        });
    }

    // about page api
    public function getAboutPage()
    {
        return $this->cachedResponse('client_about_page', self::CACHE_TTL, function () {
            return \App\Models\AboutPage::first();
        });
    }

    // contact page api
    public function getContactPage()
    {
        return $this->cachedResponse('client_contact_page', self::CACHE_TTL, function () {
            return \App\Models\ContactPage::first();
        });
    }

    // doctors api
    public function getDoctors()
    {
        return $this->cachedResponse('client_doctors', self::CACHE_TTL, function () {
            return \App\Models\Doctor::where('status', 1)->get();
        });
    }

    // highlights list api
    public function getHighlights()
    {
        return $this->cachedResponse('client_highlights', self::CACHE_TTL, function () {
            return Highlights::orderBy('id', 'ASC')->get();
        });
    }

    // first gallery list api
    public function getFirstgallery()
    {
        return $this->cachedResponse('client_firstgallery', self::CACHE_TTL, function () {
            return Firstgallery::orderBy('id', 'ASC')->get();
        });
    }

    // about items list api
    public function getAboutitems()
    {
        return $this->cachedResponse('client_aboutitems', self::CACHE_TTL, function () {
            return Aboutitems::orderBy('id', 'ASC')->get();
        });
    }

    // specialized list api (optimized: selects lightweight card fields unless ?full=1 is given)
    public function getSpecialized(Request $request)
    {
        $isFull = $request->query('full') == '1';
        $key = 'client_specialized_' . ($isFull ? 'full' : 'slim');

        return $this->cachedResponse($key, self::CACHE_TTL, function () use ($isFull) {
            $query = Specialized::orderBy('id', 'ASC');
            if (!$isFull) {
                $query->select('id', 'title', 'image', 'short_description');
            }
            return $query->get();
        });
    }

    // depratments list api (optimized: selects lightweight card fields unless ?full=1 is given)
    public function getDepratments(Request $request)
    {
        $isFull = $request->query('full') == '1';
        $key = 'client_departments_' . ($isFull ? 'full' : 'slim');

        return $this->cachedResponse($key, self::CACHE_TTL, function () use ($isFull) {
            $query = Depratments::orderBy('id', 'ASC');
            if (!$isFull) {
                $query->select('id', 'title', 'image');
            }
            return $query->get();
        });
    }

    // image gallery list api
    public function getImagegallery()
    {
        return $this->cachedResponse('client_imagegallery', self::CACHE_TTL, function () {
            return Imagegallery::orderBy('id', 'ASC')->get();
        });
    }

    // video gallery list api
    public function getVideogallery()
    {
        return $this->cachedResponse('client_videogallery', self::CACHE_TTL, function () {
            return Ytvideo::orderBy('id', 'ASC')->get();
        });
    }

    // testimonials list api
    public function getTestimonials()
    {
        return $this->cachedResponse('client_testimonials', self::CACHE_TTL, function () {
            return Testimonial::where('status', 1)->orderBy('id', 'ASC')->get();
        });
    }

    // general settings list api
    public function getGeneralSettings()
    {
        return $this->cachedResponse('client_general_settings', 600, function () {
            return GeneralSetting::first();
        });
    }

    // get dynamic page category with page names (optimized: extracts only necessary navbar fields, cuts 2.2MB to 3KB)
    public function getDynamicPageCategory()
    {
        return $this->cachedResponse('client_dynamic_page_categories_slim', 600, function () {
            return Category::select('id', 'name', 'slug', 'order_no')
                ->has('pages')
                ->orderBy('order_no', 'ASC')
                ->with(['pages' => function ($q) {
                    $q->select('id', 'category_id', 'page_name', 'slug');
                }])
                ->get();
        });
    }

    // get dynamic page with category id
    public function getDynamicPage($slug)
    {
        return $this->cachedResponse('client_dynamic_page_' . $slug, self::CACHE_TTL, function () use ($slug) {
            $page = Page::where('slug', $slug)->with('dynamicItems')->first();

            if (!$page) {
                // Fallback for Specialized services which the frontend routes to /page/{slug}
                // Match using lightweight titles; load article content only for the match.
                $specializedItems = Specialized::select('id', 'title')->get();
                foreach ($specializedItems as $item) {
                    $itemSlug = preg_replace('/[^\w-]+/', '', preg_replace('/\s+/', '-', strtolower($item->title)));
                    if ($itemSlug === $slug) {
                        $item = Specialized::select('id', 'title', 'content', 'short_description')->find($item->id);
                        if (!$item) {
                            return null;
                        }
                        return [
                            'id' => 'specialized_' . $item->id,
                            'page_name' => $item->title,
                            'content' => $item->content,
                            'seo_title' => $item->title,
                            'seo_description' => $item->short_description,
                            'page_type' => 'service',
                            'dynamic_items' => [],
                        ];
                    }
                }
            }

            return $page;
        });
    }

    // get reviews list api
    public function getReviews()
    {
        return $this->cachedResponse('client_reviews', self::CACHE_TTL, function () {
            return Reviews::orderBy('id', 'ASC')->get();
        });
    }

    // store new review api
    public function storeReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors(),
            ], 400);
        }

        try {
            $review = Reviews::create([
                'name' => $request->name,
                'rating' => $request->rating,
                'content' => $request->content,
            ]);

            // Invalidate caches
            Cache::forget('client_reviews');
            Cache::forget('client_homepage_data');

            return response()->json([
                'status' => 200,
                'message' => 'Review submitted successfully!',
                'review' => $review,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong while saving your review.',
            ], 500);
        }
    }

    // get blogs list api (optimized: selects lightweight list columns to avoid megabytes of blog article text in listings)
    public function getBlogs(Request $request)
    {
        $query = Blog::select('id', 'slug', 'blog_title', 'blog_image', 'category', 'read_time', 'views', 'likes', 'created_at', 'status')
            ->with(['blogCategory' => function ($q) {
                $q->select('id', 'name', 'slug');
            }])
            ->where('status', 1);

        if ($request->category && $request->category !== 'all') {
            $query->whereHas('blogCategory', function ($q) use ($request) {
                $q->where('slug', $request->category)->orWhere('name', $request->category);
            });
        }

        if ($request->search) {
            $query->where('blog_title', 'like', '%' . $request->search . '%');
        }

        $blogs = $query->latest()->paginate(8);

        // Get structured categories with lightweight blog cards
        $groupedCategories = \App\Models\BlogCategory::with(['blogs' => function ($q) use ($request) {
            $q->select('id', 'slug', 'blog_title', 'blog_image', 'category', 'read_time', 'views', 'likes', 'created_at', 'status')
              ->where('status', 1)
              ->latest();
            if ($request->search) {
                $q->where('blog_title', 'like', '%' . $request->search . '%');
            }
        }])->orderBy('order_no', 'asc')->get();

        return response()->json([
            'blogs' => $blogs,
            'grouped_categories' => $groupedCategories,
        ], 200, [
            'Cache-Control' => 'public, max-age=300, stale-while-revalidate=600',
        ]);
    }

    // get blog detail api
    public function getBlogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        // Increment views uniquely per IP (24-hour limit)
        $ip = request()->header('CF-Connecting-IP', request()->header('X-Forwarded-For', request()->ip()));
        if (str_contains($ip, ',')) {
            $ip = trim(explode(',', $ip)[0]);
        }
        $cacheKey = 'blog_viewed_' . $blog->id . '_' . $ip;

        if (!Cache::has($cacheKey)) {
            $blog->increment('views');
            Cache::put($cacheKey, true, now()->addHours(24));
        }

        // Related posts (lightweight columns)
        $related = Blog::select('id', 'slug', 'blog_title', 'blog_image', 'category', 'read_time', 'views', 'created_at')
            ->where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->where('status', 1)
            ->limit(3)
            ->get();

        // Popular posts (lightweight columns)
        $popular = Blog::select('id', 'slug', 'blog_title', 'blog_image', 'category', 'read_time', 'views', 'created_at')
            ->where('id', '!=', $blog->id)
            ->where('status', 1)
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();

        $ip = request()->ip();
        $is_liked = BlogLike::where('blog_id', $blog->id)->where('ip_address', $ip)->exists();

        return response()->json([
            'blog' => $blog,
            'related' => $related,
            'popular' => $popular,
            'is_liked' => $is_liked,
        ], 200, [
            'Cache-Control' => 'public, max-age=180, stale-while-revalidate=300',
        ]);
    }

    // like blog api
    public function likeBlog($id)
    {
        $blog = Blog::find($id);

        if (!$blog) {
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $ip = request()->ip();
        $existing_like = BlogLike::where('blog_id', $id)->where('ip_address', $ip)->first();

        if ($existing_like) {
            return response()->json(['message' => 'You have already liked this blog', 'likes' => $blog->likes], 200);
        }

        BlogLike::create([
            'blog_id' => $id,
            'ip_address' => $ip,
        ]);

        $blog->increment('likes');

        return response()->json([
            'message' => 'Blog liked successfully',
            'likes' => $blog->likes,
        ], 200);
    }
}
