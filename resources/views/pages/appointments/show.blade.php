@extends('layouts.main')

@section('title', 'Appointment Details')

@section('content')
<!-- push external head elements to head -->
@push('head')
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />
@endpush

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Appointment Details</h3>
                    <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $appointment->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Full Name:</strong></td>
                                    <td>{{ $appointment->fullname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $appointment->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mobile:</strong></td>
                                    <td>{{ $appointment->mobile }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Selected Date:</strong></td>
                                    <td>{{ $appointment->selected_date->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Selected Time:</strong></td>
                                    <td>{{ $appointment->selected_time }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong>Reason:</strong></td>
                                    <td>{{ $appointment->reason }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Message:</strong></td>
                                    <td>{{ $appointment->message ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="
                                            @if($appointment->status === 'confirmed') badge badge-success
                                            @elseif($appointment->status === 'cancelled') badge badge-danger
                                            @else badge badge-warning
                                            @endif
                                        ">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Method:</strong></td>
                                    <td>{{ ucfirst($appointment->payment_method ?? 'N/A') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Payment Status:</strong></td>
                                    <td>
                                        <span class="
                                            @if($appointment->payment_status === 'completed') badge badge-success
                                            @elseif($appointment->payment_status === 'failed') badge badge-danger
                                            @elseif($appointment->payment_status === 'unpaid') badge badge-info
                                            @else badge badge-warning
                                            @endif
                                        ">
                                            {{ ucfirst($appointment->payment_status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Amount:</strong></td>
                                    <td>€{{ number_format($appointment->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Transaction ID:</strong></td>
                                    <td>{{ $appointment->transaction_id ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h4>Update Status</h4>
                            <form id="status-update-form" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="payment_status">Payment Status</label>
                                            <select name="payment_status" id="payment_status" class="form-control">
                                                <option value="pending" {{ $appointment->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="completed" {{ $appointment->payment_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="failed" {{ $appointment->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                                                <option value="unpaid" {{ $appointment->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label><br>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Ensure the CSRF token is set for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#status-update-form').on('submit', function(e) {
        e.preventDefault();  // This is crucial to prevent the default form submission
        
        var formData = {
            status: $('#status').val(),
            payment_status: $('#payment_status').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        
        // Disable submit button to prevent multiple submissions
        $('button[type="submit"]').prop('disabled', true).text('Updating...');
        
        $.ajax({
            url: '{{ route('appointments.update-status', $appointment->id) }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                toastr.success(response.message);
                // Reload the page after a short delay to show updated values
                setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
                toastr.error('Error updating appointment status');
                
                // Re-enable the button
                $('button[type="submit"]').prop('disabled', false).text('Update');
            }
        });
    });
});
</script>
@endpush