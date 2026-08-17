<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactPage;
use Illuminate\Support\Facades\Storage;

class ContactPageController extends Controller
{
    public function edit()
    {
        $contactPage = ContactPage::firstOrCreate(
            ['id' => 1]
        );
        return view('pages.contact_page.edit', compact('contactPage'));
    }

    public function update(Request $request)
    {
        $contactPage = ContactPage::firstOrCreate(['id' => 1]);

        if ($request->hasFile('hero_image')) {
            $imagePath = $request->file('hero_image')->store('Gallery', 'public');
            $contactPage->hero_image = 'storage/' . $imagePath;
        }

        $contactPage->save();

        return redirect()->back()->with('success', 'Contact Page updated successfully!');
    }
}
