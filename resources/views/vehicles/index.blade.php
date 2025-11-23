@extends('layouts.auth.index')


@section('content')
    <div class="wrapper">
        <section class="form login">
            <h1>Vehicles</h1>
            <button type="button" data-toggle="modal" data-target="#add_vehicle" data-whatever="">Add vehicle</button>
            <div class="vehicle-list">
                @foreach ($vehicles as $vehicle)
                    <div class="vehicle-item">
                        @if ($vehicle->vehicle_image)
                            <div class="image-container">
                                <img src="{{ asset('storage/vehicles/' . $vehicle->vehicle_image) }}"
                                    alt="{{ $vehicle->vehicle_number }}">
                            </div>
                        @endif
                        <p>Vehicle Number: {{ $vehicle->vehicle_number }}</p>
                        <p>Make: {{ $vehicle->make }}</p>
                        <p>Model: {{ $vehicle->model }}</p>
                        <p>Fuel Type: {{ $vehicle->fuel_type }}</p>
                        <button type="button" id="edit_button" data-toggle="modal" data-target="#edit_vehicle"
                            data-vehicle="{{ json_encode($vehicle) }}"
                            data-vehicle_image="{{ asset('storage/vehicles/' . $vehicle->vehicle_image) }}">
                            Edit
                        </button>
                    </div>
                @endforeach
        </section>
    </div>

    @include('vehicles.create')
    @include('vehicles.edit')
    <script>
        // Create a global variable that your external JS can read
        const appRoutes = {
            addVehicle: "{{ route('vehicles.store') }}",
            updateVehicle: "{{ route('vehicles.update', ['vehicle' => 'VEHICLE_ID']) }}",
        };
    </script>
    @vite(['resources/js/api.js', 'resources/js/vehicles.js'])
@endsection
