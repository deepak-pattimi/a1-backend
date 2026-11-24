<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AppointmentDisease extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('client_appointment_diseases');
        });

        static::deleted(function () {
            Cache::forget('client_appointment_diseases');
        });
    }
}
