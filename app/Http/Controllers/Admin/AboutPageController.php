<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    private function getAboutPage()
    {
        return AboutPage::firstOrCreate(
            ['id' => 1],
            [
                'tagline' => 'Committed to Surgical Excellence',
                'sub_tagline' => 'Advanced and Affordable Laparoscopic and Bariatric Surgeries',
                'clinic_heading' => 'About Our Clinic',
                'clinic_description' => 'A1 Laparoscopy Hospital, located in Maharanipet, Visakhapatnam, is committed to delivering advanced and affordable laparoscopic and bariatric surgeries. Led by experienced specialists like Dr. Naveen Kumar Anem and Dr. I.S. Prathyusha, our hospital provides 24x7 comprehensive care with in-house ICU, diagnostic lab, pharmacy, and anesthesia support. From general surgery to gynecology and minimally invasive treatments, we offer expert-led care across specialties, all under one roof.',
                'doctor_heading' => 'Meet Dr. Naveen Kumar Anem',
                'doctor_name' => 'Dr. Naveen Kumar Anem',
                'custom_sections' => [
                    [
                        'heading' => 'Overview',
                        'content' => "Dr. Naveen Kumar Anem is a highly skilled laparoscopic surgeon specializing in minimally invasive surgical procedures. He completed his MBBS followed by MS in General Surgery. He has undergone advanced training in minimal access surgery and is specialized in laparoscopic and bariatric procedures.\n\nAt A1 Laparoscopy Hospital, Dr. Anem combines years of clinical expertise with the latest in laparoscopic technology to ensure quicker recovery, less pain, and minimal scarring for patients. With a focus on patient safety and personalized care, he provides comprehensive treatment solutions for various surgical conditions."
                    ],
                    [
                        'heading' => 'Areas of Expertise',
                        'content' => "Laparoscopic Gallbladder Removal\nMinimally Invasive Hernia Repair\nLaparoscopic Appendectomy\nWeight Loss Surgery (Bariatric Procedures)\nLaser Treatment for Varicose Veins\nLaparoscopic Hysterectomy\nOvarian Cyst Removal\nFibroid Removal\nGeneral Surgery\nGynecological Procedures"
                    ],
                    [
                        'heading' => 'Awards and Recognitions',
                        'content' => "Gold Medal in DM Neurology\nGold Medal in MBBS (3 subjects)\nBest Case Presentation Award - API Karnataka Chapter (2016)\nGold Medal - Movement Disorder Society of India (2020)"
                    ],
                    [
                        'heading' => 'Memberships',
                        'content' => "International Parkinson and Movement Disorder Society\nMovement Disorder Society of India\nAmerican Academy of Neurology\nIndian Academy of Neurology\nIndian Medical Association"
                    ],
                    [
                        'heading' => 'Research Work and Publications',
                        'content' => "Co-Author: \"Medical Management of Movement Disorders\" in the 4th edition of the textbook of Neurosurgery\nStudy: \"Clinical Profile of Lower Body Parkinsonism in a Tertiary Care Hospital in Southern India\"\nOriginal Article: \"Clinical Spectrum of Movement Disorders in Neurology Inpatients\"\nReview Article: \"Primary Angitis of Central Nervous System – A Challenging Diagnosis\""
                    ]
                ],
                'doctor_overview_heading' => 'Overview',
                'doctor_overview' => "Dr. Naveen Kumar Anem is a highly skilled laparoscopic surgeon specializing in minimally invasive surgical procedures. He completed his MBBS followed by MS in General Surgery. He has undergone advanced training in minimal access surgery and is specialized in laparoscopic and bariatric procedures.\n\nAt A1 Laparoscopy Hospital, Dr. Anem combines years of clinical expertise with the latest in laparoscopic technology to ensure quicker recovery, less pain, and minimal scarring for patients. With a focus on patient safety and personalized care, he provides comprehensive treatment solutions for various surgical conditions.",
                'doctor_expertise_heading' => 'Areas of Expertise',
                'doctor_awards_heading' => 'Awards and Recognitions',
                'doctor_memberships_heading' => 'Memberships',
                'doctor_research_heading' => 'Research Work and Publications',
            ]
        );
    }

    public function editClinic()
    {
        $aboutPage = $this->getAboutPage();
        return view('pages.about_page.edit_clinic', compact('aboutPage'));
    }

    public function updateClinic(Request $request)
    {
        $aboutPage = AboutPage::first();

        $aboutPage->tagline = $request->tagline;
        $aboutPage->sub_tagline = $request->sub_tagline;
        
        $aboutPage->clinic_heading = $request->clinic_heading;
        $aboutPage->clinic_description = $request->clinic_description;
        
        if($request->has('clinic_services')) {
            $servicesArray = array_filter(array_map('trim', explode("\n", $request->clinic_services)));
            $aboutPage->clinic_services = array_values($servicesArray);
        }
        
        $aboutPage->save();

        return redirect()->back()->with('success', 'About Clinic Page updated successfully!');
    }

    public function editDoctor()
    {
        $aboutPage = $this->getAboutPage();
        return view('pages.about_page.edit_doctor', compact('aboutPage'));
    }

    public function updateDoctor(Request $request)
    {
        $aboutPage = AboutPage::first();

        if ($request->hasFile('doctor_image')) {
            $imagePath = $request->file('doctor_image')->store('Gallery', 'public');
            $aboutPage->doctor_image = 'storage/' . $imagePath;
        }

        $aboutPage->doctor_heading = $request->doctor_heading;
        $aboutPage->doctor_name = $request->doctor_name;

        if ($request->has('custom_sections')) {
            $sections = [];
            foreach ($request->custom_sections as $sec) {
                if (!empty(trim($sec['heading'] ?? '')) || !empty(trim($sec['content'] ?? ''))) {
                    $sections[] = [
                        'heading' => trim($sec['heading'] ?? ''),
                        'content' => trim($sec['content'] ?? '')
                    ];
                }
            }
            $aboutPage->custom_sections = $sections;
        }

        if($request->has('doctor_designations')) {
            $designationsArray = array_filter(array_map('trim', explode("\n", $request->doctor_designations)));
            $aboutPage->doctor_designations = array_values($designationsArray);
        }
        
        if($request->has('doctor_expertise')) {
            $expertiseArray = array_filter(array_map('trim', explode("\n", $request->doctor_expertise)));
            $aboutPage->doctor_expertise = array_values($expertiseArray);
        }

        if($request->has('doctor_awards')) {
            $awardsArray = array_filter(array_map('trim', explode("\n", $request->doctor_awards)));
            $aboutPage->doctor_awards = array_values($awardsArray);
        }

        if($request->has('doctor_memberships')) {
            $membershipsArray = array_filter(array_map('trim', explode("\n", $request->doctor_memberships)));
            $aboutPage->doctor_memberships = array_values($membershipsArray);
        }

        if($request->has('doctor_research')) {
            $researchArray = array_filter(array_map('trim', explode("\n", $request->doctor_research)));
            $aboutPage->doctor_research = array_values($researchArray);
        }

        $aboutPage->save();

        return redirect()->back()->with('success', 'About Doctor Page updated successfully!');
    }
}
