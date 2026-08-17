<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tagline',
        'sub_tagline',
        'clinic_heading',
        'clinic_description',
        'clinic_services',
        'doctor_heading',
        'doctor_name',
        'doctor_designations',
        'doctor_image',
        'custom_sections',
        'doctor_overview_heading',
        'doctor_overview',
        'doctor_expertise_heading',
        'doctor_expertise',
        'doctor_awards_heading',
        'doctor_awards',
        'doctor_memberships_heading',
        'doctor_memberships',
        'doctor_research_heading',
        'doctor_research'
    ];
    
    protected $casts = [
        'clinic_services' => 'array',
        'doctor_designations' => 'array',
        'custom_sections' => 'array',
        'doctor_expertise' => 'array',
        'doctor_awards' => 'array',
        'doctor_memberships' => 'array',
        'doctor_research' => 'array'
    ];
}
