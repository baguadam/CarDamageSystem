<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\StorevehicleRequest;
use App\Http\Requests\UpdatevehicleRequest;

class VehicleController extends Controller
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
        if (!auth()->check() || !auth()->user()->isAdmin) {
            return redirect()->route('damages.index')->with('message', 'This page can only be accessed by ADMIN users');
        }

        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorevehicleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
