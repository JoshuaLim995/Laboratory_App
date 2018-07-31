<?php

namespace App\Http\Controllers;

use DataTables;
use App\Category;
use Illuminate\Http\Request;
use Session;
use Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('staff');
        $this->middleware('admin', ['only' => ['create', 'store', 'edit', 'update', 'delete']]);
    }

    public function index()
    {
        return view('category.index');
    }

    public function get_datatable()
    {
        $categories = Category::select([
            'id',
            'name',
            ]);

        return DataTables::eloquent($categories)
        ->addColumn('action', function ($category) {
            return $this->getActionButtons($category);
        })
        ->toJson();
    }

    public function getActionButtons($category)
    {
        if(Auth::user()->isAdmin() || Auth::user()->isdlmsa())
        {
            return 
            '<div class="action">' .
            '<a href="'. route('category.edit', $category) .'" class="btn btn-success">Edit</a>' .
            '<a href="'. route('category.delete', $category) .'" class="btn btn-danger"' . ' onclick="if(!confirm(' . "'Are you sure delete this record?'". ')){return false;};"' . '">Delete</a>' .
            '</div>';
        }
        else
        {
            return null;
        }
    }

    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $request->validate([
            'name' => 'required',
            ]);

        $category = new Category();
        $category->fill($request->all());
        $category->save();
        Session::flash('success', 'New Category added successfully!');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('category.show', [
            'category' => $category,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        $request->session()->flash('success', 'Category updated successfully!');
        return redirect()->route('category.index');
    }

    public function delete(Category $category)
    {
        // $inventories = $category->inventories()->delete();

        $category->delete();
        Session::flash('success', 'Category deleted successfully');
        return redirect()->route('category.index');
    }
}
