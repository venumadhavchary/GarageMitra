@extends('layouts.index')


@section('content')
    <div class="container" style="padding: 2rem 1rem;">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-6 flex-wrap gap-3">
            <div>
                <h1 class="mb-1">Mechanics</h1>
                <p class="text-muted mb-0">Manage all Mechanics</p>
            </div>
            <button class="btn btn-primary" onclick="openModal('add_mechanic')">
                ➕ Add Mechanic
            </button>
        </div>
        <!-- Mechanics Table -->
        <div class="card">
            <div class="card-body p-0" style="overflow-x: auto;">
                <table class="table mb-0" id="vehiclesTable">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Specialization</th>
                            <th>Phone</th>
                            <th style="text-align: right; padding-right: 1.5rem;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mechanics ?? [] as $mechanic)
                            <tr>
                                <td>{{ $mechanic->id }}</td>
                                <td>{{ $mechanic->name }}</td>
                                <td>{{ $mechanic->specialization ?? '-' }}</td>
                                <td>{{ $mechanic->phone ?? '-' }}</td>
                                <td style="text-align: right; padding-right: 1.5rem;">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn btn-ghost btn-sm edit-mechanic-btn"
                                            data-mechanic="{{ json_encode($mechanic) }}">
                                            ✏️ Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="7" class="text-center p-6">
                                    <div style="color: var(--gray-400);">
                                        <p style="font-size: 3rem; margin-bottom: 1rem;">🧑‍🔧</p>
                                        <h4>No mechanics found</h4>
                                        <p class="text-muted">Add your first Mechanic to get started</p>
                                        <button class="btn btn-primary mt-3" onclick="openModal('add_mechanic')">
                                            ➕ Add Mechanic
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
        @if (isset($vehicles) && $vehicles->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $vehicles->links() }}
            </div>
        @endif

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
    @vite(['resources/js/api.js', 'resources/js/mechanics.js'])
@endsection
