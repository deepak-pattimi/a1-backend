<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeH2Section extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'badge_title', 'heading', 'description', 'image',
        'stat_1_value', 'stat_1_text',
        'stat_2_value', 'stat_2_text',
        'stat_3_value', 'stat_3_text',
        'stat_4_value', 'stat_4_text',
        'features'
    ];
    
    protected $casts = [
        'features' => 'array'
    ];
}
