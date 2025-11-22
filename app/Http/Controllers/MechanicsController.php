<?php

namespace App\Http\Controllers;

use App\Models\Mechanics;
use Illuminate\Http\Request;

class MechanicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mechanics = Mechanics::all();
        return view('mechanics.index', compact('mechanics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'nullable|unique:mechanics|regex:/^[0-9]{10}$/',
        ]);

        $request->user()->mechanics()->create($validated);

        return response()->json(['message' => 'Mechanic added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mechanics $mechanics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mechanics $mechanics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mechanics $mechanic)
    { 
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'phone' => 'nullable|unique:mechanics,phone,' . $mechanic->id . '|regex:/^[0-9]{10}$/',
        ]);

        $mechanic->update($validated);
        return response()->json(['message' => 'Mechanic updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mechanics $mechanics)
    {
        //
    }
}
