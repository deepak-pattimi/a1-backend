<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    // banners list api
    public function getBanners(){
        $banners = Banner::where('active', 1)->orderBy('order_position', 'ASC')->get();
        return response()->json($banners, 200);
    }

    // appointment diseases api
    public function getAppointmentDiseases(){
        $diseases = \App\Models\AppointmentDisease::where('status', 1)->get();
        return response()->json($diseases, 200);
    }
    
    // home h2 section api
    public function getHomeH2Section(){
        $h2Section = \App\Models\HomeH2Section::first();
        return response()->json($h2Section, 200);
    }
    
    // about page api
    public function getAboutPage(){
        $aboutPage = \App\Models\AboutPage::first();
        return response()->json($aboutPage, 200);
    }

    // contact page api
    public function getContactPage(){
        $contactPage = \App\Models\ContactPage::first();
        return response()->json($contactPage, 200);
    }

    // doctors api
    public function getDoctors(){
        $doctors = \App\Models\Doctor::where('status', 1)->get();
        return response()->json($doctors, 200);
    }

    // highlights list api
    public function getHighlights(){
        $highlights = Highlights::orderBy('id', 'ASC')->get();
        return response()->json($highlights, 200);
    }

    // first gallery list api
    public function getFirstgallery(){
        $firstgallery = Firstgallery::orderBy('id', 'ASC')->get();
        return response()->json($firstgallery, 200);
    }   

    // about items list api
    public function getAboutitems(){
        $aboutitems = Aboutitems::orderBy('id', 'ASC')->get();
        return response()->json($aboutitems, 200);
    }    
    
    // specialized list api
    public function getSpecialized(){
        $specialized = Specialized::orderBy('id', 'ASC')->get();
        return response()->json($specialized, 200);
    }

    // depratments list api
    public function getDepratments(){
        $depratments = Depratments::orderBy('id', 'ASC')->get();
        return response()->json($depratments, 200);
    }

    // image gallery list api
    public function getImagegallery(){
        $imagegallery = Imagegallery::orderBy('id', 'ASC')->get();
        return response()->json($imagegallery, 200);
    }

    // video gallery list api
    public function getVideogallery(){
        $youtube_videos = Ytvideo::orderBy('id', 'ASC')->get();
        return response()->json($youtube_videos, 200);
    }

    // testimonials list api
    public function getTestimonials(){
        $testimonials = Testimonial::where('status', 1)->orderBy('id', 'ASC')->get();
        return response()->json($testimonials, 200);
    }

    // general settings list api
    public function getGeneralSettings(){
        $general_settings = GeneralSetting::first();
        return response()->json($general_settings, 200);
    }

    // get dynamic page category with page names
    public function getDynamicPageCategory(){
        $category = Category::has('pages')->orderBy('order_no', 'ASC')->with('pages')->get();
        return response()->json($category, 200);
    }
    
    // get dynamic page with category id
    public function getDynamicPage($slug){
        $page = Page::where('slug', $slug)->with('dynamicItems')->first();
        
        if (!$page) {
            // Fallback for Specialized services which the frontend routes to /page/{slug}
            $specializedItems = Specialized::all();
            foreach ($specializedItems as $item) {
                // Match frontend JS slug generation: title.toLowerCase().replace(/\s+/g, '-').replace(/[^\w-]+/g, '')
                $itemSlug = preg_replace('/[^\w-]+/', '', preg_replace('/\s+/', '-', strtolower($item->title)));
                if ($itemSlug === $slug) {
                    return response()->json([
                        'id' => 'specialized_'.$item->id,
                        'page_name' => $item->title,
                        'content' => $item->content,
                        'seo_title' => $item->title,
                        'seo_description' => $item->short_description,
                        'page_type' => 'service',
                        'dynamic_items' => []
                    ], 200);
                }
            }
        }
        
        return response()->json($page, 200);
    }

    // get reviews list api
    public function getReviews(){
        $reviews = Reviews::orderBy('id', 'ASC')->get();
        return response()->json($reviews, 200);
    }

    // store new review api
    public function storeReview(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'content' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()
            ], 400);
        }

        try {
            $review = Reviews::create([
                'name' => $request->name,
                'rating' => $request->rating,
                'content' => $request->content
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Review submitted successfully!',
                'review' => $review
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong while saving your review.'
            ], 500);
        }
    }

    
    // get blogs list api
    public function getBlogs(Request $request){
        $query = Blog::with('blogCategory')->where('status', 1);

        if($request->category && $request->category !== 'all'){
            $query->whereHas('blogCategory', function($q) use ($request) {
                $q->where('slug', $request->category)->orWhere('name', $request->category);
            });
        }

        if($request->search){
            $query->where('blog_title', 'like', '%' . $request->search . '%');
        }

        $blogs = $query->latest()->paginate(8);
        
        // Get structured categories with their blogs for grouped display
        $groupedCategories = \App\Models\BlogCategory::with(['blogs' => function($q) use ($request) {
            $q->where('status', 1)->latest();
            if($request->search){
                $q->where('blog_title', 'like', '%' . $request->search . '%');
            }
        }])->orderBy('order_no', 'asc')->get();
        
        return response()->json([
            'blogs' => $blogs,
            'grouped_categories' => $groupedCategories
        ], 200);
    }

    // get blog detail api
    public function getBlogDetail($slug){
        $blog = Blog::where('slug', $slug)->first();
        
        if(!$blog){
            return response()->json(['message' => 'Blog not found'], 404);
        }

        // Increment views uniquely per IP (24-hour limit)
        $ip = request()->header('CF-Connecting-IP', request()->header('X-Forwarded-For', request()->ip()));
        if (str_contains($ip, ',')) {
            $ip = trim(explode(',', $ip)[0]);
        }
        $cacheKey = 'blog_viewed_' . $blog->id . '_' . $ip;

        if (!\Illuminate\Support\Facades\Cache::has($cacheKey)) {
            $blog->increment('views');
            \Illuminate\Support\Facades\Cache::put($cacheKey, true, now()->addHours(24));
        }

        // Related posts
        $related = Blog::where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->where('status', 1)
            ->limit(3)
            ->get();

        // Popular posts
        $popular = Blog::where('id', '!=', $blog->id)
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
            'is_liked' => $is_liked
        ], 200);
    }

    // like blog api
    public function likeBlog($id){
        $blog = Blog::find($id);
        
        if(!$blog){
            return response()->json(['message' => 'Blog not found'], 404);
        }
        
        $ip = request()->ip();
        $existing_like = BlogLike::where('blog_id', $id)->where('ip_address', $ip)->first();
        
        if($existing_like){
             return response()->json(['message' => 'You have already liked this blog', 'likes' => $blog->likes], 200);
        }

        BlogLike::create([
            'blog_id' => $id,
            'ip_address' => $ip
        ]);

        $blog->increment('likes');
        
        return response()->json([
            'message' => 'Blog liked successfully',
            'likes' => $blog->likes
        ], 200);
    }
    

}


