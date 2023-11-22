<?php

namespace App\Http\Controllers;

use App\Models\Damage;
use App\Http\Requests\StoredamageRequest;
use App\Http\Requests\UpdatedamageRequest;
use App\Models\History;
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
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isAdmin) {
            return redirect()->route('damages.index')->with('message', 'This page can only be accessed by premium users!');
        }

        // átadjuk a view-nak az összes vehiclet, innen az id-k és a rendszámok fognak kelleni
        $vehicles = Vehicle::all();

        return view('damages.create', [
            'vehicles' => $vehicles
        ]);
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
            'place'         => 'required|min:1|max:64',
            'date'          => 'required|date|before_or_equal:now',
            'description'   => 'nullable|min:5|max:512',
            'license_ids'   => 'required|array|min:1',
            'license_ids.*' => 'distinct'
        ]);

        // létrehozzuk a damage-et a megfelelő táblában
        $damage = Damage::create([
            'place' => $request->place,
            'date'  => $request->date,
            'desc'  => $request->description,
        ]);

        // a kapcsolótáblában összekapcsoljuk a damage-et és a megadott rendszámokat
        $damage->vehicles()->sync($request->license_ids);

        return redirect()->route('damages.index')->with([
            'message' => 'Newly created damage has been successfully stored in the database!',
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Damage $damage)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isPremium) {
            return redirect()->route('damages.index')->with('message', 'This page can only be accessed by premium users!');
        }

        return view('damages.show', [
            'damage' => $damage
        ]);
    }

    public function search(Request $request) {
        // csak bejelentkezett felhasználók regisztrálhatnak
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // megszűrjük a beírt rendszámot, hogy megfelelő-e a formátum
        $request->validate([
            'license_plate' => 'required|regex:/^[a-zA-Z]{1,3}-?\d{3}$/',
        ]);
        $license_plate = strtoupper($request->license_plate); // ha megfelelő, akkor teljesen nagybetűsítjük
        // ezt követően, ha nem kötőjeles formátumban adta meg, átalakítjuk
        if (strlen($license_plate) !== 7) {
            $license_plate = substr($license_plate, 0, 3) . '-' . substr($license_plate, 3);
        }

        // elmenjük a keresési előzményekhez
        History::create([
            'user_id'     => auth()->user()->id,
            'license'     => $license_plate,
            'search_time' => date("Y-m-d H:i:s")
        ]);

        $vehicle = Vehicle::where('license', $license_plate)->first(); // kiszedjük az adatbázisből a járművet
        if (!$vehicle) { // ha nincs ilyen benne, akkor error message
            return view('damages.index', [
                'message' => 'Car cannot be found in the database!'
            ]);
        }
        return view('damages.index', [
            'vehicle'    => $vehicle,
            'img_name' => $vehicle->img_hash_name ?? 'default.png'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Damage $damage)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->isAdmin) {
            return redirect()->route('damages.index')->with('message', 'This page can only be accessed by premium users!');
        }

        // átadjuk a view-nak az összes vehiclet, innen az id-k és a rendszámok fognak kelleni
        $vehicles = Vehicle::all();

        return view('damages.edit', [
            'damage'   => $damage,
            'vehicles' => $vehicles
        ]);
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
