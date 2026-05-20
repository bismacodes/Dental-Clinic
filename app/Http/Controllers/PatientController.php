<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'surname'           => 'required|string|max:100',
            'firstname'         => 'required|string|max:100',
            'othername'         => 'nullable|string|max:100',
            'gender'            => 'required|in:male,female,other',
            'date_of_birth'     => 'required|date|before:today',
            'phone_no'          => 'required|string|max:20',
            'relative_phone_no' => 'required|string|max:20',
            'address'           => 'required|string',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.index')
            ->with('success', 'Patient registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'surname'           => 'required|string|max:100',
            'firstname'         => 'required|string|max:100',
            'othername'         => 'nullable|string|max:100',
            'gender'            => 'required|in:male,female,other',
            'date_of_birth'     => 'required|date|before:today',
            'phone_no'          => 'required|string|max:20',
            'relative_phone_no' => 'required|string|max:20',
            'address'           => 'required|string',
        ]);

        $patient->update($validated);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Patient deleted successfully.');
    }
}
