<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ytvideo;

class YtvideoController extends Controller
{

        public function index()
    {
        $items = Ytvideo::all();
        return view('pages.ytvideo.index', compact('items'));
    }


        public function create()
    {
        return view('pages.ytvideo.create');
    }


        public function store(Request $request)
    {
        $request->validate([
            'youtubelink' => 'required',
            
        ]);

        $data = [
            'youtubelink' => $request->input('youtubelink'),
            
        ];


        Ytvideo::create($data);

        return redirect()->route('ytvideo.index')->with('success', 'Record created successfully.');
    }


        public function edit($id)
    {
        $item = Ytvideo::findOrFail($id);
        return view('pages.ytvideo.edit', compact('item'));
    }


        public function update(Request $request, $id)
    {
        $request->validate([
            'youtubelink' => 'required',
            
        ]);

        $data = [
            'youtubelink' => $request->input('youtubelink'),
            
        ];


        $item = Ytvideo::findOrFail($id);
        $item->update($data);

        return redirect()->route('ytvideo.index')->with('success', 'Record updated successfully.');
    }


        public function destroy($id)
    {
        $item = Ytvideo::findOrFail($id);
        $item->delete();


        return redirect()->route('ytvideo.index')->with('success', 'Record deleted successfully.');
    }
}
