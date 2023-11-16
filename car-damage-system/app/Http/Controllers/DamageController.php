<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use App\Http\Requests\StoredamageRequest;
use App\Http\Requests\UpdatedamageRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DamageController extends Controller
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
    public function store(StoredamageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Damage $damage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Damage $damage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedamageRequest $request, Damage $damage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Damage $damage)
    {
        //
    }
}
