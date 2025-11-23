<?php

namespace App\Http\Controllers;

use App\Models\Jobcards;
use Illuminate\Http\Request;


class JobcardsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobcards = Jobcards::all();
        return view('jobcards.index', compact('jobcards'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Jobcards $jobcards)
    {
        //
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
    public function update(Request $request, Jobcards $jobcards)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jobcards $jobcards)
    {
        //
    }
}
