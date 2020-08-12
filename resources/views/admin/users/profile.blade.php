@extends('layouts.app')

@section('page_title')
    Profile
@endsection

@section('content')
<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12 profile-container">

    <div class="heading mb-5">
        <h1 class="title text-center">My profile</h1>
    </div>

        <!-- <div class="card">
            <div class="card-header">{{ __('My Profile') }}</div>

            <div class="card-body"> -->
        <div class="bordered-content">
                @if(Session::has('profile_updated'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Profile Updated!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-12 d-flex justify-content-center">
                        <user-avatar-uploader avatar="{{ $user->avatar }}"></user-avatar-uploader>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <form method="POST" action="{{ route('admin.users.profile.update', $user->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : $user->email }}" autocomplete="email" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <!-- First Name -->
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="string" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" placeholder="First Name" value="{{ $user->fname }}" required/>
                                @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="string" class="form-control @error('lname') is-invalid @enderror" name="lname" id="lname" placeholder="Last Name" value="{{ $user->lname }}" required/>
                                @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </div>

                                <div class="form-group">
                                <label for="uname">User Name</label>
                                <input type="string" class="form-control @error('uname') is-invalid @enderror" name="uname" id="uname" placeholder="User Name" value="{{ old('uname') ? old('uname') : $user->uname }}" required/>
                                @error('uname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                                </div>

                            <div class="form-group">
                                <label for="bioTextArea">Short Bio</label>
                                <textarea class="form-control" id="bioTextArea" rows="3" name="bio">{{ $user->profile->bio }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="location">Location (optional)</label>
                                <input type="string" class="form-control" id="location" name="location" placeholder="Alderaan" value="{{ $user->profile->location }}" />
                            </div>

                            <div class="form-group">
                                <label for="homepage_url">Homepage (optional)</label>
                                <input type="string" class="form-control" id="homepage_url" name="homepage" placeholder="Homepage URL" value="{{ $user->profile->homepage }}" />
                            </div>

                            <div class="form-group">
                                <label for="facebook_url">Facebook (optional)</label>
                                <input type="string" class="form-control" id="facebook_url" name="facebook" placeholder="Facebook" value="{{ $user->profile->facebook }}" />
                            </div>

                            <div class="form-group">
                                <label for="instagram">Instagram (optional)</label>
                                <input type="string" class="form-control" id="website" name="instagram" placeholder="Instagram" value="{{ $user->profile->instagram }}" />
                            </div>

                            <div class="form-group">
                                <label for="github">GitHub (optional)</label>
                                <input type="string" class="form-control" id="github" name="github" placeholder="GitHub" value="{{ $user->profile->github }}" />
                                </div>

                            <div class="form-group d-flex">
                                <span class="flex-spacer"></span>
                                <a href="{{ route('droid.user.index') }}" class="btn btn-secondary mr-3">Cancel</a>
                                <button type="submit" class="btn btn-outline-primary">Update</button>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
@endsection
