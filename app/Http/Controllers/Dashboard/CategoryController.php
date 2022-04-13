<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use($request) {
            return $q->where('name' , 'like', '%' . $request->search . '%');
        })->latest()->paginate(5);
        return view('dashboard.categories.index',compact('categories'));
    } // end of index

    public function create()
    {
        return view('dashboard.categories.create');
    } // end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        Category::create($request->all());

        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
    } // end of store

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    } // end of edit

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    } // end of delete
} // // END OF CATEGORY CONTROLLER
