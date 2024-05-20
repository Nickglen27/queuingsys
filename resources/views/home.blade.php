@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('registered'))
                        <div class="alert alert-success" role="alert">
                            Successfully Registered! You can now Log In
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    // Add a 5-second delay for redirection after registering
    setTimeout(function() {
        @if(auth()->user()->department === 'Registrar')
            window.location.href = "{{ route('registration.registrar') }}";
        @elseif(auth()->user()->department === 'Admin')
            window.location.href = "{{ route('registration.admin') }}";
        @elseif(auth()->user()->department === 'Cashier')
            window.location.href = "{{ route('registration.cashier') }}";
        @else
            // Default redirection if department is not recognized
            window.location.href = "{{ route('home') }}"; // Redirect to the homepage
        @endif
    }, 5000); // 5000 milliseconds = 5 seconds
</script> -->

@endsection
