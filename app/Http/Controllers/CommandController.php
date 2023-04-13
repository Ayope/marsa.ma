<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;
use App\Models\ProductCommand;
use App\Http\Requests\StoreCommandRequest;
use App\Http\Requests\UpdateCommandRequest;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // replace all of that with ajax
        $command = Command::where('client_id', $request->user_id)->latest('created_at')->first();

        if(!$command){
            $command = Command::create([
                'client_id' => $request->user_id
            ]);
        }

        // the informations get filled when the user confirm the commande

        $CartProduct = ProductCommand::where('product_id', $request->product_id)
                                        ->where('command_id', $command->id)
                                        ->first();

        if(!$CartProduct){
            if($request->quantity <= $request->quantityOfProduct){
                $CartProduct = ProductCommand::create([
                    'command_id' => $command->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity ?? 1, // later check quantity (should be less than the product quantity)
                ]);

                if($CartProduct){
                    $productNum = ProductCommand::where('command_id', $command->id)->count();
                    $request->session()->put('productNum', $productNum);

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
    public function show(Command $command)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Command $command)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommandRequest $request, Command $command)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Command $command)
    {
        //
    }
}
