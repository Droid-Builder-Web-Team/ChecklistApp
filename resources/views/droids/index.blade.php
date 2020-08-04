@extends('layouts.app')

@section('content')
    <div class="heading text-center">
        <h1 class="heading">Droid Mainframe</h1>
        <span>Please select your droid below</span>
    </div>

    <form action="{{ route('droid.user.store') }}" method="POST">
        @csrf
        <div class="row mt-5" id="droidmainframe">
            @foreach($droids as $droid)
            <div class="col-md-3 mb-5">
                <div class="droids">
                    <div class="head">
                        <h1 class="text-center"><img src="{{ $droid->image }}" style="height:10vh;" class="img-fluid"></h1>
                    </div>
                    <div class="body" id="body">
                        @if($droid->description == "Full Droid")
                        <h3 class="text-center">{{ $droid->class }}</h3>
                        <p class="text-center">{{ $droid->description }}</p>
                        <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}" name="droidIdentification">Build This Droid</button>
                        @elseif($droid->description == "Dome Only")
                        <h3 class="text-center">{{ $droid->class }}</h3>
                        <p class="text-center">{{ $droid->description }}</p>
                        <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}" name="droidIdentification">Build This Dome</button>
                        @elseif($droid->description == "Body Only")
                        <h3 class="text-center">{{ $droid->class }}</h3>
                        <p class="text-center">{{ $droid->description }}</p>
                        <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}" name="droidIdentification">Build This Body</button>
                        @elseif($droid->description == "WIP")
                        <h3 class="text-center">{{ $droid->class }}</h3>
                        <p class="text-center">{{ $droid->description }}</p>
                        <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}" name="droidIdentification">Test This Droid</button>
                        @elseif($droid->description == 'Your custom droid')
                        <h3 class="text-center">{{ $droid->class }}</h3>
                        <p class="text-center">{{ $droid->description }}</p>
                        <a href="{{ route('droid.user.create') }}"class="btn btn-block btn-baddeley" value="{{ $droid->id }}" name="droidIdentification">Build a Custom Droid</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        </form>
    <hr>
    <div class="col-md-12">
    @can('add-droids')
        <div class="droid text-center">
            <div class="heading">
                <h1>Add a new droid</h1>
                <p clas="lead">You can add a new droid using the button below.</p>
            </div>
            <a href="{{ route('droids.index.create') }}" class="btn btn-primary">Add Droid</a>
        </div>
    </div>
    @endcan
@endsection
