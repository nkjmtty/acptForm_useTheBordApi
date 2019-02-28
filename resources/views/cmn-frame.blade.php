<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ config('app.name', 'Laravel') }} - {{{ env('COMPANY_NAME') }}}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

@yield('css')
    </head>
    <body>
        <div class="navbar navbar-expand-md navbar-light border-bottom shadow-sm mb-5">
            <div class="container">
                <header class="navbar-brand">
                    <h1 class="font-weight-normal h6"><a href="{{ url('/') }}">{{{ env('COMPANY_NAME') }}} {{ config('app.name', 'Laravel') }}</a></h1>
                </header>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <nav class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav ml-auto">
@guest
    @if(Route::has('register') && Request::getClientIp() == env('COMPANY_IP'))
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a></li>
    @endif
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a></li>
@else
                        <li class="nav-item dropdown">
                            <a href="#" role="button" class="nav-link dropdown-toggle" data-toggle="dropdown" id="navbarDropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }} <span class="caret"></span></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{ url('/home') }}" class="dropdown-item">HOME</a>
                                <a href="{{ url('/acceptance') }}" class="dropdown-item">receive and inspect</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('/setting') }}" class="dropdown-item">setting</a>
                                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </div>
                        </li>
@endguest
                    </ul>
                </nav>
            </div>
        </div>
        <main role="main">
@yield('content')
        </main>
        <footer class="border-top pt-4 pb-4 pl-4 mt-5 text-center">
            <small class="text-muted">&copy; 2019 {{{ env('COMPANY_NAME', 'Laravel') }}} All rights reserved.</small>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js" integrity="sha384-7aThvCh9TypR7fIc2HV4O/nFMVCBwyIUKL8XCtKE+8xgCgl/PQGuFsvShjr74PBp" crossorigin="anonymous"></script>
@yield('js')
    </body>
</html>
