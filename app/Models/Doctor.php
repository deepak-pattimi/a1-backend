<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Doctor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'designation',
        'status'
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('client_doctors');
        });

        static::deleted(function () {
            Cache::forget('client_doctors');
        });
    }
}
