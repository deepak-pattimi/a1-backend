<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $items = BlogCategory::orderBy('order_no', 'asc')->get();
        return view('pages.blog-categories.index', compact('items'));
    }

    public function create()
    {
        return view('pages.blog-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'order_no' => 'required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'order_no' => $request->input('order_no'),
        ];

        BlogCategory::create($data);

        return redirect('admin/blog')->with('success', 'Blog category created successfully.');
    }

    public function edit($id)
    {
        $item = BlogCategory::findOrFail($id);
        return view('pages.blog-categories.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'order_no' => 'required',
        ]);

        $data = [
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'order_no' => $request->input('order_no'),
        ];

        $item = BlogCategory::findOrFail($id);
        $item->update($data);

        return redirect('admin/blog')->with('success', 'Blog category updated successfully.');
    }

    public function destroy($id)
    {
        $item = BlogCategory::findOrFail($id);
        $item->delete();

        return redirect('admin/blog')->with('success', 'Blog category deleted successfully.');
    }
}
