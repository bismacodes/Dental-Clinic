<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard()
    {

        return view('dashboard', [

            // Patient stats
            'totalPatients'        => Patient::count(),
            'newPatientsThisMonth' => Patient::whereMonth('created_at', now()->month)->count(),
            'newPatientsToday'     => Patient::whereDate('created_at', today())->count(),
            'malePatients'         => Patient::where('gender', 'male')->count(),
            'femalePatients'       => Patient::where('gender', 'female')->count(),
            'otherPatients'        => Patient::where('gender', 'other')->count(),

            // Visit stats
            'totalVisits'               => Visit::count(),
            'todaysVisits'              => Visit::whereDate('visited_at', today())->count(),
            'visitsThisMonth'           => Visit::whereMonth('visited_at', now()->month)->count(),
            'visitsWithMedicationToday' => Visit::whereDate('visited_at', today())
                ->whereNotNull('medication')
                ->count(),

            // Lists
            'recentVisits'    => Visit::with('patient')
                ->latest('visited_at')
                ->take(6)
                ->get(),

            'recentPatients'  => Patient::latest()
                ->take(5)
                ->get(),

        ]);
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
