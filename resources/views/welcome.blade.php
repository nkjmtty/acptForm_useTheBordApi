<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config('app.name', 'Laravel') }} - {{{ env('COMPANY_NAME') }}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <header class="my-0 mr-md-auto">
                <h1 class="font-weight-normal h4">@if( env('COMPANY_URL') )<a href="{{ env('COMPANY_URL') }}" target="_blank">@endif{{{ env('COMPANY_NAME', 'Laravel') }}}@if( env('COMPANY_URL') )</a>@endif</h1>
            </header>
            <nav class="my-2 my-md-0 mr-md-3">
@auth
                <a href="{{ url('/home') }}" class="p-2 text-dark">Home</a>
@else
    @if (Route::has('register') && Request::getClientIp() == env('COMPANY_IP'))
                <a href="{{ route('register') }}" class="p-2 text-dark">Register</a>
    @endif
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
@endauth
            </nav>
        </div>
        <main role="main">
            <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <h2 class="display-1">{{ config('app.name', 'Laravel') }}</h2>
                <p class="lead">HI! this is a system for {{{ env('COMPANY_NAME', 'Laravel') }}} {{ config('app.name') }}</p>
            </div>
@auth
            <div class="container">
                <div class="card-deck mb-3 text-center">
                    <section class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h3 class="my-0 font-weight-normal">acceptance</h3>
                        </div>
                        <div class="card-body">
                            <p class="mt-3 mb-4">receive and inspect form</p>
                            <a href="{{ url('/acceptance') }}" class="btn btn-lg btn-block btn-outline-primary">List</a>
                        </div>
                    </section>
                    <section class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h3 class="my-0 font-weight-normal">survey</h3>
                        </div>
                        <div class="card-body">
                            <p class="mt-3 mb-4">bbbb</p>
                            <button type="button" class="btn btn-lg btn-block btn-primary" disabled>in preparation</button>
                        </div>
                    </section>
                </div>
            </div>
@endauth
        </main>
        <footer class="border-top pt-4 pb-4 pl-4 mt-5 text-center">
            <small class="text-muted">&copy; 2019 {{{ env('COMPANY_NAME', 'Laravel') }}} All rights reserved.</small>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
    </body>
</html>
