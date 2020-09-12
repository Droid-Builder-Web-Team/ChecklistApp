@extends('layouts.app')

@section('content')
<div class="container">
    <div class="heading text-center">
        <h1 class="heading">Droid Mainframe</h1>
        <span class="subHeading">Please select your droid below</span>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="filterBar">
                <h3 class="sub-heading text-center mt-2">Refine your mainframe request</h3>
                <form>
                    <input id="search" name="search" class="typeahead form-control" type="text" placeholder="Search..." data-provide="typeahead" autocomplete="off">
                </form>
                {{-- <form action= "{{ route('droids.index.index') }}" class="filters">
                    <div class="input-group form-group mb-3">
                        <span class="d-inline-block"  tabindex="0" data-toggle="tooltip" data-placement="top" title="Patience Young Builder, Coming Soon">
                        <select class="custom-select" disabled id="inputGroupSelect02">
                            <option selected>Choose...</option>
                            <option value="1">R2</option>
                            <option value="2">Micro Droids</option>
                            <option value="3">R7</option>
                            <option value="3">R9</option>
                            <option value="3">Chopper</option>
                            <option value="3">D-O</option>
                        </select>
                        </span>
                    </div>

                    <div class="input-group form-group mb-3">
                        <input type="text" name="q" id="q" class="form-control" placeholder="Search for a Droid" aria-label="Search for a Droid" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-baddeley" type="submit">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </form> --}}
            </div>
        </div>
    </div>
    <form action="{{ route('droid.user.store') }}" method="POST">
        @csrf
        <div class="row mt-3" id="droidmainframe">
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
                        @elseif($droid->description == "Microdroid")
                            <h3 class="text-center">{{ $droid->class }}</h3>
                            <p class="text-center">{{ $droid->description }}</p>
                            <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}" name="droidIdentification">Build This Microdroid</button>
                        @elseif($droid->description == 'Your Custom Droid')
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
</div>
@push('script')
    <script defer>
        var path = "{{ route('droids.autocomplete') }}";
        $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
@endpush
@endsection


