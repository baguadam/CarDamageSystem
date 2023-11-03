<?php

namespace App\Http\Controllers;

use App\Models\damage;
use App\Http\Requests\StoredamageRequest;
use App\Http\Requests\UpdatedamageRequest;

class DamageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('damages.index');
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
    public function store(StoredamageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(damage $damage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(damage $damage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedamageRequest $request, damage $damage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(damage $damage)
    {
        //
    }
}
