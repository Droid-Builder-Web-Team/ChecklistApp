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
                <div class="col-md-2">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                 @if(Auth::user()->avatar)
                 {{-- <img src="{{ $user->avatar }}" alt="Profile_Picture" class="profile-image rounded-circle p-1"> --}}
                 <img src="/img/share.png" alt="Profile_Picture" class="profile-image rounded-circle p-1">
                 @else
                 <img src="/img/no-image.png" class="rounded" alt="hello" width="208px">
                 @endif
                </div>
                <div class="col-md-8">
                 <h2 class="sub-title mt-3">Welcome - {{ ucwords(Auth::user()->name) }}</h2>
                 <img src="https://graph.facebook.com/v3.3/831417183929123/picture?type=normal">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.title = `{{ $user->name }}'s Profile`;
</script>
@endsection
