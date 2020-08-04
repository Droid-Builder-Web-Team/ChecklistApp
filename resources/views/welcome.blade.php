@extends('layouts.app')
@section('content')
@if (Auth::check())

<div class="container">
    <div class="row">
        <div class="progress-bar" style="width:100%">
        </div>
    </div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">

        </div>
    </div>

    @else
        <div class="card-body">
            <h3>You need to log in. <a href="/login">Click here to login</a></h3>
        </div>
</div>
@endif
@endsection
