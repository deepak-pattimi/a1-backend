<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ytvideo extends Model
{
    use HasFactory;
    protected $table = 'ytvideo';
    protected $fillable = ['thumbnail', 'youtubelink'];
}
