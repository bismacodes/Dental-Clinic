@extends('layouts.app')

@section('title', 'Visits')

@section('content')

    <x-ui.page-title title="Visits" subtitle="Patient consultation and treatment records" />

    {{-- Stats Row --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3 py-0">
                    <div class="">
                        <i class="bi bi-calendar-check text-primary" style="font-size: 60px"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total Visits</div>
                        <div class="fw-bold fs-5">{{ $visits->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="">
                        <i class="bi bi-calendar2-event text-success" style="font-size: 60px"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Today</div>
                        <div class="fw-bold fs-5">
                            {{ $visits->where('visited_at', '>=', now()->startOfDay())->where('visited_at', '<=', now()->endOfDay())->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3 py-0">
                    <div>
                        <i class="bi bi-calendar3-range text-warning" style="font-size: 60px"></i>
                    </div>
                    <div>
                        <div class="text-muted small">This Month</div>
                        <div class="fw-bold fs-5">{{ $visits->where('visited_at', '>=', now()->startOfMonth())->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3 py-0">
                    <div>
                        <i class="bi bi-capsule text-danger" style="font-size: 60px"></i>
                    </div>
                    <div>
                        <div class="text-muted small">With Medication</div>
                        <div class="fw-bold fs-5">{{ $visits->whereNotNull('medication')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5">

            @if ($visits->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="table1">

                        <thead class="">
                            <tr>
                                <th class="ps-4 text-muted fw-semibold small text-uppercase">#</th>
                                <th class="text-muted fw-semibold small text-uppercase">Patient</th>
                                <th class="text-muted fw-semibold small text-uppercase">Date & Time</th>
                                <th class="text-muted fw-semibold small text-uppercase">Complaint</th>
                                <th class="text-muted fw-semibold small text-uppercase">Treatment</th>
                                <th class="text-muted fw-semibold small text-uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($visits as $visit)
                                <tr>
                                    <td class="ps-4 text-muted small">{{ $loop->iteration }}</td>

                                    {{-- Patient --}}
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width: 38px; height: 38px;">
                                                <span class="fw-bold text-primary small">
                                                    {{ strtoupper(substr($visit->patient->firstname, 0, 1)) }}{{ strtoupper(substr($visit->patient->surname, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold lh-sm small">
                                                    {{ $visit->patient->surname }} {{ $visit->patient->firstname }}
                                                </div>
                                                <span class="badge bg-light text-dark border fw-normal font-monospace"
                                                    style="font-size: 10px;">
                                                    #P{{ str_pad($visit->patient->id, 5, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Date & Time --}}
                                    <td>
                                        <div class="small">
                                            <div class="fw-semibold">
                                                {{ \Carbon\Carbon::parse($visit->visited_at)->format('d M, Y') }}
                                            </div>
                                            <span
                                                class="text-muted">{{ \Carbon\Carbon::parse($visit->visited_at)->format('h:i A') }}</span>
                                        </div>
                                    </td>

                                    {{-- Complaint --}}
                                    <td>
                                        @if ($visit->complaint)
                                            <span class="badge bg-danger bg-opacity-10 text-danger"
                                                title="{{ $visit->complaint }}">
                                                <i class="bi bi-exclamation-circle me-1"></i>
                                                {{ Str::limit($visit->complaint, 25) }}
                                            </span>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>

                                    {{-- Treatment --}}
                                    <td>
                                        @if ($visit->treatment_plan)
                                            <span class="badge bg-success bg-opacity-10 text-success"
                                                title="{{ $visit->treatment_plan }}">
                                                <i class="bi bi-heart-pulse me-1"></i>
                                                {{ Str::limit($visit->treatment_plan, 25) }}
                                            </span>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">

                                            {{-- View Patient --}}
                                            <a href="{{ route('patients.show', $visit->patient->id) }}"
                                                class="btn btn-sm btn-outline-primary px-2" title="View Patient">
                                                <i class="bi bi-person"></i>
                                            </a>

                                            {{-- New Visit for same patient --}}
                                            <a href="{{ route('visits.create', $visit->patient->id) }}"
                                                class="btn btn-sm btn-outline-success px-2" title="Record New Visit">
                                                <i class="bi bi-plus-circle"></i>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            @else
                <div class="text-center py-5 my-3">
                    <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 72px; height: 72px;">
                        <i class="bi bi-calendar-x text-primary fs-2"></i>
                    </div>
                    <h6 class="fw-semibold mb-1">No visits recorded</h6>
                    <p class="text-muted small mb-3">Get started by recording your first patient visit.</p>
                    <a href="{{ route('patients.index') }}" class="btn btn-primary btn-sm px-4">
                        <i class="bi bi-people me-1"></i> View Patients
                    </a>
                </div>

            @endif

        </div>
    </div>

@endsection
