@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hello, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Current Login time {{ auth()->user()->current_login }}</p>
                    <p>You last logged in at {{ auth()->user()->last_login }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
