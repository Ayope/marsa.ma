<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;
use App\Models\ProductCommand;
use App\Http\Requests\StoreCommandRequest;
use App\Http\Requests\UpdateCommandRequest;

class CommandController extends Controller
{

    public function showCart($user_id)
    {
        $command = Command::with(['product' => function($query){
            $query->withPivot('quantity');
        }])->where('client_id', $user_id)->get();

        $products = [];

        foreach ($command as $c) {
            $products = array_merge($products, $c->product->toArray());
        }

        return view('commande.cart', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function confirmCommand()
    {
        //
    }

    public function addToCart(Request $request)
    {
        // replace all of that with ajax

        $command = Command::where('client_id', $request->user_id)->first();
        // and where status not equal confirmed or others ...(if status equal confirmed he can create new command)

        if(!$command){
            $command = Command::create([
                'client_id' => $request->user_id
            ]);
        }

        // the command's informations get filled when the user confirm the commande

        $CartProduct = ProductCommand::where('product_id', $request->product_id)
                                        ->where('command_id', $command->id)
                                        ->first();

        if(!$CartProduct){
            if($request->quantity <= $request->quantityOfProduct){
                $CartProduct = ProductCommand::create([
                    'command_id' => $command->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity ?? 1,
                    'price' => $request->price
                ]);

                if($CartProduct){
                    return back()->with('success', 'Product added successfully');
                }

                // the user also can update the quantity of the product in the cart page

                /* subtract the quantity from the quantity of the product in the products table
                if the user confirm command and add it again if he cancel the command */
            }else{
                return back()->with('fail', 'Product quantity is higher than available');
            }

                /*
                solve the session problem cause the user in another platform won't see
                how many products is in the cart (cause the number is stored in a session)
                instead find a way to pass it when you retrieve the data exist in the
                productCommand table to show it in the cart page
                */

                // find a way to update it once something is happened in the productCommand table


        }else{
            return back()->with('fail', 'Product already exist in the cart');
        }
    }

    /**
     * Display the specified resource.
     */
    public function CartCount($user_id)
    {
        $productNum = ProductCommand::with('command')
            ->whereHas('command', function($query) use ($user_id) {
                $query->where('client_id', $user_id);
            })->count();

        return $productNum;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function checkout($user_id)
    {
        $command = Command::with(['product' => function($query){
            $query->withPivot('quantity');
        }])->where('client_id', $user_id)->get();

        $products = [];

        foreach ($command as $c) {
            $products = array_merge($products, $c->product->toArray());
        }

        return view('commande.checkout', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateQuantityPrice(Request $request)
    {
        // validate the data first

        $quantity = $request->quantity;
        $productId = $request->productId;
        $userId = $request->userId;

        $product = ProductCommand::where('product_id', $productId)
                ->whereHas('command', function($query) use ($userId) {
                    $query->where('client_id', $userId);
                });

        $product->update([
            'quantity' => $quantity,
        ]);

        return response()->json([
            'quantity' => $quantity,
        ])->header('Content-Type', 'application/json');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteProductFromCart(Request $request)
    {
        $user_id = $request->user_id;
        $product = ProductCommand::where('product_id', $request->product_id)
                ->whereHas('command', function($query) use ($user_id) {
                    $query->where('client_id', $user_id);
                });

        if($product->delete()){
            return back()->with('success', 'deleted successfully');
        }
    }
}
