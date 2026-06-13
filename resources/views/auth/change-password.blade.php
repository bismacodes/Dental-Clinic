@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

    <x-ui.page-title title="Change Password" subtitle="Update your password" />

    <div class="page-content">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <x-ui.input label="Current Password" name="current_password" type="password"
                                placeholder="Enter your current password" required />

                            <x-ui.input label="New Password" name="password" type="password"
                                placeholder="Enter your new password" required />

                            <x-ui.input label="Confirm Password" name="password_confirmation" type="password"
                                placeholder="Confirm your new password" required />

                            <div class="d-flex gap-2 mt-4">
                                <x-ui.button variant="primary" type="submit">
                                    <i class="bi bi-check-circle"></i> Update Password
                                </x-ui.button>
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
