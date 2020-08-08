@extends('layouts.app')
<style type="text/css">
.profile-image{
    width:150px;
}
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row" id="profileSection">
                <div class="col-md-3">
                    <div class="profilePicture">
                    {{-- Profile Image --}}
                    <img src="{{ $user->avatar }}" alt="Profile_Picture" class="profile-image rounded-circle p-1">

                    </div>
                </div>
                <div class="col-md-9">
                    {{-- Username --}}
                    <h3>{{ Auth::user()->name }}</h3>
                   {{ $user->avatar }}
                    <hr>
                    {{-- Content --}}
                    <p>Current Droid Builders</p>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.title = `{{ $user->name }}'s Profile`;
</script>
@endsection
