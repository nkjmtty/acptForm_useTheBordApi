@extends('cmn-frame')

@section('content')
<div class="container">
    <section class="card-deck mb-3">
        <div class="card">
            <h2 class="card-header">Dashboard</h2>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                You are logged in!
            </div>
        </div>
    </section>
    <div class="card-deck mb-3 text-center">
        <section class="card shadow-sm">
            <div class="card-header">
                <h2 class="my-0 font-weight-normal">acceptance</h2>
            </div>
            <div class="card-body">
                <p class="mt-3 mb-4">receive and inspect form</p>
                <a href="{{ url('/acceptance') }}" class="btn btn-lg btn-block btn-primary">List</a>
            </div>
        </section>
        <section class="card shadow-sm">
            <div class="card-header">
                <h2 class="my-0 font-weight-normal">survey</h2>
            </div>
            <div class="card-body">
                <p class="mt-3 mb-4">bbbb</p>
                <button type="button" class="btn btn-lg btn-block btn-outline-primary" disabled>in preparation</button>
            </div>
        </section>
    </div>
</div>
@endsection
