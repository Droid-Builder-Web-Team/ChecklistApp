@extends('layouts.app')

@section('content')

<div class="container"></div>
    <div class="row">
        <div class="col-md-10 mx-auto">
            <a class="m-3 btn btn-warning" href="{{ route('admin.admin.dashboard') }}">Back</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->uname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <form method="post" action="{{ route('verificationReminder', $user->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-baddeley">Send Reminder</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection