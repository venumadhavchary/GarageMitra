@extends('layouts.index')

@section('content')
<div class="container" style="padding: 2rem 1rem;">
    
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-6 flex-wrap gap-3">
        <div>
            <h1 class="mb-1">Job Cards</h1>
            <p class="text-muted mb-0">Manage all vehicle service jobs</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('add_vehicle')">
                ➕ Add Vehicle
            </button>
    </div>

    <!-- Status Filter Tabs -->
    <div class="d-flex flex-wrap gap-2 mb-4">
        <button class="btn btn-primary status-filter active" data-status="all">
            📋 All Jobs
            <span class="badge" style="background: rgba(255,255,255,0.2); color: white; margin-left: 8px;">
                {{ $jobcards->count() ?? 0 }}
            </span>
        </button>
        <button class="btn btn-outline-secondary status-filter" data-status="pending">
            🕐 Pending
            <span class="badge badge-warning" style="margin-left: 8px;">
                {{ $jobcards->where('status', 'pending')->count() ?? 0 }}
            </span>
        </button>
        <button class="btn btn-outline-secondary status-filter" data-status="in_progress">
            🔧 In Progress
            <span class="badge badge-info" style="margin-left: 8px;">
                {{ $jobcards->where('status', 'in_progress')->count() ?? 0 }}
            </span>
        </button>
        <button class="btn btn-outline-secondary status-filter" data-status="completed">
            ✅ Completed
            <span class="badge badge-success" style="margin-left: 8px;">
                {{ $jobcards->where('status', 'completed')->count() ?? 0 }}
            </span>
        </button>
    </div>

    <!-- Search Bar -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="d-flex flex-wrap gap-3">
                <div class="input-group" style="flex: 1; min-width: 250px;">
                    <span class="input-group-text">🔍</span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search by vehicle, customer, or job ID...">
                </div>
                <select class="form-control" style="width: auto; min-width: 150px;" id="mechanicFilter">
                    <option value="">All Mechanics</option>
                    @foreach($mechanics ?? [] as $mechanic)
                        <option value="{{ $mechanic->id }}">{{ $mechanic->name }}</option>
                    @endforeach
                </select>
                <input type="date" class="form-control" style="width: auto;" id="dateFilter">
            </div>
        </div>
    </div>

     @include('jobcards.jobs_table')

 
@include('vehicles.create')
 
<script>
        // Create a global variable that your external JS can read
        const appRoutes = {
            addVehicle: "{{ route('vehicles.store') }}",
            updateVehicle: "{{ route('vehicles.update', ['vehicle' => 'VEHICLE_ID']) }}",
        };
    </script>

@vite(['resources/js/api.js', 'resources/js/jobcards.js' , 'resources/js/vehicles.js'])

<script>
// Status Filter
document.querySelectorAll('.status-filter').forEach(btn => {
    btn.addEventListener('click', function() {
        // Update active button
        document.querySelectorAll('.status-filter').forEach(b => {
            b.classList.remove('btn-primary', 'active');
            b.classList.add('btn-outline-secondary');
        });
        this.classList.remove('btn-outline-secondary');
        this.classList.add('btn-primary', 'active');
        
        // Filter table
        const status = this.dataset.status;
        document.querySelectorAll('#jobsTable tbody tr').forEach(row => {
            if (row.id === 'emptyRow') return;
            if (status === 'all' || row.dataset.status === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

// Search Filter
document.getElementById('searchInput').addEventListener('input', function() {
    const search = this.value.toLowerCase();
    document.querySelectorAll('#jobsTable tbody tr').forEach(row => {
        if (row.id === 'emptyRow') return;
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(search) ? '' : 'none';
    });
});

// Edit Job Modal - populate fields
$('#editJobModal').on('show.bs.modal', function(event) {
    const button = $(event.relatedTarget);
    const modal = $(this);
    
    document.getElementById('edit_job_id').value = button.data('id');
    document.getElementById('edit_status').value = button.data('status') || 'pending';
    document.getElementById('edit_customer_name').value = button.data('customer') || '';
    document.getElementById('edit_vehicle_number').value = button.data('vehicle') || '';
    document.getElementById('edit_job_type').value = button.data('jobtype') || 'service';
    
    // Hide messages
    document.getElementById('edit_error_text').style.display = 'none';
    document.getElementById('edit_success_text').style.display = 'none';
});

// Add Vehicle Form Submit
document.getElementById('addVehicleForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    const errorEl = document.getElementById('add_error_text');
    const successEl = document.getElementById('add_success_text');
    const submitBtn = document.getElementById('addVehicleBtn');
    
    // Reset messages
    errorEl.style.display = 'none';
    successEl.style.display = 'none';
    submitBtn.disabled = true;
    submitBtn.textContent = 'Creating...';
    
    try {
        const response = await fetch(appRoutes.storeJobcard, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (response.ok) {
            successEl.textContent = data.message || 'Job card created successfully!';
            successEl.style.display = 'block';
            form.reset();
            setTimeout(() => window.location.reload(), 1500);
        } else {
            if (data.errors) {
                const firstError = Object.values(data.errors)[0];
                errorEl.textContent = Array.isArray(firstError) ? firstError[0] : firstError;
            } else {
                errorEl.textContent = data.message || 'Failed to create job card';
            }
            errorEl.style.display = 'block';
        }
    } catch (error) {
        errorEl.textContent = 'An error occurred. Please try again.';
        errorEl.style.display = 'block';
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Create Job Card';
    }
});

// Edit Job Form Submit
document.getElementById('editJobForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const formData = new FormData(form);
    const jobId = document.getElementById('edit_job_id').value;
    const errorEl = document.getElementById('edit_error_text');
    const successEl = document.getElementById('edit_success_text');
    const submitBtn = document.getElementById('editJobBtn');
    
    formData.append('_method', 'PUT');
    
    errorEl.style.display = 'none';
    successEl.style.display = 'none';
    submitBtn.disabled = true;
    submitBtn.textContent = 'Updating...';
    
    try {
        const response = await fetch(`/jobcards/${jobId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (response.ok) {
            successEl.textContent = data.message || 'Job card updated successfully!';
            successEl.style.display = 'block';
            setTimeout(() => window.location.reload(), 1500);
        } else {
            if (data.errors) {
                const firstError = Object.values(data.errors)[0];
                errorEl.textContent = Array.isArray(firstError) ? firstError[0] : firstError;
            } else {
                errorEl.textContent = data.message || 'Failed to update job card';
            }
            errorEl.style.display = 'block';
        }
    } catch (error) {
        errorEl.textContent = 'An error occurred. Please try again.';
        errorEl.style.display = 'block';
    } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Update Job Card';
    }
});



// Delete Job
function deleteJob(id) {
    if (confirm('Are you sure you want to delete this job card?')) {
        fetch(`/jobcards/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success || data.message) {
                window.location.reload();
            } else {
                alert('Failed to delete job card');
            }
        })
        .catch(() => alert('An error occurred'));
    }
}
</script>
@endsection
