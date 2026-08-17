<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'slug',
        'blog_title',
        'blog_content',
        'blog_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'meta_robots',
        'og_title',
        'og_description',
        'og_image',
        'og_url',
        'og_type',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'twitter_card',
        'canonical',
        'og_local',
        'status',
        'blog_category_id',
        'faqs',
        'category',
        'tags',
        'read_time',
        'views',
        'likes',
        'author_role',
        'author_image'
    ];

    protected $casts = [
        'faqs' => 'array',
    ];

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
