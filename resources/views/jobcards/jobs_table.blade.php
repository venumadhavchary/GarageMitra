<!-- Jobs Table -->
    <div class="card">
        <div class="card-body p-0" style="overflow-x: auto;">
            <table class="table mb-0" id="jobsTable">
                <thead>
                    <tr>
                        <th style="padding-left: 1.5rem;">Job ID</th>
                        <th>Vehicle Number</th>
                        <th>Customer</th>
                        <th>Job Type</th>
                        <th>Status</th>
                        <th>Assigned Date</th>
                        <th style="text-align: right; padding-right: 1.5rem;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobcards ?? [] as $job)
                    <tr data-status="{{ $job->status }}">
                        <td style="padding-left: 1.5rem;">
                            <strong>#{{ str_pad($job->id, 4, '0', STR_PAD_LEFT) }}</strong>
                        </td>
                        <td>
                            <strong>{{ $job->vehicle_number ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            {{ $job->customer_name ?? 'N/A' }}
                        </td>
                        <td>{{ $job->job_type ?? 'N/A' }}</td>
                        <td>
                            @switch($job->status)
                                @case('pending')
                                    <span class="badge badge-warning">🕐 Pending</span>
                                    @break
                                @case('in_progress')
                                    <span class="badge badge-info">🔧 In Progress</span>
                                    @break
                                @case('completed')
                                    <span class="badge badge-success">✅ Completed</span>
                                    @break
                                @default
                                    <span class="badge badge-secondary">{{ $job->status }}</span>
                            @endswitch
                        </td>
                        <td>
                            <small>{{ $job->assigned_date ?? 'N/A' }}</small>
                        </td>
                        <td style="text-align: right; padding-right: 1.5rem;">
                            <div class="d-flex gap-1 justify-content-end">
                                <a href="{{ route('jobcards.show', $job->id) }}" class="btn btn-ghost btn-sm btn-icon" title="View Details">
                                    👁️
                                </a>
                                <button class="btn btn-ghost btn-sm btn-icon" title="Edit"
                                        data-toggle="modal" data-target="#editJobModal"
                                        data-id="{{ $job->id }}"
                                        data-status="{{ $job->status }}"
                                        data-customer="{{ $job->customer_name }}"
                                        data-vehicle="{{ $job->vehicle_number }}"
                                        data-jobtype="{{ $job->job_type }}">
                                    ✏️
                                </button>
                                <button class="btn btn-ghost btn-sm btn-icon text-danger" title="Delete"
                                        onclick="deleteJob({{ $job->id }})">
                                    🗑️
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyRow">
                        <td colspan="7" class="text-center p-6">
                            <div style="color: var(--gray-400);">
                                <p style="font-size: 3rem; margin-bottom: 1rem;">📋</p>
                                <h4>No job cards found</h4>
                                <p class="text-muted">Add a vehicle to create your first job card</p>
                                <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#addVehicleModal">
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
