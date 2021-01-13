@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Links</div>
                    <div class="card-body">
                        <ul class="d-block text-center justify-center" style="list-style:none;">
                            <li class="mb-2"><a href="{{ route('logs') }}" class="btn btn-info">Logs</a></li>
                            <li class="mb-2"><a href="{{ route('admin.users.unverified') }}" class="btn btn-info">User Management</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><br>
    </div>

@endsection
