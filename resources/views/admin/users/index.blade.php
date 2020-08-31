@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">Users</div>
        <div class="card-body">

            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    {{  Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                    {{  Session::get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

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
                        <td class="capitalize">{{ implode(' , ' ,$user->roles()->get()->pluck('name')->toArray() ) }}</td>
                        <td>
                            @can('edit-users')
                                <a href="{{ route('admin.users.edit',$user->id) }}"><button type="button" class="btn btn-warning mr-3">Edit</button></a>

                                <button class="btn btn-danger" onclick="doDeleteUser({{ $user->id }})">Delete</button>
                                <form class="hidden" method="POST" action="{{ route('admin.users.destroy', $user) }}" id="delete-user-{{ $user->id }}" name="delete-user-{{ $user->id }}">
                                    @csrf
                                    {{ method_field('DELETE') }}
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

@push('scripts')
<script>
    function doDeleteUser(userId)
    {
        const name = "delete-user-" + userId;
        const form = document.getElementById(name);
        if (form)
        {
            form.submit();
        }
    }
</script>
@endpush