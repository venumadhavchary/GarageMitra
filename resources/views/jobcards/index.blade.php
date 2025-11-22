@extends('layouts.index')

@section('content')
    <div class="wrapper">
        <section class="form login">
            <h1>Job Cards</h1>
            <table>
                <thead>
                    <tr>
                        <th>Job Card ID</th>
                        <th>Customer Name</th>
                        <th>Vehicle Number</th>
                        <th>Job Type</th>
                        <th>Status</th>
                        <th>Assigned Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobcards as $jobcard)
                        <tr>
                            <td>{{ $jobcard->id }}</td>
                            <td>{{ $jobcard->customer_name }}</td>
                            <td>{{ $jobcard->vehicle_number }}</td>
                            <td>{{ $jobcard->job_type }}</td>
                            <td>{{ $jobcard->status }}</td>
                            <td>{{ $jobcard->assigned_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
        </section>
    </div>

    <script>
        // Create a global variable that your external JS can read
        const appRoutes = {
            sendOtp: "{{ route('auth.send_otp') }}",
            resendOtp: "{{ route('auth.resend_otp') }}",
            login: "{{ route('auth.login') }}"
        };
    </script>
@endsection
