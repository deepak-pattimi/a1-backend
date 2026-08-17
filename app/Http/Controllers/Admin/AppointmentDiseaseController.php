<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentDiseaseController extends Controller
{
    public function index()
    {
        $diseases = \App\Models\AppointmentDisease::all();
        return view('pages.appointment_diseases.index', compact('diseases'));
    }

    public function create()
    {
        return view('pages.appointment_diseases.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        \App\Models\AppointmentDisease::create([
            'name' => $request->name,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('appointment-diseases.index')->with('success', 'Appointment Disease added successfully');
    }

    public function edit($id)
    {
        $disease = \App\Models\AppointmentDisease::findOrFail($id);
        return view('pages.appointment_diseases.edit', compact('disease'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $disease = \App\Models\AppointmentDisease::findOrFail($id);
        $disease->update([
            'name' => $request->name,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('appointment-diseases.index')->with('success', 'Appointment Disease updated successfully');
    }

    public function destroy($id)
    {
        $disease = \App\Models\AppointmentDisease::findOrFail($id);
        $disease->delete();

        return redirect()->route('appointment-diseases.index')->with('success', 'Appointment Disease deleted successfully');
    }
}
