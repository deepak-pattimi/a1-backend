<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('pages.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('pages.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
        ]);

        Doctor::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully');
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('pages.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');
    }
}
