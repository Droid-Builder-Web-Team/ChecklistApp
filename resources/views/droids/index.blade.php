@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="heading text-center">
            <h1 class="heading p-3">Droid Mainframe</h1>

            <h3 class="subHeading p-3">Please select your droid below</h3>

        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="filterBar">
                    <h3 class="sub-heading text-center mt-2">Find your Droid</h3>
                    <form>
                        <div class="form-group has-search">
                            <span class="fas fa-search form-control-feedback"></span>
                            <input id="search" name="search"
                                class="typeahead form-control mb-3" type="text" placeholder="Search..."
                                data-provide="typeahead" autocomplete="off">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <form action="{{ route('droid.user.store') }}" method="POST">
            @csrf
            <div class="row mt-3" id="droidmainframe">
                @foreach ($droids as $droid)
                    <div class="col-md-3 mb-5">
                        <div class="droids">
                            <div class="head">
                                <h1 class="text-center"><img src="{{ $droid->image }}" style="height:10vh;"
                                        class="img-fluid"></h1>
                            </div>
                            <div class="body" id="body">
                                @if ($droid->description == 'Full Droid')
                                    <h3 class="text-center">{{ $droid->class }}</h3>
                                    <p class="text-center">{{ $droid->description }}</p>
                                    <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}"
                                        name="droidIdentification">Build This Droid</button>
                                @elseif($droid->description == "Dome Only")
                                    <h3 class="text-center">{{ $droid->class }}</h3>
                                    <p class="text-center">{{ $droid->description }}</p>
                                    <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}"
                                        name="droidIdentification">Build This Dome</button>
                                @elseif($droid->description == "Body Only")
                                    <h3 class="text-center">{{ $droid->class }}</h3>
                                    <p class="text-center">{{ $droid->description }}</p>
                                    <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}"
                                        name="droidIdentification">Build This Body</button>
                                @elseif($droid->description == "WIP")
                                    <h3 class="text-center">{{ $droid->class }}</h3>
                                    <p class="text-center">{{ $droid->description }}</p>
                                    <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}"
                                        name="droidIdentification">Test This Droid</button>
                                @elseif($droid->description == "Microdroid")
                                    <h3 class="text-center">{{ $droid->class }}</h3>
                                    <p class="text-center">{{ $droid->description }}</p>
                                    <button type="submit" class="btn btn-block btn-baddeley" value="{{ $droid->id }}"
                                        name="droidIdentification">Build This Microdroid</button>
                                @elseif($droid->description == 'Your Custom Droid')
                                    <h3 class="text-center">{{ $droid->class }}</h3>
                                    <p class="text-center">{{ $droid->description }}</p>
                                    <a href="{{ route('droid.user.create') }}" class="btn btn-block btn-baddeley"
                                        value="{{ $droid->id }}" name="droidIdentification">Build a Custom Droid</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>

@endsection

@push('scripts')
    <script>
        var route = "{{ route('droids.autocomplete') }}";
        $('input.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>
@endpush
