@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg" style="background: linear-gradient(135deg, #d3bccc 45%, #ffffff 45%);">
                <div class="card-header custom-bg-color text-black text-center fw-bold fs-4">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-pill" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-pill" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">{{ __('Select Department') }}</label>
                            <select id="department" class="form-select @error('department') is-invalid @enderror" name="department" required>
                                <option value="Registrar" {{ old('department') == 'Registrar' ? 'selected' : '' }}>Registrar</option>
                                <option value="Admin" {{ old('department') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Cashier" {{ old('department') == 'Cashier' ? 'selected' : '' }}>Cashier</option>
                            </select>
                            @error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary w-100 rounded-pill smaller-btn" style="background-color: #d3bccc; color: #4d4d4d; border: 2px solid #4d4d4d;">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="col-md-6 text-end">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-primary" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
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
    body {
        background: linear-gradient(135deg, #007bff 45%, #d3bccc 45%);
        background-size: 150% 150%;
    }

    .custom-bg-color {
        background-color: #d3bccc !important;
    }

    .smaller-btn {
        padding: 8px 16px;
        font-size: 0.875rem;
        position: relative;
        color: #4d4d4d;
        font-weight: bold;
    }

    .smaller-btn::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border: 2px solid #4d4d4d;
        border-radius: 50px;
        pointer-events: none;
    }

    .smaller-btn:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
