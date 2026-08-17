<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'faqs' => 'array',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function dynamicItems()
    {
        return $this->hasMany(PageDynamicItem::class);
    }

}