<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Invoice</h3>
            <span class="fw-bold">#{{ $bill->id ?? 'INV-XXXX' }}</span>
        </div>
        <div class="card-body">

            <div class="row mb-4" style="flex: 1; min-width: 200px; display:none;">
                <div class="col-md-6">
                    <h5 class="fw-bold">Jobcard</h5>
                    <p class="mb-1"><strong>Bill No:</strong> {{ $bill->id ?? '-' }}</p>
                    <p class="mb-1"><strong>Date:</strong> {{ $bill->date ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold">Work Performed by</h5>
                    <p class="mb-1"><strong>Mechanic:</strong> {{ $job->mechanic_name ?? '-' }}</p>
                    <p class="mb-1"><strong>Sub mechanic:</strong> {{ $job->mechanic_name ?? '-' }}</p>
                </div>
            </div>
            <div class="row mb-4" style="flex: 1; min-width: 200px; display:none;">
                <div class="col-md-6">
                    <h5 class="fw-bold">Customer Info</h5>
                    <p class="mb-1"> {{ $vehicle->owner_name ?? '-' }}</p>
                    <p class="mb-1"> {{ $bill->owner_contact ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold">Vehicle Info</h5>
                    <p class="mb-1"> {{ $vehicle->vehicle_number ?? '-' }}</p>
                    <p class="mb-1"> {{ $vehicle->make ?? '-' }}</p>
                    <p class="mb-1"> {{ $vehicle->model ?? '-' }}</p>
                    <p class="mb-1"> Km: {{ $job->odometer_reading ?? '-' }}</p>
                    <p class="mb-1"> Fuel :- {{ $job->fuel_level ?? '-' }}</p>
                    <p class="mb-1"> Estimated Date :- {{ $job->estimated_delivery ?? '-' }}</p>
                </div>
            </div>
            <h5 class="fw-bold mt-4">Spare Parts</h5>
            <table class="table table-bordered mb-4">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bill->spare_parts as $part)
                        <tr>
                            <td>{{ $part->name }}</td>
                            <td>{{ $part->qty }}</td>
                            <td>{{ number_format($part->price_per_unit, 2) }}</td>
                            <td>{{ number_format($part->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h5 class="fw-bold mt-4">Labour & Services</h5>
            <table class="table table-bordered mb-4">
                <thead class="table-light">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Charge</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bill->labour_charges as $labour)
                        <tr>
                            <td>{{ $labour->id }}</td>
                            <td>{{ $labour->name }}</td>
                            <td>{{ number_format($labour->price ?? $labour->charge, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row justify-content-end">
                <div class="col-md-4">
                    <table class="table table-borderless">
                        <tr>
                            <th>Subtotal:</th>
                            <td>{{ number_format($bill->total_amount ?? 0, 2) }}</td>
                        </tr>
                        @if ($job->status == 'completed')
                            <tr>
                                <th>Discount :</th>
                                <td id="total_discount">
                                    {{ number_format($bill->discount ?? 0, 2) }}
                                </td>
                            </tr>
                        @endif
                        <tr class="fw-bold">
                            <th>
                                Balance:</th>
                            <td id="total_amount">
                                {{ number_format($bill->balance_amount ?? 0, 2) }}
                            </td>
                        </tr>
                        <tr class="fw-bold">
                            <th>
                                Paid Amount:</th>
                            <td id="total_paid_amount">{{ number_format($bill->paid_amount ?? 0, 2) }}
                            </td>
                        </tr>
                        <form id="discount_form">
                            <div class="form-group d-flex">
                                <label for="discount_amount" class="me-2">Discount:</label>
                                <input id="discount_amount" type="number" class="form-control form-control-sm"
                                    name="discount" value="0">
                                <button class="btn btn-primary" id="update_discount">Apply</button>
                            </div>
                        </form>
                        <form id="paid_amount_form">
                            <div class="form-group d-flex">
                                <label for="paid_amount" class="me-2">Paid Amount:</label>
                                <input id="paid_amount" type="number" class="form-control form-control-sm"
                                    name="paid_amount" value="0">
                                <button class="btn btn-primary" id="update_paid_amount">Update</button>
                            </div>
                        </form>

                        <tr class="fw-bold">
                            <th colspan="100%">
                                <div class=" text-center badge bg-info text-white" id="payment_status_badge"
                                    style="display: {{ $bill->status == 'paid' ? 'block' : 'none' }};">
                                    {{ $bill->status == 'paid' ? '✅ Payment Completed!' : '❌ Payment Pending' }}
                                </div>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button class="btn btn-success" onclick="window.print()">Print Invoice</button>
        </div>
    </div>
</div>
