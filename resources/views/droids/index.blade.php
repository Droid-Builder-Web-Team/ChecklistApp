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
                    <form id="searchForm" class="mb-3 text-center" style="width:100%">
                        <div class="input-group input-group-lg mb-3 input-group-search">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                            <input type="text" id="search" class="form-control typeahead" placeholder="Search..." aria-label="Search" aria-describedby="Search" autocomplete="off">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary border-left-0 border" type="button" onclick="doClearSearch()">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
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
        $('#search.typeahead').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            },
            updater: function(item) {
                searchForDroid(item);
                return item;
            }
        });

        // Capture the search form submit and add the query param
        $("#searchForm").submit(function(e) {
            e.preventDefault();
            var form = this;
            var search = $("#search").val();
            searchForDroid(search);
        });

        function searchForDroid(droid) {
            if (!droid || droid.trim() === "") {
                window.location = window.location.href.split('?')[0];
            } else {
                window.location.search = "?search=" + droid;
            }
        }

        function doClearSearch() {
            $("#search").val(null);
            window.location = window.location.href.split('?')[0];
        }

        // Set the search query
        var search = getQueryParam('search');
        if (search) {
            search = search.replace(/%20/g, " ");
        }
        $("#search").val(search);

        function getQueryParam(param, defaultValue = undefined) {
            location.search.substr(1)
                .split("&")
                .some(function(item) { // returns first occurence and stops
                    return item.split("=")[0] == param && (defaultValue = item.split("=")[1], true)
                })
            return defaultValue
        }

    </script>
@endpush
