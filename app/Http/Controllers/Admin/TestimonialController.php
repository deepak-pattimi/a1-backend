<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $items = Testimonial::all();
        return view('pages.testimonials.index', compact('items'));
    }

    public function create()
    {
        return view('pages.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'youtube_link' => 'required',
        ]);

        $data = [
            'youtube_link' => $request->input('youtube_link'),
        ];

        Testimonial::create($data);

        return redirect()->route('testimonials.index')->with('success', 'Record created successfully.');
    }

    public function edit($id)
    {
        $item = Testimonial::findOrFail($id);
        return view('pages.testimonials.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'youtube_link' => 'required',
        ]);

        $data = [
            'youtube_link' => $request->input('youtube_link'),
        ];

        $item = Testimonial::findOrFail($id);
        $item->update($data);

        return redirect()->route('testimonials.index')->with('success', 'Record updated successfully.');
    }

    public function destroy($id)
    {
        $item = Testimonial::findOrFail($id);
        $item->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }
}
