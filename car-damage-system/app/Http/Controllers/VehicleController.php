<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Requests\UpdatevehicleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isAdmin) {
            return abort(403);
        }

        $request->validate([
            'license'      => 'required|regex:/^[a-zA-Z]{1,3}-?\d{3}$/',
            'model'        => 'required|min:1|max:50',
            'type'         => 'required|min:1|max:50',
            'year'         => 'required',
            'attach_image' => 'required|file|mimes:jpg,jpeg,png|max:4096',
        ], [
            'required'     => 'This field cannot be empty!'
        ]);

        $license = strtoupper($request->license); // ha megfelelő, akkor teljesen nagybetűsítjük
        // ezt követően, ha nem kötőjeles formátumban adta meg, átalakítjuk
        if (strlen($license) !== 7) {
            $license = substr($license, 0, 3) . '-' . substr($license, 3);
        }

        // a feltöltött kép eltárolása, a név hashelése, most nem kell ellenőrizni, hogy létezik-e a fájl
        // mivel kötelezővé tettük a feltöltést
        $file = $request->file('attach_image');
        $image_hash_name = $file->hashName();
        Storage::disk('public')->put('images/' . $image_hash_name, $file->get());

        // a jármű tényleges létrehozása az adatbázisban
        Vehicle::create([
            'license'       => $license,
            'model'         => $request->model,
            'type'          => $request->type,
            'year'          => $request->year,
            'img_hash_name' => $image_hash_name
        ]);

        return redirect()->route('damages.index')->with([
            'message' => 'Vehicle has been successfully stored in the database!',
            'success' => true,
        ]);
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
        if (!auth()->check() || !auth()->user()->isAdmin) {
            return redirect()->route('damages.index')->with('message', 'This page can only be accessed by ADMIN users');
        }

        $vehicle = Vehicle::findOrFail($vehicle->id);

        return view('vehicles.edit', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isAdmin) {
            return abort(403);
        }

        $request->validate([
            'license'      => 'required|regex:/^[a-zA-Z]{1,3}-?\d{3}$/',
            'model'        => 'required|min:1|max:50',
            'type'         => 'required|min:1|max:50',
            'year'         => 'required',
            'attach_image' => 'nullable|file|mimes:jpg,jpeg,png|max:4096',
        ], [
            'required'     => 'This field cannot be empty!'
        ]);

        $vehicle = Vehicle::findOrFail($vehicle->id); // kiszedjük a megfelelő járművet az adatbázisból

        $new_image_hash_name = null;
        if ($request->hasFile('attach_image')) {
            // ha töltött fel a felhasználó képet, a korábbi törüljük, majd feltöltjük
            // a tárhelyre az újonnan kívántat
            $file = $request->file('attach_image');
            $new_image_hash_name = $file->hashName();
            if ($vehicle->img_hash_name) { // ha nem null, akkor törüljük
                Storage::disk('public')->delete('images/' . $vehicle->img_hash_name); // töröljük a tárhelyről a korábbit
            }
            Storage::disk('public')->put('images/' . $new_image_hash_name, $file->get()); // új feltöltése
        } else {
            $new_image_hash_name = $vehicle->img_hash_name;
        }

        // frissítjük az adatbáziban az adott járművet az új adatok alapján
        $vehicle->update([
            'license'       => $request->license,
            'model'         => $request->model,
            'type'          => $request->type,
            'year'          => $request->year,
            'img_hash_name' => $new_image_hash_name
        ]);

        return redirect()->route('damages.index')->with([
            'message' => 'Vehicle has been updated in the database!',
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
