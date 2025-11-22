@extends('layouts.auth.index')


@section('content')
    <div class="wrapper">
        <section class="form login">
            <h1>Mechanics</h1>
            <button type="button" data-toggle="modal" data-target="#add_mechanic" data-whatever="">Add Mechanic</button>
            <div class="mechanic-list">
                @foreach ($mechanics as $mechanic)
                    <div class="mechanic-item">
                        <h2>{{ $mechanic->name }}</h2>
                        <p>Specialization: {{ $mechanic->specialization }}</p>
                        <p>Phone: {{ $mechanic->phone }}</p>
                        <button type="button" data-toggle="modal" data-target="#update_mechanic"
                            data-id="{{ $mechanic->id }}" data-name="{{ $mechanic->name }}"
                            data-specialization="{{ $mechanic->specialization }}" data-phone="{{ $mechanic->phone }}">
                            Edit
                        </button>
                    </div>
                @endforeach
        </section>
    </div>

    @include('mechanics.create')
    @include('mechanics.edit')
    <script>
        // Create a global variable that your external JS can read
        const appRoutes = {
            addMechanic: "{{ route('mechanics.store') }}",
            updateMechanic: "{{ route('mechanics.update', ['mechanic' => 'MECHANIC_ID']) }}",
        };
    </script>
    @vite('resources/js/mechanics.js')
@endsection
