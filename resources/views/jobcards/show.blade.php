@extends('layouts.index')

@section('content')
    <div class="container" style="padding: 2rem 1rem;">

        <!-- Page Header -->
        <div class="d-flex justify-content-center align-items-center mb-6 flex-wrap gap-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-1">{{ $job->vehicle_number }}</h1>
                    <button class="btn btn-primary" onclick="openModal('edit_jobcard', {{ $job }})">
                        Edit
                    </button>
                </div>
                <div class="card-body">

                    <div class="imgae-slider">
                        @if ($job->vehicle_images)
                            @foreach ($job->vehicle_images as $image)
                                <img src="{{ asset('storage/jobcards/' . $imagae) }}" alt="vehicle images">
                            @endforeach
                        @endif
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-primary btn-block">Date of job</button>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-outline-secodary btn-block">{{ $job->assigned_date }}</button>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-primary btn-block">Issues</button>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-outline-secodary btn-block">
                                {{ $job->services }}
                            </button>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-primary btn-block">Paid Amount(Advance)</button>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-outline-secodary btn-block">{{ $job->paid_amount }}</button>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-primary btn-block">Kilometer Reading</button>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-outline-secodary btn-block">{{ $job->odometer_reading }}</button>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-primary btn-block">Fuel Indicator</button>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-outline-secodary btn-block">{{ $job->fuel_level }}</button>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-primary btn-block">Vehicle Recieved From</button>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-outline-secodary btn-block">{{ $job->vehicle_received_from }}</button>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-primary btn-block">Vehicle Collected By</button>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <button class="btn btn-outline-secodary btn-block">{{ $job->vehicle_returned_to }}</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block">Remarks</button>
                        <p class="mt-2"> {{ $job->remarks }}</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-1">Dent and Scratch</h1>
                    <button class="btn btn-primary" onclick="openModal('view_jobcard_images')">
                        View Images
                    </button>
                </div>
                <div class="card-body">
                    @if (!$bill)
                        <a href="{{ route('bills.generate', $job->id) }}" class="btn btn-primary">
                            Create Bill
                        </a>
                    @else
                        <a href="{{ route('bills.show', $job->id) }}" class="btn btn-primary">
                            View Bill
                        </a>
                    @endif
                     @if ($bill) 
                        <button class="btn btn-primary" onclick="openModal('complete_jobcard', {{ $job }})">
                            Mark Completed
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        appRoutes = {
            updateJobcard: "{{ route('jobcards.update', 'ID') }}",
        }
    </script>

    @include('jobcards.edit')
    @include('jobcards.mark_complete')

    @vite(['resources/js/api.js', 'resources/js/jobcards.js'])
@endsection
