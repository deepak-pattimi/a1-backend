<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imagegallery;

class ImagegalleryController extends Controller
{

        public function index()
    {
        $items = Imagegallery::all();
        return view('pages.imagegallery.index', compact('items'));
    }


        public function create()
    {
        return view('pages.imagegallery.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required_without:image_file',
            'image_file' => 'required_without:image|image|mimes:jpeg,png,jpg,gif,svg,webp|max:500',
        ]);

        $data = [];

        if ($request->hasFile('image_file')) {
            $imageFile = $request->file('image_file');
            $fileName = time() . '_' . $imageFile->getClientOriginalName();
            $destinationPath = public_path('uploads/imagegallery');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $imageFile->move($destinationPath, $fileName);

            $data['image'] = '/uploads/imagegallery/' . $fileName;
        } elseif ($request->image) {
            $data['image'] = $request->image;
        }

        Imagegallery::create($data);

        return redirect()->route('imagegallery.index')->with('success', 'Record created successfully.');
    }


        public function edit($id)
    {
        $item = Imagegallery::findOrFail($id);
        return view('pages.imagegallery.edit', compact('item'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:500',
        ]);

        $data = [];

        if ($request->hasFile('image_file')) {
            $imageFile = $request->file('image_file');
            $fileName = time() . '_' . $imageFile->getClientOriginalName();
            $destinationPath = public_path('uploads/imagegallery');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $imageFile->move($destinationPath, $fileName);

            $data['image'] = '/uploads/imagegallery/' . $fileName;
        } elseif ($request->image) {
            $data['image'] = $request->image;
        }

        $item = Imagegallery::findOrFail($id);
        if (!empty($data)) {
            $item->update($data);
        }

        return redirect()->route('imagegallery.index')->with('success', 'Record updated successfully.');
    }


        public function destroy($id)
    {
        $item = Imagegallery::findOrFail($id);
        $item->delete();


        return redirect()->route('imagegallery.index')->with('success', 'Record deleted successfully.');
    }
}
