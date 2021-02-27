@extends('layouts.app')

@section('page_title')
    Profile
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 profile-container">

                <div class="mb-5 heading">
                    <h1 class="text-center title">My Profile</h1>
                </div>
{{-- 
                <div class="mb-3 row">
                    <div class="col-md-12">
                        <p>Number of droids: {{ $droids ?? '' }}</p>
                    </div>
                </div> --}}

                <div class="mb-3 bordered-content">
                    @if (Session::has('profile_updated'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Profile Updated!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="mb-3 row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <avatar-cropper username="{{ $user->uname }}" avatar="{{ $user->getAvatarUrl() }}">
                            </avatar-cropper>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="mb-2 col-md-12">
                            <div class="card">
                            <div class="card-header">
                                User Settings
                            </div>
                            <div class="card-body">
                                <form action="" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card">
                                <div class="card-header">
                                    Email Notifications
                                </div>
                                <div class="card-body">
                                    Toggle all
                                    <div class="table-responsive">
                                    <table class="table text-center table-striped table-sm table-hover table-dark">
                                        <tr>
                                        <th>Account</th>
                                        <td>Get emails about the status of your account, eg. expiring or expired PLI</td>
                                        <td>
                                            <label class="switch">
                                            <input type="hidden" name="notifications[account]" value="off">
                                            <input type="checkbox" name="notifications[account]" data-toggle="toggle" {{ $settings['notifications']['account'] == 'on' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                            </label>
                                        </td>
                                        </tr>
                                        <tr>
                                        <th>MOT</th>
                                        <td>Get emails regarding your droid MOT status, eg. expiring or expired</td>
                                        <td>
                                            <label class="switch">
                                            <input type="hidden" name="notifications[mot]" value="off">
                                            <input type="checkbox" name="notifications[mot]" data-toggle="toggle" {{ $settings['notifications']['mot'] == 'on' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                            </label>
                                        </td>
                                        </tr>
                                        <tr>
                                        <th>Events</th>
                                        <td>Get emails about new events, and updates/reminders about events you are subscribed to</td>
                                        <td>
                                            <label class="switch">
                                            <input type="hidden" name="notifications[event]" value="off">
                                            <input type="checkbox" name="notifications[event]" data-toggle="toggle" {{ $settings['notifications']['event'] == 'on' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                            </label>
                                        </td>
                                        </tr>
                                        <tr>
                                        <th>Achievements</th>
                                        <td>Get emails when you have been granted a new achievement</td>
                                        <td>
                                            <label class="switch">
                                            <input type="hidden" name="notifications[achievement]" value="off">
                                            <input type="checkbox" name="notifications[achievement]" data-toggle="toggle" {{ $settings['notifications']['achievement'] == 'on' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                            </label>
                                        </td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                            <div class="card-header">
                                Event Requirements
                            </div>
                            <div class="card-body">
                                Requirements for getting notifications about new events added
                                <div class="table-responsive">
                                <table class="table text-center table-striped table-sm table-hover table-dark">
                                    <tr>
                                    <th>Distance</th>
                                    <td>Max distance from the postcode in your user profile (miles)</td>
                                    <td>
                                        <input type="text" name="max_event_distance" value="{{ $settings['max_event_distance'] }}">
                                    </td>
                                </table>
                                </div>
                            </div>
                            </div>
                            <input type="submit" class="btn btn-mot">
                        </div>
                        </div>
                    </div>
                    </div> --}}

                    <div class="mb-3 row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <form method="POST" action="{{ route('admin.users.profile.update', $user->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') ? old('email') : $user->email }}"
                                        autocomplete="email" required>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- First Name -->
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="string" class="form-control @error('fname') is-invalid @enderror"
                                        name="fname" id="fname" placeholder="First Name" value="{{ $user->fname }}"
                                        required />
                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="string" class="form-control @error('lname') is-invalid @enderror"
                                        name="lname" id="lname" placeholder="Last Name" value="{{ $user->lname }}"
                                        required />
                                    @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="uname">User Name</label>
                                    <input type="string" class="form-control @error('uname') is-invalid @enderror"
                                        name="uname" id="uname" placeholder="User Name"
                                        value="{{ old('uname') ? old('uname') : $user->uname }}" required />
                                    @error('uname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="bioTextArea">Short Bio</label>
                                    <textarea class="form-control" id="bioTextArea" rows="3"
                                        name="bio">{{ $user->profile->bio }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="location">Location (optional)</label>
                                    <input type="string" class="form-control" id="location" name="location"
                                        placeholder="Alderaan" value="{{ $user->profile->location }}" />
                                </div>

                                <div class="form-group">
                                    <label for="homepage_url">Homepage (optional)</label>
                                    <input type="string" class="form-control" id="homepage_url" name="homepage"
                                        placeholder="Homepage URL" value="{{ $user->profile->homepage }}" />
                                </div>

                                <div class="form-group">
                                    <label for="facebook_url">Facebook (optional)</label>
                                    <input type="string" class="form-control" id="facebook_url" name="facebook"
                                        placeholder="Facebook" value="{{ $user->profile->facebook }}" />
                                </div>

                                <div class="form-group">
                                    <label for="instagram">Instagram (optional)</label>
                                    <input type="string" class="form-control" id="website" name="instagram"
                                        placeholder="Instagram" value="{{ $user->profile->instagram }}" />
                                </div>

                                <div class="form-group">
                                    <label for="github">GitHub (optional)</label>
                                    <input type="string" class="form-control" id="github" name="github" placeholder="GitHub"
                                        value="{{ $user->profile->github }}" />
                                </div>

                                <div class="form-group">
                                    <label for="activity">Last Activity:</label>
                                    <input type="datetime" class="form-control" id="last_activity" name="last_activity" disabled placeholder="{{ $user->last_activity }}"/>
                                </div>

                                <div class="form-group d-flex">
                                    <span class="flex-spacer"></span>
                                    <a href="{{ route('droid.user.index') }}" class="mr-3 btn btn-secondary">Cancel</a>
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
