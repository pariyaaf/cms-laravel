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

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
   function onSubmit(token) {
    console.log('here');  // Fix the typo here
     document.getElementById("demo-form").submit();
   }
</script>
@endsection
