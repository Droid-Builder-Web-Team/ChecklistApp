@extends('layouts.app')

@section('content')

<div class="col-md-10">
    <div class="card-header">
        Notifications
    </div>
    <div class="card-body">
        @foreach(Auth::user()->notifications as $notification)
            <h5><a href="admin/users/{{ $notification->data['user_id'] }}/profile">{{ $notification->data['user_name'] }} has landed.</a></h5>
            <p>{{ $notification->created_at->diffForHumans() }}</p>
        @endforeach
    </div>
@endsection

