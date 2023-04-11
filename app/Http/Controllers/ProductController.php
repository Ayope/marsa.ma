<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function E_store()
    {
        $products = Product::all();
        return view('product.store', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'fish_type' => 'required|string|max:255',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'date_of_fishing' => 'required|date',
            'description' => 'required|string',
        ]);

        if($validatedData){
            $productImgName = $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('products-img'), $productImgName);

            $product = Product::create([
                'title' => $request->title,
                'fish_type' => $request->fish_type,
                'photo' => $productImgName,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'date_of_fishing' => $request->date_of_fishing,
                'description' => $request->description,
                'fisher_id' => $request->fisher_id,
                'status' => NULL
            ]);

            if($product){
                if($request->quantity <= 0){
                    $product->status = 'archived';
                }else{
                    $product->status = 'available';
                }
                $product->save();
            }

            if($product){
                return back()->with('success', 'product added successfully');
            } else {
                return back()->with('fail', 'something wrong!');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
