@extends('layouts.blank')

@section('title', 'Login')
@section('content')
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-4 col-12 d-flex justify-content-center align-items-center">
                <div id="auth-left" class="w-100">
                    <div class="auth-logo">
                        <a href="index.html"><img src="{{ asset('logo.png') }}" alt="Logo" width=""></a>
                    </div>
                    <h4 class="auth-title">Login.</h4>
                    <p class="auth-subtitle mb-5">Please sign-in to your account.</p>

                    @include('partials.messages')

                    <form action="{{ route('login') }}" class="mb-3" method="POST">
                        @csrf
                        <x-ui.input label="Email address" name="email" placeholder="eg user@gmail.com" autofocus="" />
                        <x-ui.input label="Password" name="password" type="password" placeholder="********" />
                        <x-ui.checkbox name="remember" label="Remember me" />
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100">
                                Login
                            </button>
                        </div>
                    </form>

                    <p class="text-center mt-3 mb-4">
                        <span>Developed by</span>
                        <a href="https://bismacode.netlify.app" class="font-bold" target="_blank">
                            <span>Bismacodes</span>
                        </a>
                    </p>
                </div>
            </div>
            <div class="col-lg-8 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>

@endsection
