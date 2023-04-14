<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'date_of_fishing' => 'required|date|before:today',
            'description' => 'required|string',
        ],
        [
            'date_of_fishing.before' => 'The date of fishing must be the date of today or before.'
        ]);

        if($validatedData){
            $productImgName = time().'.'.$request->file('photo')->getClientOriginalName();
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
                return redirect('/products')->with('success', 'product added successfully');
            } else {
                return back()->with('fail', 'something wrong!');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($title)
    {
        $product = Product::with('user')->where('title', $title)->first(); // get the ratings later
        return view('product.storeShow', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'fish_type' => 'required|string|max:255',
            'photo' => 'image|mimes:png,jpg,jpeg|max:2048',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'date_of_fishing' => 'required|date',
            'description' => 'required|string',
        ]);

        $product = Product::find($id);

        if($request->hasFile('photo')){

            $path = public_path('products-img/'. $product->photo);

            if(file_exists($path) && $product->photo != null){
                unlink($path);
            }

            $imageName = time().'.'.$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('products-img'), $imageName);

            $product->photo = $imageName;
        }

        $product->title = $request->title;
        $product->fish_type = $request->fish_type;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->date_of_fishing = $request->date_of_fishing;
        $product->description = $request->description;

        $store = $product->save();

        if($store){
            return redirect('/products')->with('success', 'Your product has been modified');
        }else {
            return redirect('/products')->with('fail', 'Something went wrong, try again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        /* if user delete do soft delete by just turn it the status
        of the product to unavailable*/

        $product = Product::find($id);

        $path = public_path('products-img/'. $product->photo);

        if(file_exists($path) && $product->photo != null){
            unlink($path);
        }

        $product->delete();

        return back()->with('success', 'Product deleted successfully');
    }

    public function search(Request $request){

        $searchTerm = $request->search;

        $products = DB::table('products')
                    ->where('title', 'like', '%'.$searchTerm.'%')
                    ->orWhere('description', 'like', '%'.$searchTerm.'%')
                    ->get();

        if(count($products) == 0){
            $products = false;
        }

        return view('product.search', compact('products'));

    }
}
