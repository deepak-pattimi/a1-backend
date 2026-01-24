@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Appointments</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form id="filter-form">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="fullname" placeholder="Full Name">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="mobile" placeholder="Mobile">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="status">
                                            <option value="">All Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="confirmed">Confirmed</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-control" id="payment_status">
                                            <option value="">All Payment Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="completed">Completed</option>
                                            <option value="failed">Failed</option>
                                            <option value="unpaid">Unpaid</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <button type="button" class="btn btn-secondary" id="reset-filter">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="appointments-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Date & Time</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Appointment Status Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Update Appointment Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="statusForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="appointment-id" name="id">
                    <div class="form-group">
                        <label for="status-select">Status</label>
                        <select class="form-control" id="status-select" name="status">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Payment Status Modal -->
<div class="modal fade" id="paymentStatusModal" tabindex="-1" role="dialog" aria-labelledby="paymentStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentStatusModalLabel">Update Payment Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="paymentStatusForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="payment-appointment-id" name="id">
                    <div class="form-group">
                        <label for="payment-status-select">Payment Status</label>
                        <select class="form-control" id="payment-status-select" name="payment_status">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                            <option value="unpaid">Unpaid</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Payment Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#appointments-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('appointments.index') }}",
            data: function(d) {
                d.fullname = $('#fullname').val();
                d.email = $('#email').val();
                d.mobile = $('#mobile').val();
                d.status = $('#status').val();
                d.payment_status = $('#payment_status').val();
            }
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'fullname', name: 'fullname' },
            { data: 'email', name: 'email' },
            { data: 'mobile', name: 'mobile' },
            { 
                data: 'appointment_details', 
                name: 'selected_date',
                orderable: true,
                searchable: false
            },
            { data: 'reason', name: 'reason' },
            { 
                data: 'status_badge', 
                name: 'status',
                orderable: true,
                searchable: false
            },
            { 
                data: 'payment_status_badge', 
                name: 'payment_status',
                orderable: true,
                searchable: false
            },
            { 
                data: 'amount', 
                name: 'amount',
                render: function(data, type, row) {
                    return '€' + parseFloat(data).toFixed(2);
                }
            },
            { 
                data: 'actions', 
                name: 'actions',
                orderable: false,
                searchable: false
            }
        ]
    });

    // Filter form submission
    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        table.draw();
    });

    // Reset filter
    $('#reset-filter').on('click', function() {
        $('#filter-form')[0].reset();
        table.draw();
    });

    // Update status modal
    $(document).on('click', '.update-status-btn', function() {
        var appointmentId = $(this).data('id');
        var currentStatus = $(this).data('status');
        
        $('#appointment-id').val(appointmentId);
        $('#status-select').val(currentStatus);
        $('#statusModal').modal('show');
    });

    // Update payment status modal
    $(document).on('click', '.update-payment-status-btn', function() {
        var appointmentId = $(this).data('id');
        var currentPaymentStatus = $(this).data('payment-status');
        
        $('#payment-appointment-id').val(appointmentId);
        $('#payment-status-select').val(currentPaymentStatus);
        $('#paymentStatusModal').modal('show');
    });

    // Submit status form
    $('#statusForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = {
            status: $('#status-select').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        
        $.ajax({
            url: '{{ url("admin/appointments") }}/' + $('#appointment-id').val() + '/update-status',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#statusModal').modal('hide');
                table.ajax.reload();
                toastr.success(response.message);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                toastr.error('Error updating status');
            }
        });
    });

    // Submit payment status form
    $('#paymentStatusForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = {
            payment_status: $('#payment-status-select').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        
        $.ajax({
            url: '{{ url("admin/appointments") }}/' + $('#payment-appointment-id').val() + '/update-payment-status',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#paymentStatusModal').modal('hide');
                table.ajax.reload();
                toastr.success(response.message);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                toastr.error('Error updating payment status');
            }
        });
    });
});
</script>
@endpush