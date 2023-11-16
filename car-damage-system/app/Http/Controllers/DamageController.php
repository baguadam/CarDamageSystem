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
    public function show(Damage $damage)
    {
        //
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
                return view('damages.index', [
                    'message' => 'Car cannot be found in the database!'
                ]);
            }

            return view('damages.index', [
                'vehicle'    => $vehicle,
                'img_name' => $vehicle->img_hash_name ?? 'default.png'
            ]);
        } else {
            return view('damages.index');
        }
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
