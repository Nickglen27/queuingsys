@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg rounded-lg" style="background: linear-gradient(135deg, #d3bccc 45%, #ffffff 45%);">
                    <div class="card-header custom-bg-color text-black text-center fw-bold fs-4">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror rounded-pill" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror rounded-pill" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror rounded-pill"
                                    name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control rounded-pill"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="mb-0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary w-100 rounded-pill smaller-btn"
                                            style="background-color: #d3bccc; color: #4d4d4d; border: 2px solid #4d4d4d;">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body,
        html {
            background: linear-gradient(135deg, #007bff 45%, #d3bccc 45%);
            background-size: 150% 150%;
            height: 100vh !important;
            overflow: hidden !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .container {
            max-height: 100vh !important;
            overflow: hidden !important;
        }

        .row {
            max-height: 100vh !important;
            overflow: hidden !important;
        }

        .card-body {
            overflow: hidden !important;
        }

        .custom-bg-color {
            background-color: #d3bccc !important;
        }

        .smaller-btn {
            padding: 8px 16px !important;
            font-size: 0.875rem !important;
            position: relative !important;
            color: #4d4d4d !important;
            font-weight: bold !important;
            border: 2px solid #d3bccc !important;
        }

        .smaller-btn::before {
            content: '' !important;
            position: absolute !important;
            top: -3px !important;
            left: -3px !important;
            right: -3px !important;
            bottom: -3px !important;
            border: 2px solid #4d4d4d !important;
            border-radius: 50px !important;
            pointer-events: none !important;
        }

        .smaller-btn:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;
        }

        ::-webkit-scrollbar {
            width: 0px !important;
            height: 0px !important;
            display: none !important;
        }

        body {
            scrollbar-width: none !important;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const registerButton = form.querySelector('button[type="submit"]');

            registerButton.addEventListener('click', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to proceed with the registration?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, register me!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
