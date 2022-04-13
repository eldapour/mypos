<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $products = Product::when($request->search, function ($q) use($request) {
            return $q->where('name' , 'like', '%' . $request->search . '%');
        })->when($request->category_id, function ($q) use ($request) {
            return $q->where('category_id', $request->category_id);
        })->latest()->paginate(5);
        $categories = Category::all();
        return view('dashboard.products.index',compact('products','categories'));
    } // end of index

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $request_data = $request->all();

        if ($request->image) {

            Image::make($request->image)->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            })
                ->save(public_path('uploads/products_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } // end of if


        Product::create($request_data);

        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.products.index');
} // end of store

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit',compact('categories','product'));
    } // end of edit

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'desc' => 'required',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        $request_data = $request->all();

        if ($request->image) {

            if ($request->image != 'default.png') {

                Storage::disk('public_uploads')->delete('/products_images/' . $product->image);
            } // end of inner if

            Image::make($request->image)->resize(300, null, function ($constraint){
                $constraint->aspectRatio();
            })
                ->save(public_path('uploads/products_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        } // end of if


        $product->update($request_data);

        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');
    } // end of update

    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.products.index');
    } // end of destroy

} // END PRODUCT CONTROLLER
