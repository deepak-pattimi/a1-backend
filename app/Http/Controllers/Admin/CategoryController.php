<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
// slug generator
use Illuminate\Support\Str;

class CategoryController extends Controller
{

        public function index()
    {
        $items = Category::whereOrderBy('order', 'asc')->get();
        return view('pages.category.index', compact('items'));
    }


        public function create()
    {
        return view('pages.category.create');
    }


        public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'order' => $request->input('order'),
        ];


        Category::create($data);

        return redirect()->route('category.index')->with('success', 'Record created successfully.');
    }


        public function edit($id)
    {
        $item = Category::findOrFail($id);
        return view('pages.category.edit', compact('item'));
    }


        public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'required',
            
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'order' => $request->input('order'),
        ];


        $item = Category::findOrFail($id);
        $item->update($data);

        return redirect()->route('category.index')->with('success', 'Record updated successfully.');
    }


        public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $item->delete();


        return redirect()->route('category.index')->with('success', 'Record deleted successfully.');
    }
}
