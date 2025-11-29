@extends('layouts.index')

@section('content')
    <div class="container" style="padding: 2rem 1rem;">
        <div class="d-flex justify-content-center align-items-center mb-6 flex-wrap gap-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-1">{{ $job->vehicle_number }}</h1>
                </div>
                <div class="card-body">
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

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>


    @include('bills.create')

    @vite(['resources/js/api.js', 'resources/js/bill.js'])
@endsection
