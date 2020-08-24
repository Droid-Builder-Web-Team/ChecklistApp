@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Users</div>
        <div class="card-body">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->uname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode(' , ' ,$user->roles()->get()->pluck('name')->toArray() ) }}</td>
                        <td>
                            @can('edit-users')
                                <a href="{{ route('admin.users.edit',$user->id) }}"><button type="button" class="btn btn-warning float-left">Edit</button></a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @endcan
                        </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
