<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Http\Requests\StoreCommandRequest;
use App\Http\Requests\UpdateCommandRequest;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCommandRequest $request)
    {
        //
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
