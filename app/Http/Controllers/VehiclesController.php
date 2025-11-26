<?php

namespace App\Http\Controllers;

use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $vehicles = Auth::user()->vehicles()->paginate(15);
        return view('vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_number' => 'required|string|unique:vehicles,vehicle_number|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:50',
            'vehicle_type' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_contact' => 'required|regex:/^[0-9]{10}$/',
            'secondary_contact' => 'nullable|regex:/^[0-9]{10}$/',
            'owner_email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        if ($request->hasFile('vehicle_image')) {
            $image = $request->file('vehicle_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('vehicles', $imageName, 'public'); // Saves to storage/app/public/vehicles
            $validated['vehicle_image'] = $imageName;
        }
        $request->user()->vehicles()->create($validated);
        return response()->json(['message' => 'Vehicle added successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $vehicle = Vehicles::findOrFail($id);
        return view('vehicles.show', compact('vehicle'));
    }

     public function showJobs($id)
    {
        $vehicle = Vehicles::findOrFail($id);
        $jobcards = $vehicle->jobcards()->get();
        // dd($jobcards);
        return view('vehicles.show', compact('jobcards', 'vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicles $vehicles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicles $vehicle)
    {
        $validated = $request->validate([
            'vehicle_number' => 'required|string|unique:vehicles,vehicle_number,' . $vehicle->id . '|max:255',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'fuel_type' => 'required|string|max:50',
            'vehicle_type' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_contact' => 'required|regex:/^[0-9]{10}$/',
            'secondary_contact' => 'nullable|regex:/^[0-9]{10}$/',
            'owner_email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'vehicle_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);
        if ($request->hasFile('vehicle_image')) {
            $image = $request->file('vehicle_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('vehicles', $imageName, 'public'); // Saves to storage/app/public/vehicles
            $validated['vehicle_image'] = $imageName;
        }

        $vehicle->update($validated);

        return response()->json(['message' => 'Vehicle updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicles $vehicles)
    {
        //
    }
}
