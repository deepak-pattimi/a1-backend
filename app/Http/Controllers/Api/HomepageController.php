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
use App\Models\Page;
use App\Models\Reviews;
use App\Models\Blog;

class HomepageController extends Controller
{
    // banners list api
    public function getBanners(){
        $banners = Banner::where('active', 1)->orderBy('order_position', 'ASC')->get();
        return response()->json($banners, 200);
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

    // general settings list api
    public function getGeneralSettings(){
        $general_settings = GeneralSetting::first();
        return response()->json($general_settings, 200);
    }

    // get dynamic page category with page names
    public function getDynamicPageCategory(){
        $category = Category::orderBy('id', 'ASC')->with('pages')->get();
        return response()->json($category, 200);
    }
    
    // get dynamic page with category id
    public function getDynamicPage($slug){
        $page = Page::where('slug', $slug)->with('dynamicItems')->first();
        return response()->json($page, 200);
    }

    // get reviews list api
    public function getReviews(){
        $reviews = Reviews::orderBy('id', 'ASC')->get();
        return response()->json($reviews, 200);
    }
    
    // get blogs list api
    public function getBlogs(Request $request){
        $query = Blog::where('status', 1);

        if($request->category && $request->category !== 'all'){
            $query->where('category', $request->category);
        }

        if($request->search){
            $query->where('blog_title', 'like', '%' . $request->search . '%');
        }

        $blogs = $query->latest()->paginate(8);
        
        // Get unique categories for filter
        $categories = Blog::where('status', 1)->select('category')->distinct()->pluck('category');
        
        return response()->json([
            'blogs' => $blogs,
            'categories' => $categories
        ], 200);
    }

    // get blog detail api
    public function getBlogDetail($id){
        $blog = Blog::find($id);
        
        if(!$blog){
            return response()->json(['message' => 'Blog not found'], 404);
        }

        // Increment views
        $blog->increment('views');

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

        return response()->json([
            'blog' => $blog,
            'related' => $related,
            'popular' => $popular
        ], 200);
    }
    

}


