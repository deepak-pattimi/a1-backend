@extends('layouts.main')

@section('title', 'Appointments')

@section('content')

<!-- push external head elements to head -->
@push('head')
<link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}"/>
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />
@endpush

<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-calendar bg-blue"></i>
                    <div class="d-inline">
                        <h5>Appointments</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Appointments</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-body">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Date & Time</th>
                                <th>Reason</th>
                                <th>Status</th>
                                <th>Payment Status</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Appointment View Modal -->
<div class="modal fade" id="viewAppointmentModal" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 500px !important">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mx-auto" id="viewAppointmentHeading">Appointment Details</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Full Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="view_fullname" name="fullname" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="view_email" name="email" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Mobile</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="view_mobile" name="mobile" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Date & Time</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="view_appointment_datetime" name="appointment_datetime" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Reason</label>
                        <div class="col-sm-12">
                            <textarea name="reason" readonly id="view_reason" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Status</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="view_status" name="status" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Amount</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="view_amount" name="amount" readonly />
                        </div>
                    </div>

                    <div class="container">
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Appointment Status Update Modal -->
<div class="modal fade" id="updateStatusModal" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 500px !important">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mx-auto" id="updateStatusHeading">Update Appointment Status</h4>
            </div>
            <div class="modal-body">
                <form id="statusUpdateForm" name="statusUpdateForm" class="form-horizontal">
                    <input type="hidden" name="appointment_id" id="appointment_id" />
                    <div class="form-group">
                        <label class="col-sm-6 control-label">Current Status</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="current_status" name="current_status" readonly />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">New Status</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="new_status" name="new_status">
                                <option value="pending">Pending</option>
                                <option value="confirmed">Confirmed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="container">
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="saveStatusBtn">Update Status</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        var table = $(".data-table").DataTable({
            processing: true,
            serverSide: true,
            dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
            ajax: "{{ route('appointments.index') }}",
            columns: [
                { title:'No', data: "DT_RowIndex", name: "DT_RowIndex" },
                { title:'Full Name', data: "fullname", name: "fullname" },
                { title:'Email', data: "email", name: "email" },
                { title:'Mobile', data: "mobile", name: "mobile" },
                { title:'Date & Time', data: "appointment_details", name: "appointment_details" },
                { title:'Reason', data: "reason", name: "reason" },
                { title:'Status', data: "status_badge", name: "status" },
                { title:'Payment Status', data: "payment_status_badge", name: "payment_status" },
                { 
                    title:'Amount', 
                    data: "amount", 
                    name: "amount",
                    render: function(data, type, row) {
                        return '₹' + parseFloat(data || 0).toFixed(2);
                    }
                },
                {
                    title:'Action',
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            buttons: ["pdf", "excel"],
        });

        // View appointment details
        $("body").on("click", ".viewAppointment", function () {
            var appointment_id = $(this).data("id");
            window.location.href = "{{ url('admin/appointments') }}/" + appointment_id;
        });

        // Open update status modal
        $("body").on("click", ".updateStatus", function () {
            var appointment_id = $(this).data("id");
            var current_status = $(this).data("status");
            
            $("#statusUpdateForm")[0].reset();
            $("#appointment_id").val(appointment_id);
            $("#current_status").val(current_status);
            $("#new_status").val(current_status);
            
            $("#updateStatusHeading").html("Update Appointment Status");
            $("#updateStatusModal").modal("show");
        });

        // Save updated status
        $("#saveStatusBtn").click(function(e) {
            e.preventDefault();
            
            var appointment_id = $("#appointment_id").val();
            var new_status = $("#new_status").val();
            
            $.ajax({
                type: "POST",
                url: "{{ url('admin/appointments') }}/" + appointment_id + "/update-status",
                data: {
                    status: new_status,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $("#updateStatusModal").modal("hide");
                    table.draw();
                    toastr.options.timeOut = 5000;
                    toastr.success("Appointment status updated successfully.");
                },
                error: function (data) {
                    console.log("Error:", data);
                    toastr.options.timeOut = 5000;
                    toastr.error("Error updating appointment status.");
                }
            });
        });
    });
</script>
<!-- push external js -->
<script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
<!--server side users table script-->
<script src="{{ asset('js/custom.js') }}"></script>

@endpush
@endsection