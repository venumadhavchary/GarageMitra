<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;
use App\Models\Jobcards;
use App\Models\Service;
use App\Models\User;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function generateBill($jobcard_id){
        $job = Jobcards::findOrFail($jobcard_id);
        $vehicle_type = $job->vehicle_type;
        $services = Service::where('vehicle_type', $vehicle_type)->get();
        return view('bills.generate', compact('job'));
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
    public function store(Request $request, $jobcard_id)
    {
        $jobcard = Jobcards::findOrFail($jobcard_id);
        $validated = $request->validate([
            'spare_parts' => 'nullable|array',
            'labour_charges' => 'nullable|array',
            'services' => 'required|array',
            'additional_labour_charge' => 'nullable|numeric',
            'estimated_delivery' => 'nullable|date',
            'vehicle_images' => 'nullable|array',
            'vehicle_images.*' => 'nullable|image|max:2048',
        ]);

        $validated['jobcard_id'] = $jobcard->id;
        $validated['spare_parts'] = json_encode($validated['spare_parts'] ?? []);
        $validated['labour_charges'] = json_encode($validated['labour_charges'] ?? []);
        $validated['services_to_do'] = json_encode($validated['services'] ?? []);

        $total_amount = 0;
        if(isset($validated['spare_parts'])){
            foreach (json_decode($validated['spare_parts'], true) as $part){
                $total_amount += $part['price_per_unit'] * $part['qty'];
            }
        }
        if(isset($validated['labour_charges'])){
            foreach (json_decode($validated['labour_charges'], true) as $labour){
                $total_amount += $labour['charge'];
            }
        }
        if(isset($validated['additional_labour_charge'])){
            $total_amount += $validated['additional_labour_charge'];
        }
        if(isset($validated['services_to_do'])){
            foreach (json_decode($validated['services_to_do'], true) as $service){
                $total_amount += $service['price'];
            }
        }
        $validated['total_amount'] = $total_amount;
        $images = [];
        if($request->hasFile('vehicle_images')){
            foreach ($request->file('vehicle_images') as $image){
                $imageName = time().'_'.$image->getClientOriginalExtension();
                $image->move(public_path('bills/vehicles') , $imageName);
                $images[] = $imageName;
            }
        }
        $validated['vehicle_images'] = json_encode($images);
        
        $jobcard->bill()->create($validated);

        return response()->json(['message' => 'Bill generated successfully', 'url' => route('jobcards.show', $jobcard->id)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $bill = Bill::where('jobcard_id', $id)->first();
        if(!$bill){
            return redirect()->route('bills.generate', $id);
        }
        $job = Jobcards::findOrFail($id);
        $vehicle = $job->vehicle;
        $bill->spare_parts = json_decode($bill->spare_parts);
        $bill->labour_charges = json_decode($bill->labour_charges);
        $bill->services_to_do = json_decode($bill->services_to_do);
        return view('bills.show', compact('bill', 'job', 'vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'spare_parts' => 'nullable|array',
            'labour_charges' => 'nullable|array',
            'services' => 'required|array',
            'additional_labour_charge' => 'nullable|numeric',
            'estimated_delivery' => 'nullable|date',
            'vehicle_images' => 'nullable|array',
            'vehicle_images.*' => 'nullable|image|max:2048',
        ]);

        $bill = Bill::where('jobcard_id', $id)->first();

        $validated['spare_parts'] = json_encode($validated['spare_parts'] ?? []);
        $validated['labour_charges'] = json_encode($validated['labour_charges'] ?? []);
        $validated['services_to_do'] = json_encode($validated['services'] ?? []);

        $total_amount = 0;
        if(isset($validated['spare_parts'])){
            foreach (json_decode($validated['spare_parts'], true) as $part){
                $total_amount += $part['price_per_unit'] * $part['qty'];
            }
        }
        if(isset($validated['labour_charges'])){
            foreach (json_decode($validated['labour_charges'], true) as $labour){
                $total_amount += $labour['charge'];
            }
        }
        if(isset($validated['additional_labour_charge'])){
            $total_amount += $validated['additional_labour_charge'];
        }
        if(isset($validated['services_to_do'])){
            foreach (json_decode($validated['services_to_do'], true) as $service){
                $total_amount += $service['price'];
            }
        }
        $validated['total_amount'] = $total_amount;
        $images = [];
        if($request->hasFile('vehicle_images')){
            foreach ($request->file('vehicle_images') as $image){
                $imageName = time().'_'.$image->getClientOriginalExtension();
                $image->move(public_path('bills/vehicles') , $imageName);
                $images[] = $imageName;
            }
        }
        $validated['vehicle_images'] = json_encode($images);
        $bill->update($validated);

        return response()->json(['message' => 'Bill updated successfully', 'url' => route('jobcards.show', $bill->jobcard_id)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
