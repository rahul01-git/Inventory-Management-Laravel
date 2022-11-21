<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Image;
use App\Models\Supplier;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $page_title = 'Products';
        return view('product.index',compact('products','page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::where('status',1)->get();
        $page_title = 'Add  Products';
        return view('product.create',compact('categories','page_title','suppliers'));
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
            'name' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ]);

        if($request->hasFile('image')){
            $image = date('YmdHis'). '.'. $request->file('image')->extension();
            Image::make($request->file('image'))->save(public_path('/uploads/product/').$image);
        }

        Product::create([
            'name' => $request->name,
            'image' => $image,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
        ]);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $suppliers = Supplier::where('status',1)->get();
        $product = Product::findOrFail($id);
        $page_title = 'Edit Product';
        return view('product.edit',compact('categories','suppliers','product','page_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ]);

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $path = public_path('/uploads/product/').$product->image;
            if(file_exists($path)){
                unlink($path);
            }

            $image = date('YmdHis'). '.'. $request->file('image')->extension();
            Image::make($request->file('image'))->save(public_path('/uploads/product/').$image);
            $product->image = $image;
        }

        $product->update([
            'name' => $request->name,
            'image' => $product->image,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
        ]);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $path = public_path('/uploads/product/').$product->image;
        if(file_exists($path)){
            unlink($path);
        }

        $product->delete();
        return back();
    }
}
