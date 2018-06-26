@extends('layouts.app')

@section('title', '| Login')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">

                    <div class="card-header text-center text-uppercase h4 tracking-wide bg-indigo-lighter font-bold mb-3">
                        <i class="fa fa-lock"></i> <b>Sign In</b>
                    </div>

                    <!-- Login form -->
                    @include('auth.forms._login')

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        removeErrorOnNewInput()

    </script>
@endsection