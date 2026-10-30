<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use DataTables;
use App\Models\Category;

class PageController extends Controller
{

     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::latest()->get();      

        if ($request->ajax()) {

            $query = Page::select('id', 'page_name', 'slug', 'category_id', 'created_at')
                ->with(['category' => function ($q) {
                    $q->select('id', 'name');
                }])
                ->latest();

            if ($request->has('category_id') && !empty($request->category_id)) {
                $query->where('category_id', $request->category_id);
            }

            $data = $query->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $dynamicItemsUrl = '/admin/pages/' . $row->id . '/dynamic-items';
                    $btn = '<a href="'.$dynamicItemsUrl.'" data-toggle="tooltip" data-original-title="Dynamic Items" class="btn btn-info btn-sm mr-1"><i class="fa fa-list"></i></a>';

                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fa fa-pen"></i></a>';

                    $btn .= ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.dynamic-pages.index', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */    
    public function store(Request $request)
    {
        $rules = [
            'page_name' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required',
            'faqs' => 'nullable|array',
        ];

        file_put_contents(storage_path('logs/debug.txt'), json_encode($request->all()));

        $request->validate($rules);

        $data = [
            'slug' => Str::slug($request->page_name),
            'page_name' => $request->page_name,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'faqs' => $request->faqs,
        ];

    
        if ($request->item_id) {
            Page::where(['id' => $request->item_id])->update($data);
            return response()->json(['success' => 'Record has been updated successfully.']);
        } else {
            Page::create($data);
            return response()->json(['success' => 'New record has been saved successfully.']);
        }
    }
    
    
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Page::find($id);
        return response()->json($product);
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::where('id', $id)->delete();

        return response()->json(['success' => 'record has been deleted successfully.']);
    }

   
}