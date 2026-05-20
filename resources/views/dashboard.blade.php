@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <x-ui.page-title title="Dashboard" subtitle="Welcome to NEU Dental Clinic Portal" />

    <div class="page-content">

        {{-- Stats Row --}}
        <div class="row g-3 mb-4">
            <div class="col-sm-6 col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 py-0">
                        <div class="">
                            <i class="bi bi-people text-primary" style="font-size: 60px"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Total Patients</div>
                            <div class="fw-bold fs-5">{{ $totalPatients }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="">
                            <i class="bi bi-gender-male text-success" style="font-size: 60px"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Male</div>
                            <div class="fw-bold fs-5">{{ $malePatients }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 py-0">
                        <div>
                            <i class="bi bi-gender-female text-danger" style="font-size: 60px"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Female</div>
                            <div class="fw-bold fs-5">{{ $femalePatients }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 py-0">
                        <div>
                            <i class="bi bi-calendar-check text-warning" style="font-size: 60px"></i>
                        </div>
                        <div>
                            <div class="text-muted small">Today's Visits</div>
                            <div class="fw-bold fs-5">{{ $todaysVisits }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="row g-3">

            {{-- ===== LEFT 9 COLS ===== --}}
            <div class="col-lg-9">
                {{-- BOTTOM ROW --}}
                <div class="row align-items-start g-3">

                    {{-- Demographics --}}
                    <div class="col-12 col-xl-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">

                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div>
                                        <h6 class="fw-bold mb-0">Demographics</h6>
                                        <small class="text-muted">Patient gender breakdown</small>
                                    </div>
                                    <span class="badge bg-success text-muted border fw-normal">
                                        {{ $totalPatients }} total
                                    </span>
                                </div>

                                {{-- Male --}}
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-2 bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                                                style="width:28px;height:28px;">
                                                <i class="bi bi-gender-male text-primary" style="font-size:12px;"></i>
                                            </div>
                                            <span class="small fw-semibold">Male</span>
                                        </div>
                                        <div class="text-end">
                                            <span class="small fw-bold text-primary">{{ $malePatients }}</span>
                                            <span class="text-muted small ms-1">
                                                ({{ $totalPatients > 0 ? round(($malePatients / $totalPatients) * 100) : 0 }}%)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="progress rounded-pill" style="height:6px;">
                                        <div class="progress-bar bg-primary rounded-pill"
                                            style="width:{{ $totalPatients > 0 ? round(($malePatients / $totalPatients) * 100) : 0 }}%;">
                                        </div>
                                    </div>
                                </div>

                                {{-- Female --}}
                                <div class="">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-2 bg-danger bg-opacity-10 d-flex align-items-center justify-content-center"
                                                style="width:28px;height:28px;">
                                                <i class="bi bi-gender-female text-danger" style="font-size:12px;"></i>
                                            </div>
                                            <span class="small fw-semibold">Female</span>
                                        </div>
                                        <div class="text-end">
                                            <span class="small fw-bold text-danger">{{ $femalePatients }}</span>
                                            <span class="text-muted small ms-1">
                                                ({{ $totalPatients > 0 ? round(($femalePatients / $totalPatients) * 100) : 0 }}%)
                                            </span>
                                        </div>
                                    </div>
                                    <div class="progress rounded-pill" style="height:6px;">
                                        <div class="progress-bar bg-danger rounded-pill"
                                            style="width:{{ $totalPatients > 0 ? round(($femalePatients / $totalPatients) * 100) : 0 }}%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Recent Visits --}}
                    <div class="col-12 col-xl-8">
                        <div class="card border-0 shadow-sm h-100">

                            <div class="card-body p-4 pb-0">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="fw-bold mb-0">Recent Visits</h6>
                                        <small class="text-muted">Latest patient consultations</small>
                                    </div>
                                    <a href="{{ route('visits.index') }}"
                                        class="text-primary text-decoration-none small fw-semibold">
                                        View all <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr class="border-top border-bottom">
                                            <th class="ps-4 py-2 small text-muted fw-semibold text-uppercase bg-transparent"
                                                style="font-size:10px; letter-spacing:.05em;">Patient</th>
                                            <th class="py-2 small text-muted fw-semibold text-uppercase bg-transparent"
                                                style="font-size:10px; letter-spacing:.05em;">Complaint</th>
                                            <th class="py-2 small text-muted fw-semibold text-uppercase bg-transparent"
                                                style="font-size:10px; letter-spacing:.05em;">Date</th>
                                            <th class="py-2 bg-transparent"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentVisits as $visit)
                                            <tr>
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                                                            style="width:34px;height:34px;">
                                                            <span class="fw-bold text-primary" style="font-size:10px;">
                                                                {{ strtoupper(substr($visit->patient->firstname, 0, 1)) }}{{ strtoupper(substr($visit->patient->surname, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="fw-semibold small lh-sm">
                                                                {{ $visit->patient->surname }}
                                                                {{ $visit->patient->firstname }}
                                                            </div>
                                                            <small class="text-muted" style="font-size:10px;">
                                                                {{ ucfirst($visit->patient->gender) }} ·
                                                                {{ \Carbon\Carbon::parse($visit->patient->date_of_birth)->age }}yrs
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="max-width:160px;">
                                                    <p class="small text-truncate mb-0 text-muted">
                                                        {{ $visit->complaint }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="small fw-semibold lh-sm">
                                                        {{ \Carbon\Carbon::parse($visit->visited_at)->format('d M, Y') }}
                                                    </div>
                                                    <small class="text-muted" style="font-size:10px;">
                                                        {{ \Carbon\Carbon::parse($visit->visited_at)->format('h:i A') }}
                                                    </small>
                                                </td>
                                                {{-- <td class="pe-3">
                                                    <a href="{{ route('visits.show', $visit->id) }}"
                                                        class="btn btn-sm btn-light border px-2" title="View Visit"
                                                        style="font-size:12px;">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5">
                                                    <span class="text-muted small">No visits recorded yet.</span>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            {{-- ===== RIGHT SIDEBAR 3 COLS ===== --}}
            <div class="col-lg-3 d-flex flex-column gap-3">

                {{-- RECENT PATIENTS --}}
                <div class="card border-0 shadow-sm flex-grow-1">
                    <div class="card-body p-4 pb-2">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-bold mb-0">Recent Patients</h6>
                                <small class="text-muted">Newly registered</small>
                            </div>
                            <a href="{{ route('patients.index') }}"
                                class="text-primary text-decoration-none small fw-semibold">
                                All <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="px-3 pb-3 d-flex flex-column gap-1">
                        @forelse ($recentPatients as $patient)
                            <a href="{{ route('patients.show', $patient->id) }}"
                                class="d-flex align-items-center gap-3 p-2 rounded-3 text-decoration-none"
                                style="transition:.15s;" onmouseover="this.style.background='rgba(0,123,255,0.05)'"
                                onmouseout="this.style.background='transparent'">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width:36px;height:36px;">
                                    <span class="fw-bold text-primary" style="font-size:10px;">
                                        {{ strtoupper(substr($patient->firstname, 0, 1)) }}{{ strtoupper(substr($patient->surname, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <div class="fw-semibold small text-truncate lh-sm">
                                        {{ $patient->surname }} {{ $patient->firstname }}
                                    </div>
                                    <small class="text-muted" style="font-size:10px;">
                                        {{ \Carbon\Carbon::parse($patient->date_of_birth)->age }}yrs ·
                                        {{ ucfirst($patient->gender) }}
                                    </small>
                                </div>
                                <i class="bi bi-chevron-right text-muted flex-shrink-0" style="font-size:10px;"></i>
                            </a>
                        @empty
                            <div class="text-center py-3 text-muted small">No patients yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
