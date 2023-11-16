<?php

namespace App\Http\Controllers;

use App\Models\vehicle;
use App\Http\Requests\StorevehicleRequest;
use App\Http\Requests\UpdatevehicleRequest;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vehicles.index');
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
    public function store(StorevehicleRequest $request)
    {
        //
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', [
            'vehicle' => $vehicle,
        ]);
    }

    public function search(Request $request) {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'license_plate' => 'required|regex:/^[a-zA-Z]{1,3}-?\d{3}$/',
        ]);

        $license_plate = strtoupper($request->license_plate);
        if (strlen($license_plate) !== 7) {
            $license_plate = substr($license_plate, 0, 3) . '-' . substr($license_plate, 3);
        }

        if ($license_plate) {
            $vehicle = Vehicle::where('license', $license_plate)->first();
            if (!$vehicle) {
                return view('vehicles.index', [
                    'message' => 'Car cannot be found in the database!'
                ]);
            }

            return view('vehicles.index', [
                'vehicle'    => $vehicle,
                'img_name' => $vehicle->img_hash_name ?? 'default.png'
            ]);
        } else {
            return view('vehicles.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatevehicleRequest $request, vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(vehicle $vehicle)
    {
        //
    }
}
