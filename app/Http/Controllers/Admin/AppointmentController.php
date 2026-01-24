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
            $data = Appointment::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('appointment_details', function($appointment) {
                    return $appointment->selected_date ? $appointment->selected_date->format('d M Y') . ' at ' . $appointment->selected_time : 'N/A';
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
                    return '<span class="' . $badgeClass . '">' . ucfirst($appointment->status ?? 'N/A') . '</span>';
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
                    return '<span class="' . $badgeClass . '">' . ucfirst($appointment->payment_status ?? 'N/A') . '</span>';
                })
                ->addColumn('action', function($appointment) {
                    $btn = '<a href="'.route('appointments.show', $appointment->id).'" data-toggle="tooltip"  data-id="' . $appointment->id . '" data-original-title="View" class="view btn btn-info btn-sm viewAppointment"><i class="fa fa-eye"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $appointment->id . '" data-status="'.$appointment->status.'" data-original-title="Edit" class="edit btn btn-warning btn-sm updateStatus"><i class="fa fa-edit"></i></a>';

                    return $btn;
                })
                ->rawColumns(['status_badge', 'payment_status_badge', 'action'])
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
        
        // Update status if provided
        if ($request->has('status')) {
            $appointment->status = $request->status;
        }
        
        // Update payment status if provided
        if ($request->has('payment_status')) {
            $appointment->payment_status = $request->payment_status;
        }
        
        $appointment->save();

        return response()->json(['message' => 'Appointment status updated successfully!']);
    }
}