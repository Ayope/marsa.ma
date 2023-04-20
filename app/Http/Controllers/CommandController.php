<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\Product;
use App\Models\PaymentInfo;
use Illuminate\Http\Request;
use App\Models\ProductCommand;

class CommandController extends Controller
{

    public function showCart($user_id)
    {
        $command = Command::with(['product' => function($query){
            $query->withPivot('quantity');
        }])->where('client_id', $user_id)
            ->where('status', NULL)
            ->get();

        $products = [];

        foreach ($command as $c) {
            $products = array_merge($products, $c->product->toArray());
        }

        return view('commande.cart', compact('products'));
    }

    public function addToCart(Request $request)
    {
        // add ajax

        $command = Command::where('client_id', $request->user_id)
                            ->where('status', NULL)
                            ->first();

        if(!$command){
            $command = Command::create([
                'client_id' => $request->user_id
            ]);
        }

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

            }else{
                return back()->with('fail', 'Product quantity is higher than available');
            }

        }else{
            return back()->with('fail', 'Product already exist in the cart');
        }
    }

    public function updateQuantityPrice(Request $request)
    {
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
    }

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

    public function checkout($user_id)
    {
        $command = Command::with(['product' => function($query){
            $query->withPivot('quantity');
        }])->where('client_id', $user_id)
            ->where('status', NULL)
            ->get();

        $products = [];

        foreach ($command as $c) {
            $products = array_merge($products, $c->product->toArray());
        }

        return view('commande.checkout', compact('products'));
    }

    public function CartCount($user_id)
    {
        $productNum = ProductCommand::with('command')
            ->whereHas('command', function($query) use ($user_id) {
                $query->where('client_id', $user_id)
                    ->where('status', NULL);
            })->count();

        return $productNum;
    }


    public function showCommands($user_id){

        $command = Command::with(['product' => function($query){
            $query->withPivot('quantity');
        }])->where('client_id', $user_id)
            ->where('status', '!=', NULL)
            ->orderBy('created_at', 'desc')
            ->get();

        $products = [];

        foreach ($command as $c) {
            $products = array_merge($products, $c->product->toArray());
        }

        return view('commande.yourCommandes', compact('products', 'command'));
    }


    public function cancelCommand($user_id, $command_id){

        $command = Command::with(['product' => function($query){
            $query->withPivot('quantity');
            }])->where('id', $command_id)
            ->where('client_id', $user_id)
            ->where('status', '!=', NULL)
            ->where('status', '!=', 'canceled')
            ->get();

        $updateStatus = $command[0]->update([
            'status' => 'canceled'
        ]);

        if($updateStatus){
            foreach ($command as $c) {
                for($i=0; $i < $c->product->count(); $i++){
                    $product = Product::find($c->product[$i]->id);
                    $quantityToAdd = $product->commands()->where('command_id', $command[0]->id)->first()->pivot->quantity;
                    $product->quantity += $quantityToAdd;
                    $product->save();
                }
            }
            return back();
        }


    }

    public function confirmCommand(Request $request)
    {
        $command = Command::with(['product' => function($query){
                $query->withPivot('quantity');
                }])->where('client_id', $request->user_id)
                ->where('status', NULL)
                ->get();

        $PaymentInfoInsert = false;
        $InsertPaymentMethod;


        if($command){
            $command[0]->update([
                'status' => 'confirmed',
            ]);


            if($request->PaymentMethod == 'offline'){
                $InsertPaymentMethod = $command[0]->update([
                    'payment_method' => $request->PaymentMethod
                ]);
            }else{
                $InsertPaymentMethod = $command[0]->update([
                    'payment_method' => $request->PaymentMethod
                ]);

                if($InsertPaymentMethod){
                    $request->validate([
                        'client_id' => 'required|numeric',
                        'card_number' => 'required|numeric|digits_between:13,19',
                        'security_code' => 'required|numeric|digits:3',
                        'expiration_month' => 'required|numeric|min:1|max:12',
                        'expiration_year' => 'required|numeric|min:' . date('Y') . '|max:' . (date('Y') + 10),
                    ]);
                    /* if the user already insert his user infos for the first time he automatically gets
                    the inputs filled and modify the payment infos if he want */
                    $PaymentInfoInsert = PaymentInfo::create([
                        'client_id' => $request->user_id,
                        'card_number' => $request->card_number,
                        'security_code' => $request->security_code,
                        'expiration_month' => $request->expiration_month,
                        'expiration_year' => $request->expiration_year
                    ]);
                }
            }

            if($PaymentInfoInsert || $InsertPaymentMethod){
                foreach ($command as $c) {
                    for($i=0; $i < $c->product->count(); $i++){
                        $product = Product::find($c->product[$i]->id);
                        $quantityToSubtract = $product->commands()->where('command_id', $command[0]->id)->first()->pivot->quantity;
                        $product->quantity -= $quantityToSubtract;
                        $product->save();
                    }
                }
            }

            return view('commande.confirmedCommand');
        }else{

            return back()->with('fail', 'Something went wrong! try again');
        }

    }


}
