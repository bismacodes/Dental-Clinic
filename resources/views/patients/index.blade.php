@extends('layouts.app')

@section('title', 'Patients')

@section('content')

    <x-ui.page-title title="Patients" subtitle="Manage patient records" />

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
                        <div class="fw-bold fs-5">{{ $patients->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center  gap-3">
                    <div class="">
                        <i class="bi bi-gender-male text-success" style="font-size: 60px"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Male</div>
                        <div class="fw-bold fs-5">{{ $patients->where('gender', 'male')->count() }}</div>
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
                        <div class="fw-bold fs-5">{{ $patients->where('gender', 'female')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3 py-0">
                    <div>
                        <i class="bi bi-person-plus-fill text-warning" style="font-size: 60px"></i>
                    </div>
                    <div>
                        <div class="text-muted small">New This Month</div>
                        <div class="fw-bold fs-5">
                            {{ $patients->where('created_at', '>=', now()->startOfMonth())->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-5">

            @if ($patients->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="table1">

                        <thead class="">
                            <tr>
                                <th class="ps-4 text-muted fw-semibold small text-uppercase">#</th>
                                <th class="text-muted fw-semibold small text-uppercase">Patient ID</th>
                                <th class="text-muted fw-semibold small text-uppercase">Full Name</th>
                                <th class="text-muted fw-semibold small text-uppercase">Gender</th>
                                <th class="text-muted fw-semibold small text-uppercase">Phone</th>
                                <th class="text-muted fw-semibold small text-uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td class="ps-4 text-muted small">{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="badge text-primary border fw-normal font-monospace">
                                            #P{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center flex-shrink-0"
                                                style="width: 38px; height: 38px;">
                                                <span class="fw-bold text-primary small">
                                                    {{ strtoupper(substr($patient->firstname, 0, 1)) }}{{ strtoupper(substr($patient->surname, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold lh-sm">
                                                    {{ $patient->surname }} {{ $patient->firstname }}
                                                    @if ($patient->othername)
                                                        {{ $patient->othername }}
                                                    @endif
                                                </div>
                                                @if ($patient->email)
                                                    <small class="text-muted">{{ $patient->email }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        @if ($patient->gender === 'male')
                                            <span
                                                class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 text-capitalize">
                                                <i class="bi bi-gender-male me-1"></i>{{ $patient->gender }}
                                            </span>
                                        @elseif($patient->gender === 'female')
                                            <span
                                                class="badge rounded-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 text-capitalize">
                                                <i class="bi bi-gender-female me-1"></i>{{ $patient->gender }}
                                            </span>
                                        @else
                                            <span
                                                class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary text-capitalize">
                                                {{ $patient->gender }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="small">{{ $patient->phone_no }}</span>
                                    </td>

                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">

                                            {{-- View --}}
                                            <a href="{{ route('patients.show', $patient->id) }}"
                                                class="btn btn-sm btn-outline-primary px-2" title="View Patient">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('patients.edit', $patient->id) }}"
                                                class="btn btn-sm btn-outline-warning px-2" title="Edit Patient">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            {{-- Visit --}}
                                            <a href="{{ route('visits.create', $patient->id) }}"
                                                class="btn btn-sm btn-outline-success px-2" title="New Visit">
                                                <i class="bi bi-clipboard-plus"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('patients.destroy', $patient->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this patient?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger px-2"
                                                    title="Delete Patient">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

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
                        <i class="bi bi-people text-primary fs-2"></i>
                    </div>
                    <h6 class="fw-semibold mb-1">No patients found</h6>
                    <p class="text-muted small mb-3">Get started by adding your first patient record.</p>
                    <a href="{{ route('patients.create') }}" class="btn btn-primary btn-sm px-4">
                        <i class="bi bi-plus-lg me-1"></i> Add First Patient
                    </a>
                </div>

            @endif

        </div>
    </div>

@endsection
