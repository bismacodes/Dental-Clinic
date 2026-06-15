@extends('layouts.app')

@section('title', 'Patient Profile')

@section('content')

    <x-ui.page-title title="Patient Profile" subtitle="Complete patient information and visit history" />

    <div class="container-fluid px-0">
        <div class="row g-4">

            {{-- ===== LEFT COLUMN ===== --}}
            <div class="col-lg-8">

                {{-- PATIENT DETAILS CARD --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header border-bottom py-3 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0">Personal Information</h6>
                                <small class="text-muted">Patient demographics and contact details</small>
                            </div>
                            <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        <div class="row g-4">

                            {{-- Full Name --}}
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small fw-semibold mb-2">Full Name</label>
                                    <p class="fw-semibold mb-0">
                                        {{ $patient->surname }} {{ $patient->firstname }}
                                        @if ($patient->othername)
                                            {{ $patient->othername }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            {{-- Patient ID --}}
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small fw-semibold mb-2">Patient ID</label>
                                    <p class="fw-semibold mb-0">
                                        <span class="badge text-primary border font-monospace">
                                            #P{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            {{-- Gender --}}
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small fw-semibold mb-2">Gender</label>
                                    <p class="fw-semibold mb-0 text-capitalize">
                                        {{ $patient->gender }}
                                    </p>
                                </div>
                            </div>

                            {{-- Age --}}
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small fw-semibold mb-2">Date of Birth</label>
                                    <p class="fw-semibold mb-0">
                                        {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d M, Y') }}
                                        <span
                                            class="text-muted small">({{ \Carbon\Carbon::parse($patient->date_of_birth)->age }}
                                            years old)</span>
                                    </p>
                                </div>
                            </div>

                            {{-- Phone --}}
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small fw-semibold mb-2">Phone Number</label>
                                    <p class="fw-semibold mb-0">
                                        {{ $patient->phone_no }}
                                    </p>
                                </div>
                            </div>

                            {{-- Emergency Contact --}}
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small fw-semibold mb-2">Emergency Contact</label>
                                    <p class="fw-semibold mb-0">
                                        {{ $patient->relative_phone_no }}
                                    </p>
                                </div>
                            </div>

                            {{-- Address --}}
                            <div class="col-12">
                                <div>
                                    <label class="form-label text-muted small fw-semibold mb-2">Home Address</label>
                                    <p class="fw-semibold mb-0">
                                        {{ $patient->address }}
                                    </p>
                                </div>
                            </div>

                            {{-- Registration Date --}}
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small fw-semibold mb-2">Registered On</label>
                                    <p class="fw-semibold mb-0">
                                        {{ \Carbon\Carbon::parse($patient->created_at)->format('d M, Y') }}
                                        <span
                                            class="text-muted small">({{ \Carbon\Carbon::parse($patient->created_at)->diffForHumans() }})</span>
                                    </p>
                                </div>
                            </div>

                            {{-- Last Updated --}}
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label text-muted small fw-semibold mb-2">Last Updated</label>
                                    <p class="fw-semibold mb-0">
                                        {{ \Carbon\Carbon::parse($patient->updated_at)->format('d M, Y') }}
                                        <span
                                            class="text-muted small">({{ \Carbon\Carbon::parse($patient->updated_at)->diffForHumans() }})</span>
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- VISIT HISTORY --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header border-bottom py-3 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-0">Visit History</h6>
                                <small class="text-muted">All consultations and treatments</small>
                            </div>
                            <div>
                                <span class="badge bg-primary rounded-pill px-3">
                                    {{ $visits->total() }}
                                    {{ Str::plural('Visit', $visits->total()) }}
                                </span>
                                <a href="{{ route('visits.create', $patient->id) }}" class="btn btn-sm btn-success ms-2">
                                    <i class="bi bi-clipboard-plus me-1"></i> Record Visit
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">

                        @if ($visits->count() > 0)

                            {{-- Timeline --}}
                            <div class="p-4">
                                @foreach ($visits as $visit)
                                    <div class="d-flex gap-3 mb-4 {{ !$loop->last ? 'pb-4 border-bottom' : '' }}">

                                        {{-- Timeline dot --}}
                                        <div class="d-flex flex-column align-items-center flex-shrink-0">
                                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                                style="width:10px; height:10px; margin-top:5px;">
                                            </div>
                                            @if (!$loop->last)
                                                <div class="bg-light flex-grow-1 mt-1" style="width:2px;"></div>
                                            @endif
                                        </div>

                                        {{-- Content --}}
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold">
                                                    {{ \Carbon\Carbon::parse($visit->visited_at)->format('d M, Y · h:i A') }}
                                                </span>
                                            </div>

                                            <div class="row g-2">

                                                @if ($visit->complaint)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-danger bg-opacity-10 p-3 h-100">
                                                            <small class="text-muted d-block mb-2 fw-semibold">
                                                                Complaint
                                                            </small>
                                                            <p class="mb-0 small">{{ $visit->complaint }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($visit->investigation)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-info bg-opacity-10 p-3 h-100">
                                                            <small class="text-muted d-block mb-2 fw-semibold">
                                                                Investigation
                                                            </small>
                                                            <p class="mb-0 small">{{ $visit->investigation }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($visit->treatment_plan)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-success bg-opacity-10 p-3 h-100">
                                                            <small class="text-muted d-block mb-2 fw-semibold">
                                                                Treatment Plan
                                                            </small>
                                                            <p class="mb-0 small">{{ $visit->treatment_plan }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($visit->medication)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-warning bg-opacity-10 p-3 h-100">
                                                            <small class="text-muted d-block mb-2 fw-semibold">
                                                                Medication
                                                            </small>
                                                            <p class="mb-0 small">{{ $visit->medication }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($visit->medical_history)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-primary bg-opacity-10 p-3 h-100">
                                                            <small class="text-muted d-block mb-2 fw-semibold">
                                                                Medical History
                                                            </small>
                                                            <p class="mb-0 small">{{ $visit->medical_history }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($visit->dental_history)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-dark bg-opacity-10 p-3 h-100">
                                                            <small class="text-muted d-block mb-2 fw-semibold">
                                                                Dental History
                                                            </small>
                                                            <p class="mb-0 small">{{ $visit->dental_history }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($visit->review)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-secondary bg-opacity-10 p-3 h-100">
                                                            <small class="text-muted d-block mb-2 fw-semibold">
                                                                Review
                                                            </small>
                                                            <p class="mb-0 small">{{ $visit->review }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Pagination --}}
                            <div class="p-4 pt-0">
                                {{ $visits->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <h6 class="fw-semibold mb-1">No previous visits</h6>
                                <p class="text-muted small mb-3">This patient has no consultation history yet.</p>
                                <a href="{{ route('visits.create', $patient->id) }}" class="btn btn-primary btn-sm">
                                    Record First Visit
                                </a>
                            </div>
                        @endif

                    </div>
                </div>

            </div>

            {{-- ===== RIGHT COLUMN ===== --}}
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">

                    {{-- PATIENT AVATAR CARD --}}
                    <div class="card border-0 shadow-sm mb-3">

                        <div class="card-body p-4 text-center">

                            {{-- Avatar --}}
                            <div class="position-relative d-inline-block mb-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto"
                                    style="width:100px; height:100px;">
                                    <span class="fw-bold text-primary fs-3">
                                        {{ strtoupper(substr($patient->firstname, 0, 1)) }}{{ strtoupper(substr($patient->surname, 0, 1)) }}
                                    </span>
                                </div>
                                <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-success p-1"
                                    style="font-size:9px;">
                                    <i class="bi bi-check2"></i>
                                </span>
                            </div>

                            <h5 class="fw-bold mb-0">
                                {{ $patient->surname }} {{ $patient->firstname }}
                            </h5>

                            @if ($patient->othername)
                                <small class="text-muted">{{ $patient->othername }}</small>
                            @endif

                            {{-- Gender & Age pills --}}
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <span
                                    class="badge rounded-pill bg-primary bg-opacity-10 text-primary text-capitalize px-3">
                                    {{ $patient->gender }}
                                </span>
                                <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary px-3">
                                    {{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} yrs
                                </span>
                            </div>

                        </div>
                    </div>

                    {{-- Quick Stats --}}
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-body p-3">
                            <div class="row g-2 text-center">
                                <div class="col-6">
                                    <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                        <div class="fw-bold fs-5 text-primary">{{ $patient->visits->count() }}</div>
                                        <div class="text-muted" style="font-size:11px;">Total Visits</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                        <div class="fw-bold fs-5 text-success">
                                            {{ $patient->visits->whereNotNull('review')->count() }}
                                        </div>
                                        <div class="text-muted" style="font-size:11px;">With Review</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
