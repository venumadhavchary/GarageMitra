<?php

namespace App\Http\Controllers;

use App\Models\Jobcards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehicles;
use App\Models\Mechanics;
use App\Models\Service;

class JobcardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($status = null)
    {
        //of usrs
        $jobcards = Auth::user()->jobcards()->paginate(15);

        return view('jobcards.index', compact('jobcards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($vehicle_id)
    {
        $vehicle = Vehicles::findOrFail($vehicle_id);
        $mechanics = Mechanics::all();
        $services = Service::all();
        $user = Auth::user();
        return view('jobcards.create', compact('vehicle', 'mechanics', 'services', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $vehicle_id)
    {
        //
        $validated = $request->validate([
            'assigned_date' => 'required|date',

            'services' => 'required|array|min:1',
            'services.*' => 'string|max:255',

            'remarks' => 'nullable|string',

            'paid_amount' => 'nullable|integer|min:0',
            'odometer_reading' => 'required|integer|min:0',
            'fuel_level' => 'nullable|integer|min:0|max:100',

            'vehicle_received_from' => 'required|in:owner,other',
            'vehicle_received_from_other' => 'required_if:vehicle_received_from,other|max:255',

            'vehicle_collected_by' => 'required|in:owner,other',
            'vehicle_collected_by_other' => 'required_if:vehicle_collected_by,other|max:255',

            'mechanic_name' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',

            'estimated_completion_date' => 'nullable|date',

            'vehicle_condition' => 'nullable|string',

            'vehicle_images' => 'nullable|array',
            'vehicle_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation

        ]);

        $validated['services'] = $this->formatServices($validated['services']);
        if (empty($validated['mechanic_name'])) {
            $validated['mechanic_name'] = Auth::user()->name;
        }

        $images = [];
        if ($request->hasFile('vehicle_images')) {
            foreach ($request->file('vehicle_images') as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('jobcards', $imageName, 'public');
                $images[] = $imageName;
            }
        }
        $validated['vehicle_images'] = json_encode($images);

        $vehicle = Vehicles::findOrFail($vehicle_id);
        $validated['vehicle_number'] = $vehicle->vehicle_number;
        $validated['vehicle_id'] = $vehicle_id;
        $validated['vehicle_type'] = $vehicle->vehicle_type;

        // dd( $validated);
        $request->user()->jobcards()->create($validated);

        return redirect()->route('vehicles.show', $vehicle_id)->with('success', 'Jobcard created successfully.');
    }

    private function formatServices($services)
    {
        $finalServices = [];
        foreach ($services as $service) {

            // If service exists by slug → simply add it
            if (Service::where('slug', $service)->exists()) {
                $finalServices[] = $service;
                continue;
            }

            // New service (text from "Other")
            $slug = strtolower(str_replace(' ', '_', $service));

            // Create new service in DB
            $created = Service::create([
                'name' => $service,
                'slug' => $slug
            ]);

            // Add new slug to list
            $finalServices[] = $slug;
        }
        return json_encode($finalServices);
    }
    /**
     * Display the specified resource.
     */
    public function show(Jobcards $jobcards, $id)
    {
        $job = Jobcards::findOrFail($id);
        $job->vehicle_images = json_decode($job->vehicle_images);
        return view('jobcards.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jobcards $jobcards)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jobcard = Jobcards::findOrFail($id);
        $validated = $request->validate([
            'paid_amount' => 'nullable|integer|min:0',
            'odometer_reading' => 'required|integer|min:0',
            'fuel_level' => 'nullable|integer|min:0|max:100',
            'vehicle_received_from' => 'required|string|max:255',
            'vehicle_returned_to' => 'required|string|max:255',
            'remarks' => 'nullable|string',
        ]);
 
        $result = $jobcard->update($validated); 

        return response()->json(['message' => 'Jobcard updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jobcards $jobcards)
    {
        //
    }
}
