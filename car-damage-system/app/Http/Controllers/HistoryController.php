<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Http\Requests\StorehistoryRequest;
use App\Http\Requests\UpdatehistoryRequest;
use App\Models\Vehicle;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('damages.index');
        }

        $histories = History::where('user_id', auth()->user()->id)->paginate(10); // kiszedjük paginate-tel a history-kat
        foreach ($histories as $history) {
            $vehicle = Vehicle::where('license', $history->license)->first(); // mivel olyan keresések is tárolunk, amik validak, de nemlétező rendszámra kerestek
            $image_hash_name = 'default.png';
            if ($vehicle) { // ha létezik a jármű
                $image_hash_name = $vehicle->image_hash_name ?? 'default.png';
            }
            $history->image_hash_name = $image_hash_name; // eltároljuk a history-ban a járműhöz tartozó image nevet is
        }

        return view('histories.index', [
            'histories' => $histories,
        ]);
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
    public function store(StorehistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(history $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(history $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatehistoryRequest $request, history $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(history $history)
    {
        //
    }
}
