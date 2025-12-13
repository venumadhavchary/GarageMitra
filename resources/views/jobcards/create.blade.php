{{-- modal --}}
@extends('layouts.index')


@section('content')
    <!-- Add Vehicle Modal -->
    <section id="colors" class="docs-section">
        <h5 class="docs-section-title">➕ Add Job Card For {{ $vehicle->vehicle_number }}</h5>
        <form id="addJobForm" method="POST" action="{{ route('jobcards.store', $vehicle->id) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <!-- Success/Error Messages -->
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div id="add_error_text" class="alert alert-danger"> {{ $error }}</div>
                    @endforeach
                @endif
                    <div id="add_success_text" class="alert alert-success" style="display: none;"></div>

                    <div class="form-group">
                        <label class="form-switch">
                            <span>Old Job Card</span>
                            <input type="checkbox" id="old_job">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="assigned_date" name="assigned_date"
                            value="{{ date('Y-m-d') }}" readonly>
                    </div>
                    <!-- Services -->
                    <div class="form-group">
                        <label class="form-label required">Services</label>

                        @foreach ($services as $service)
                            <div class="form-check">
                                <input type="checkbox" id="service{{ $service->id }}" class="form-check-input"
                                    name="services[]" value="{{ $service->slug }}"
                                    {{ in_array('oil_change', old('services', [])) ? 'checked' : '' }}>
                                <label class="form-check-label"
                                    for="service{{ $service->id }}">{{ $service->name }}</label>
                            </div>
                        @endforeach

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="other_service">
                            <label class="form-check-label" for="other_service">Other</label>
                        </div>
                    </div>

                    <div class="form-group" id="other_service_input" style="display:none;">
                        <!-- note: id added and disabled initially to avoid validation errors -->
                        <input type="text" class="form-control" id="other_service_text" name="services[]" disabled
                            placeholder="Specify other service">
                    </div>
                    @error('services')
                        <span class="form-text text-danger">✗ Please specify .</span>
                    @enderror
                    <div class="form-group">
                        <label class="form-label">Remarks</label>
                        <input type="texr" class="form-control" name="remarks" placeholder="Remarks on the job card">
                    </div>

                    <!-- Vehicle Details -->
                    <h6 class="mb-3"
                        style="color: var(--gray-500); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px;">
                        Vehicle Details
                    </h6>
                    <div class="d-flex flex-wrap gap-4 mb-4">
                        <!-- Advance Pay -->
                        <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                            <label class="form-label">Advance Pay</label>
                            <input type="text" class="form-control @error('paid_amount') is-invalid @enderror"
                                name="paid_amount" value="{{ old('paid_amount') }}" 
                                placeholder="Advance payment amount">
                            @error('paid_amount')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Odometer -->
                        <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                            <label class="form-label">Odometer</label>
                            <input type="tel" class="form-control @error('odometer_reading') is-invalid @enderror"
                                name="odometer_reading" value="{{ old('odometer_reading') }}"
                                placeholder="Odometer reading">
                            @error('odometer_reading')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Fuel Range: <span
                                id="rangeValue">{{ old('fuel_level', 0) }}</span></label>
                        <input type="range" class="form-range" min="0" max="100" name="fuel_level"
                            value="{{ old('fuel_level', 0) }}"
                            oninput="document.getElementById('rangeValue').textContent = this.value">
                        @error('fuel_level')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-flex flex-wrap gap-4 mb-4">
                        <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                            <label class="form-label required">Vehicle Received From</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="vehicle_received_from"
                                    id="vehicle_received_from_owner" value="owner" checked>
                                <label class="form-check-label" for="vehicle_received_from_owner">Customer
                                    {{ $vehicle->owner_name }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="vehicle_recieved_from_other"
                                    name="vehicle_received_from" value="other">
                                <label class="form-check-label" for="vehicle_recieved_from_other">Other</label>
                            </div>
                        </div>
                        <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                            <label class="form-label required">Vehicle Collected By</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="vehicle_collected_by"
                                    id="vehicle_collected_by_owner"  value="owner" checked>
                                <label class="form-check-label" for="vehicle_collected_by_owner">Owner - {{ $user->name }}</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="vehicle_collected_by_other"
                                    name="vehicle_collected_by" value="other">
                                <label class="form-check-label" for="vehicle_collected_by_other">Submechanic</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-4 mb-4">
                        <div class="form-group mb-0" style="flex: 1; min-width: 200px; display:none;"
                            id="vehicle_recieved_from_input">
                            <input type="text" class="form-control" name="vehicle_received_from_other"
                                placeholder="Name who will receive the vehicle">
                        </div>
                        <div class="form-group mb-0" style="flex: 1; min-width: 200px; display:none;"
                            id="vehicle_collected_by_input">
                            <input type="text" class="form-control" name="vehicle_collected_by_other"
                                placeholder="Name of mechanic collected the vehicle">
                        </div>
                    </div>
                    <!-- Job Details -->
                    <h6 class="mb-3"
                        style="color: var(--gray-500); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px;">
                        Job Details
                    </h6>
                    <div class="d-flex flex-wrap gap-4 mb-4">
                        <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                            <label class="form-label">Assign Mechanic</label>
                            <select class="form-control" name="mechanic_name">
                                <option value="">Select mechanic...</option>
                                @foreach ($mechanics ?? [] as $mechanic)
                                    <option value="{{ $mechanic->name }}">{{ $mechanic->name }} -
                                        {{ $mechanic->specialization }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-0" style="flex: 1; min-width: 200px;">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Estimated Delivery</label>
                        <input type="date" class="form-control" name="estimated_completion_date"
                            value="{{ old('estimated_completion_date', date('Y-m-d')) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Vehicle Condition</label>
                        <input type="texr" class="form-control" name="vehicle_condition"
                            placeholder="Remarks on any damages">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Upload Vehicle Images</label>
                        <div class="image-upload-wrapper" id="imageUploadWrapper">
                            <!-- Plus Button -->
                            <div class="image-upload-box" id="imageUploadBox">
                                <input type="file" id="multiImageInput" name="vehicle_images[]" multiple
                                    accept="image/*">
                                <span class="plus-icon">+</span>
                            </div>
                            <!-- Images will be inserted here dynamically -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" id="addVehicleBtn">Create Job Card</button>
            </div>
        </form>
        </div>
        </div>
        </div>
        @vite(['resources/js/api.js', 'resources/js/vehicles.js', 'resources/js/jobcards.js'])
    @endsection
