@extends('layouts.app')

@section('title', 'New Visit')

@section('content')

    <x-ui.page-title title="Patient Visit" subtitle="Record consultation and treatment details" />

    <div class="container-fluid px-0">
        <div class="row g-4">

            {{-- ===== LEFT COLUMN ===== --}}
            <div class="col-lg-8">

                {{-- VISIT FORM --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header border-bottom py-3 px-4">
                        <div class="gap-2">
                            <h6 class="fw-bold mb-0">New Visit Record</h6>
                            <small class="text-muted">Fill in consultation details below</small>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('visits.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                            {{-- Visit Date --}}
                            <x-ui.input type="datetime-local" name="visited_at" label="Visit Date & Time"
                                value="{{ now()->format('Y-m-d\TH:i') }}" required />

                            {{-- Section Divider --}}
                            <div class="d-flex align-items-center gap-2 mb-3 mt-5">
                                <span class="small fw-bold text-uppercase text-muted">Clinical Notes</span>
                                <hr class="flex-grow-1 my-0">
                            </div>

                            {{-- Complaint --}}
                            <x-ui.textarea name="complaint" label="Complaint"
                                placeholder="Describe the patient's main complaints..." rows="3" required />

                            {{-- Investigation --}}
                            <x-ui.textarea name="investigation" label="Investigation"
                                placeholder="Lab tests, X-rays, scans, observations..." rows="3" />

                            {{-- Treatment Plan --}}
                            <x-ui.textarea name="treatment_plan" label="Treatment Plan"
                                placeholder="Procedures, recommendations, interventions..." rows="3" />


                            <x-ui.textarea name="medical_history" label="Medical History"
                                placeholder="Past medical conditions, surgeries, allergies..." rows="3" />

                            <x-ui.textarea name="dental_history" label="Dental History"
                                placeholder="Past dental procedures, treatments, concerns..." rows="3" />

                            {{-- Divider --}}
                            <div class="d-flex align-items-center gap-2 mb-3 mt-5">
                                <span class="small fw-bold text-uppercase text-muted">Prescription & Follow-up</span>
                                <hr class="flex-grow-1 my-0">
                            </div>

                            {{-- Medication --}}
                            <x-ui.textarea name="medication" label="Medication"
                                placeholder="Drugs prescribed, dosage, duration..." rows="3" />

                            {{-- Review --}}
                            <x-ui.textarea name="review" label="Review / Follow-up Notes"
                                placeholder="Next appointment instructions, follow-up notes..." rows="3" />

                            {{-- Actions --}}
                            <div class="d-flex justify-content-between align-items-center pt-3">
                                <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary px-4">
                                    <i class="bi bi-arrow-left me-1"></i> Cancel
                                </a>
                                <x-ui.button type="submit" variant="primary" class="px-5">
                                    <i class="bi bi-check2-circle me-1"></i> Save Visit
                                </x-ui.button>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- VISIT HISTORY --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header border-bottom py-3 px-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-2 bg-warning bg-opacity-10 p-2 d-flex align-items-center justify-content-center"
                                    style="width:36px; height:36px;">
                                    <i class="bi bi-clock-history text-warning"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">Visit History</h6>
                                    <small class="text-muted">Previous consultations</small>
                                </div>
                            </div>
                            <span class="badge bg-primary rounded-pill px-3">
                                {{ $patient->visits->count() }}
                                {{ Str::plural('Visit', $patient->visits->count()) }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body p-0">

                        @if ($patient->visits->count() > 0)

                            {{-- Timeline --}}
                            <div class="p-4">
                                @foreach ($patient->visits->sortByDesc('visited_at') as $visit)
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
                                                    <i class="bi bi-calendar2 me-1"></i>
                                                    {{ \Carbon\Carbon::parse($visit->visited_at)->format('d M, Y · h:i A') }}
                                                </span>
                                            </div>

                                            <div class="row g-2">

                                                @if ($visit->complaint)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-danger bg-opacity-10 p-2 h-100">
                                                            <small class="text-muted d-block mb-1 fw-semibold">
                                                                <i class="bi bi-exclamation-circle text-danger me-1"></i>
                                                                Complaint
                                                            </small>
                                                            <p class="mb-0 small text-truncate">{{ $visit->complaint }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($visit->treatment_plan)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-success bg-opacity-10 p-2 h-100">
                                                            <small class="text-muted d-block mb-1 fw-semibold">
                                                                Treatment
                                                            </small>
                                                            <p class="mb-0 small text-truncate">
                                                                {{ $visit->treatment_plan }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($visit->medication)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-warning bg-opacity-10 p-2 h-100">
                                                            <small class="text-muted d-block mb-1 fw-semibold">
                                                                <i class="bi bi-capsule text-warning me-1"></i>
                                                                Medication
                                                            </small>
                                                            <p class="mb-0 small text-truncate">{{ $visit->medication }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($visit->review)
                                                    <div class="col-md-6">
                                                        <div class="rounded-3 bg-info bg-opacity-10 p-2 h-100">
                                                            <small class="text-muted d-block mb-1 fw-semibold">
                                                                <i class="bi bi-arrow-repeat text-info me-1"></i>
                                                                Review
                                                            </small>
                                                            <p class="mb-0 small text-truncate">{{ $visit->review }}</p>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-clipboard-x text-muted fs-1"></i>
                                <h6 class="fw-semibold mb-1">No previous visits</h6>
                                <p class="text-muted small mb-0">This patient has no consultation history yet.</p>
                            </div>

                        @endif

                    </div>
                </div>

            </div>

            {{-- ===== RIGHT COLUMN ===== --}}
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">

                    {{-- PATIENT CARD --}}
                    <div class="card border-0 shadow-sm mb-3">

                        <div class="card-body p-4 text-center">

                            {{-- Avatar --}}
                            <div class="position-relative d-inline-block mb-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center mx-auto"
                                    style="width:80px; height:80px;">
                                    <span class="fw-bold text-primary fs-4">
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
                            <div class="d-flex justify-content-center gap-2 mt-2">
                                <span
                                    class="badge rounded-pill bg-primary bg-opacity-10 text-primary text-capitalize px-3">
                                    <i
                                        class="bi bi-gender-{{ $patient->gender === 'male' ? 'male' : 'female' }} me-1"></i>
                                    {{ $patient->gender }}
                                </span>
                                <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary px-3">
                                    {{ \Carbon\Carbon::parse($patient->date_of_birth)->age }} yrs
                                </span>
                            </div>

                        </div>

                        {{-- Details list --}}
                        <div class="list-group list-group-flush border-top">

                            <div class="list-group-item px-4 py-2 d-flex justify-content-between align-items-center">
                                <span class="small text-muted d-flex align-items-center gap-2">
                                    Date of Birth
                                </span>
                                <span class="small fw-semibold">
                                    {{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d M, Y') }}
                                </span>
                            </div>

                            <div class="list-group-item px-4 py-2 d-flex justify-content-between align-items-center">
                                <span class="small text-muted d-flex align-items-center gap-2">
                                    Phone
                                </span>
                                <span class="small fw-semibold">{{ $patient->phone_no }}</span>
                            </div>

                            <div class="list-group-item px-4 py-2 d-flex justify-content-between align-items-center">
                                <span class="small text-muted d-flex align-items-center gap-2">
                                    Emergency
                                </span>
                                <span class="small fw-semibold">{{ $patient->relative_phone_no }}</span>
                            </div>

                            <div class="list-group-item px-4 py-2">
                                <span class="small text-muted d-flex align-items-center gap-2 mb-1">
                                    Address
                                </span>
                                <span class="small fw-semibold">{{ $patient->address }}</span>
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
