@extends('layouts.index')

@section('content')
<!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-6 flex-wrap gap-3">
        <div>
            <h1 class="mb-1">Vehicle : {{ $vehicle->vehicle_number }}</h1>
        </div>
        <a class="btn btn-primary" href="{{ route('jobcards.create', ['vehicle_id' => $vehicle->id]) }}">
            ➕ Add Job Card
        </a>
    </div>
@include('jobcards.jobs_table', ['jobcards' => $vehicle->jobcards])

@endsection