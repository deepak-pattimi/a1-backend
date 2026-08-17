<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeH2Section;
use Illuminate\Support\Facades\Storage;

class HomeH2SectionController extends Controller
{
    public function edit()
    {
        $h2Section = HomeH2Section::firstOrCreate(
            ['id' => 1],
            [
                'badge_title' => 'WHO WE ARE',
                'heading' => 'Pioneering Advanced Surgical Care in Vizag',
                'description' => 'A1 Laparoscopy Hospital is a premier medical institution dedicated to providing state-of-the-art minimally invasive surgical solutions.',
            ]
        );
        return view('pages.home_h2.edit', compact('h2Section'));
    }

    public function update(Request $request)
    {
        $h2Section = HomeH2Section::first();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('Gallery', 'public');
            $h2Section->image = 'storage/' . $imagePath;
        }

        $h2Section->badge_title = $request->badge_title;
        $h2Section->heading = $request->heading;
        $h2Section->description = $request->description;
        
        $h2Section->stat_1_value = $request->stat_1_value;
        $h2Section->stat_1_text = $request->stat_1_text;
        
        $h2Section->stat_2_value = $request->stat_2_value;
        $h2Section->stat_2_text = $request->stat_2_text;
        
        $h2Section->stat_3_value = $request->stat_3_value;
        $h2Section->stat_3_text = $request->stat_3_text;
        
        $h2Section->stat_4_value = $request->stat_4_value;
        $h2Section->stat_4_text = $request->stat_4_text;

        if($request->features) {
            // Convert newline separated text to array
            $featuresArray = array_filter(array_map('trim', explode("\n", $request->features)));
            $h2Section->features = $featuresArray;
        }

        $h2Section->save();

        return redirect()->back()->with('success', 'Home H2 Section updated successfully!');
    }
}
