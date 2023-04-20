<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use App\Models\Command;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /* this function check if the user can't add a rating until he have a confirmed command
    with this product in it */
    public function checkUser($user_id, $product_id){

        $user = Command::whereHas('productCommand', function($q) use($product_id){
            $q->where('product_id', $product_id);
        })
        ->where('status', 'delivered')
        ->where('client_id', $user_id)
        ->get();

        return $user;
    }
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
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'required|string'
        ]);

        $ratingInsert = Rating::create([
            'client_id' => $request->session()->get('user')->id,
            'ratings' => $request->rating,
            'review' => $request->review,
            'product_id' => $request->product_id,
        ]);

        if($ratingInsert){
            return back()->with('success', 'your review added successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
