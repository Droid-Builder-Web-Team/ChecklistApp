@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit User {{ $user->name() }}</div>

                    <div class="card-body">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">

                            @csrf

                            {{ method_field('PUT') }}

                            <!-- First Name -->
                            <div class="form-group row">
                                <label for="fname" class="col-md-3 col-form-label text-md-right">First Name</label>

                                <div class="col-md-8">
                                    <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror"
                                        name="fname" value="{{ $user->fname }}" required autofocus>

                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="form-group row">
                                <label for="lname" class="col-md-3 col-form-label text-md-right">Last Name</label>

                                <div class="col-md-8">
                                    <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror"
                                        name="lname" value="{{ $user->lname }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="form-group row">
                                <label for="roles" class="col-md-3 col-form-label text-md-right">Roles</label>
                                <div class="col-md-8">
                                    @foreach ($roles as $role)
                                        <div class="form-check">
                                            <input type="checkbox" name="roles[]" id="admin_role" value="1" {{ ($user->roles->pluck('id')->contains($role->id)) ? ' checked' : '' }}>
                                            <label class="ml-2 capitalize">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Save -->
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-8 text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>

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

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
