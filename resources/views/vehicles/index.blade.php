@extends('layouts.index')

@section('content')
    <div class="container" style="padding: 2rem 1rem;">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-6 flex-wrap gap-3">
            <div>
                <h1 class="mb-1">Vehicles</h1>
                <p class="text-muted mb-0">Manage all vehicles</p>
            </div>
            <button class="btn btn-primary" onclick="openModal('add_vehicle')">
                ➕ Add Vehicle
            </button>
        </div>

        <!-- Vehicles Table -->
        <div class="card">
            <div class="card-body p-0" style="overflow-x: auto;">
                <table class="table mb-0" id="vehiclesTable">
                    <thead>
                        <tr>
                            <th style="padding-left: 1.5rem;">Vehicle Image</th>
                            <th>Vehicle Number</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Fuel Type</th>
                            <th>Owner</th>
                            <th style="text-align: right; padding-right: 1.5rem;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vehicles ?? [] as $vehicle)
                            <tr>
                                <td style="padding-left: 1.5rem;">
                                    @if($vehicle->vehicle_image)
                                        <img src="{{ asset('storage/vehicles/' . $vehicle->vehicle_image) }}" 
                                             alt="Vehicle" 
                                             style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;">
                                    @else
                                        <div style="width: 60px; height: 45px; background: var(--gray-100); border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                            🚗
                                        </div>
                                    @endif
                                </td>
                                <td><strong>{{ $vehicle->vehicle_number }}</strong></td>
                                <td>{{ $vehicle->make }}</td>
                                <td>{{ $vehicle->model }}</td>
                                <td>{{ $vehicle->fuel_type }}</td>
                                <td>{{ $vehicle->owner_name }}</td>
                                <td style="text-align: right; padding-right: 1.5rem;">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-ghost btn-sm edit-vehicle-btn" 
                                                data-vehicle="{{ json_encode($vehicle) }}"
                                                data-vehicle_image="{{ asset('storage/vehicles/' . $vehicle->vehicle_image) }}">
                                            ✏️ Edit
                                        </button>
                                        <a class="btn btn-primary btn-sm" href="{{ route('vehicles.show', $vehicle->id) }}">
                                            👁️ View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="7" class="text-center p-6">
                                    <div style="color: var(--gray-400);">
                                        <p style="font-size: 3rem; margin-bottom: 1rem;">🚗</p>
                                        <h4>No vehicles found</h4>
                                        <p class="text-muted">Add your first vehicle to get started</p>
                                        <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#add_vehicle">
                                            ➕ Add Vehicle
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if(isset($vehicles) && $vehicles->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $vehicles->links() }}
            </div>
        @endif

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
    @vite(['resources/js/api.js', 'resources/js/vehicles.js', 'resources/js/jobcards.js'])
@endsection
