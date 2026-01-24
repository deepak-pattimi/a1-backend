<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Yajra\DataTables\Facades\DataTables;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $appointments = Appointment::select('*');
            
            // Apply filters if present
            if (!empty($request->fullname)) {
                $appointments->where('fullname', 'like', '%' . $request->fullname . '%');
            }
            
            if (!empty($request->email)) {
                $appointments->where('email', 'like', '%' . $request->email . '%');
            }
            
            if (!empty($request->mobile)) {
                $appointments->where('mobile', 'like', '%' . $request->mobile . '%');
            }
            
            if (!empty($request->status)) {
                $appointments->where('status', $request->status);
            }
            
            if (!empty($request->payment_status)) {
                $appointments->where('payment_status', $request->payment_status);
            }
            
            return DataTables::of($appointments)
                ->addColumn('appointment_details', function($appointment) {
                    return $appointment->selected_date->format('d M Y') . ' at ' . $appointment->selected_time;
                })
                ->addColumn('status_badge', function($appointment) {
                    $badgeClass = '';
                    switch($appointment->status) {
                        case 'confirmed':
                            $badgeClass = 'badge badge-success';
                            break;
                        case 'cancelled':
                            $badgeClass = 'badge badge-danger';
                            break;
                        default:
                            $badgeClass = 'badge badge-warning';
                            break;
                    }
                    return '<span class="' . $badgeClass . '">' . ucfirst($appointment->status) . '</span>';
                })
                ->addColumn('payment_status_badge', function($appointment) {
                    $badgeClass = '';
                    switch($appointment->payment_status) {
                        case 'completed':
                            $badgeClass = 'badge badge-success';
                            break;
                        case 'failed':
                            $badgeClass = 'badge badge-danger';
                            break;
                        case 'unpaid':
                            $badgeClass = 'badge badge-info';
                            break;
                        default:
                            $badgeClass = 'badge badge-warning';
                            break;
                    }
                    return '<span class="' . $badgeClass . '">' . ucfirst($appointment->payment_status) . '</span>';
                })
                ->addColumn('actions', function($appointment) {
                    $actions = '<div class="action-buttons">';
                    
                    $actions .= '<a href="' . route('appointments.show', $appointment->id) . '" class="btn btn-sm btn-info mr-1">View</a>';
                    $actions .= '<button class="btn btn-sm btn-warning mr-1 update-status-btn" data-id="' . $appointment->id . '" data-status="' . $appointment->status . '">Update Status</button>';
                    $actions .= '<button class="btn btn-sm btn-primary update-payment-status-btn" data-id="' . $appointment->id . '" data-payment-status="' . $appointment->payment_status . '">Update Payment</button>';
                    
                    $actions .= '</div>';
                    
                    return $actions;
                })
                ->rawColumns(['status_badge', 'payment_status_badge', 'actions'])
                ->make(true);
        }
        
        return view('pages.appointments.index');
    }

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('pages.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();

        return response()->json(['message' => 'Appointment status updated successfully!']);
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->payment_status = $request->payment_status;
        $appointment->save();

        return response()->json(['message' => 'Payment status updated successfully!']);
    }
}