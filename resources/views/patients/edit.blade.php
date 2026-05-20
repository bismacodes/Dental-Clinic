@extends('layouts.app')

@section('title', 'Edit Patient')

@section('content')

    <x-ui.page-title title="Edit Patient" subtitle="Update patient record information" />

    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="container-fluid">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    {{-- PERSONAL INFO --}}
                    <h4 class="fw-semibold mb-3">Personal Information</h4>

                    <div class="row g-3 mb-3">

                        <div class="col-md-4">
                            <x-ui.input name="surname" label="Surname" :value="old('surname', $patient->surname)" placeholder="e.g. Adeyemi"
                                required />
                        </div>

                        <div class="col-md-4">
                            <x-ui.input name="firstname" label="First Name" :value="old('firstname', $patient->firstname)" placeholder="e.g. Chukwuemeka"
                                required />
                        </div>

                        <div class="col-md-4">
                            <x-ui.input name="othername" label="Other Name" :value="old('othername', $patient->othername)" placeholder="Optional" />
                        </div>

                        <div class="col-md-6">
                            <x-ui.select name="gender" label="Gender" :options="[
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ]" :selected="old('gender', $patient->gender)"
                                placeholder="Select gender" required />
                        </div>

                        <div class="col-md-6">
                            <x-ui.input name="date_of_birth" label="Date of Birth" type="date" :value="old('date_of_birth', $patient->date_of_birth)"
                                max="{{ now()->format('Y-m-d') }}" required />
                        </div>

                    </div>

                    {{-- CONTACT INFO --}}
                    <div class="row g-3 mb-4">

                        <div class="col-md-6">
                            <x-ui.input name="phone_no" label="Phone Number" type="tel" :value="old('phone_no', $patient->phone_no)"
                                placeholder="e.g. 08012345678" required />
                        </div>

                        <div class="col-md-6">
                            <x-ui.input name="relative_phone_no" label="Relative Phone" type="tel" :value="old('relative_phone_no', $patient->relative_phone_no)"
                                placeholder="Emergency contact" required />
                            <div class="form-text">
                                Used in emergencies only
                            </div>
                        </div>

                        <div class="col-12">
                            <x-ui.textarea name="address" label="Home Address"
                                placeholder="Enter full residential address..." rows="3" required :value="$patient->address" />
                        </div>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="d-flex justify-content-between align-items-center pt-3">

                        <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary px-4">
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-primary px-5">
                            Update Patient
                        </button>

                    </div>

                </div>
            </div>

        </div>

    </form>

@endsection
