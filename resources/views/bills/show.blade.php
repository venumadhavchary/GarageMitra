@extends('layouts.index')

@section('content')
    <div class="container" style="padding: 2rem 1rem;">
        <div class="d-flex justify-content-center align-items-center mb-6 flex-wrap gap-3">
            <div class="card">
                <form id="bill_form" action="{{ route('bills.update', $job->id) }}"
                   method="POST" enctype="multipart/form-data">
                    <div class="card-header">
                        <h1 class="mb-1">{{ $job->vehicle_number }}</h1>
                    </div>
                    <div class="card-body">
                        @csrf 
                        @method('PUT')
                        <div class="alert alert-danger" style="display: none;" id="error_text"></div>
                        <div class="alert alert-success" style="display: none;" id="success_text"></div>
                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                        <h5>Spare Parts Expected</h5>
                        <table class="table mb-0" id="spare_parts_table">
                            <thead>
                                <tr>
                                    <th style="padding-left: 1.5rem;">ID</th>
                                    <th>Name (Qty)</th>
                                    <th>Price per Unit</th>
                                    <th>Price</th>
                                    <th> <a class="btn" onclick="openModal('add_spare_part')">➕</a></th>
                                </tr>
                            </thead>
                            <tbody id="bill_table_body">
                                @if ($bill->spare_parts)
                                    @foreach ($bill->spare_parts as $spare)
                                        <tr data-index="{{ $spare->id }}">
                                            <td style="padding-left: 1.5rem;">
                                                <strong>{{ $spare->id }}</strong>
                                                <input hidden name="spare_parts[{{ $spare->id }}][id]"
                                                    value="{{ $spare->id }}">
                                            </td>
                                            <td>
                                                <strong>{{ $spare->name }} ({{ $spare->qty }})</strong>
                                                <input hidden name="spare_parts[{{ $spare->id }}][name]"
                                                    value="{{ $spare->name }}">
                                                <input hidden name="spare_parts[{{ $spare->id }}][qty]"
                                                    value="{{ $spare->qty }}">
                                            </td>
                                            <td>
                                                {{ $spare->price_per_unit }}
                                                <input hidden name="spare_parts[{{ $spare->id }}][price_per_unit]"
                                                    value="{{ $spare->price_per_unit }}">
                                            </td>
                                            <td>{{ $spare->total_price }}
                                                <input hidden name="spare_parts[{{ $spare->id }}][total_price]"
                                                    value="{{ $spare->total_price }}">
                                            </td>
                                            <td> <a class="btn btn-danger btn-sm" onclick="removeSpareRow(this)">🗑️</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <div class="card-body">
                        <h5>Labour Charge</h5>
                        <table class="table mb-0" id="labour_charge_table">
                            <thead>
                                <tr>
                                    <th style="padding-left: 1.5rem;">ID</th>
                                    <th>Name </th>
                                    <th>Labour Charges</th>
                                </tr>
                            </thead>
                            <tbody id="labour_charge_table_body">
                                @if ($bill->labour_charges)
                                    @foreach ($bill->labour_charges as $labour)
                                        <tr data-index="{{ $labour->id }}" data-spare-index="{{ $labour->spare_id }}">
                                            <td style="padding-left: 1.5rem;">
                                                <strong>{{ $labour->id }}</strong>
                                                <input hidden name="labour_charges[{{ $labour->id }}][id]"
                                                    value="{{ $labour->id }}">
                                                <input hidden name="labour_charges[{{ $labour->id }}][spare_id]"
                                                    value="{{ $labour->spare_id }}">
                                            </td>
                                            <td>
                                                <strong>{{ $labour->name }}</strong>
                                                <input hidden name="labour_charges[{{ $labour->id }}][name]"
                                                    value="{{ $labour->name }}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm"
                                                    name="labour_charges[{{ $labour->id }}][charge]"
                                                    value="{{ $labour->charge }}" min="0" step="100"
                                                    oninput="this.value = this.value.replace(/^0+/, '') || '0'; calculateTotal()">
                                            </td>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <div class="card-body">
                        <h5>Services to do</h5>
                        <table class="table mb-0" id="services_table">
                            <thead>
                                <tr>
                                    <th style="padding-left: 1.5rem;">ID</th>
                                    <th>Name </th>
                                    <th>Price</th>
                                    <th> <a class="btn" onclick="openModal('add_service')">➕</a></th>
                                </tr>
                            </thead>
                            <tbody id="services_table_body">
                                @if ($bill->services_to_do)
                                    @foreach ($bill->services_to_do as $service)
                                        <tr data-index="{{ $service->id }}">
                                            <td style="padding-left: 1.5rem;">
                                                <strong>{{ $service->id }}</strong>
                                                <input hidden name="services[{{ $service->id }}][id]"
                                                    value="{{ $service->id }}">
                                            </td>
                                            <td>
                                                <strong>{{ $service->name }}</strong>
                                                <input hidden name="services[{{ $service->id }}][name]"
                                                    value="{{ $service->name }}">
                                            </td>
                                            <td>{{ $service->price }}
                                                <input hidden name="services[{{ $service->id }}][price]"
                                                    value="{{ $service->price }}">
                                            </td>
                                            <td> <a class="btn btn-danger btn-sm" onclick="removeService(this)">🗑️</a></td>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="additional_labour_charge" class="form-label">Additional Labour Charges</label>
                            <input type="number" class="form-control" name="additional_labour_charge"
                                id="additional_labour_charge" placeholder="0">
                        </div>
                        <div class="form-group">
                            <label for="estimated_cost" class="form-label">Estimated Cost</label>
                            <input type="number" class="form-control" name="estimated_cost" id="estimated_cost"
                                value="{{ $bill->total_amount }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="estimated_delivery" class="form-label">Estimate Delivery</label>
                            <input type="date" class="form-control" name="estimated_delivery" id="estimated_delivery"
                                value="{{ $bill->estimated_delivery }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Upload Vehicle Images</label>
                            <div class="image-upload-wrapper" id="imageUploadWrapper">
                                <!-- Plus Button -->
                                <div class="image-upload-box" id="imageUploadBox">
                                    <input type="file" id="multiImageInput" name="vehicle_images[]" multiple
                                        accept="image/*">
                                    <span class="plus-icon">+</span>
                                    {{-- <span>Add Image</span> --}}
                                </div>
                                <!-- Images will be inserted here dynamically -->
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" id="update_bill">Update Bill</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        appRoutes = {
            updateBill: "{{ route('bills.update', $job->id) }}",
        }
    </script>

    @include('bills.create')


    @vite(['resources/js/api.js', 'resources/js/jobcards.js', 'resources/js/bill.js'])
@endsection
