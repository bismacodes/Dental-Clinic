<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function createVisit($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        return view('patients.visit', compact('patient'));
    }

    public function storeVisit(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visited_at' => 'required|date',
            'complaint' => 'required|string',
            'treatment_plan' => 'nullable|string',
            'investigation' => 'nullable|string',
            'medication' => 'nullable|string',
            'review' => 'nullable|string',
        ]);


        Visit::create($validated);

        return redirect()->route('patients.index')
            ->with('success', 'Visit recorded successfully.');
    }
}
