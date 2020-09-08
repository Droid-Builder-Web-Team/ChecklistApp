
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Search Product
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control typeahead" data-provide="typeahead"placeholder="search..">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    var path = "{{ route('droids.autocomplete') }}";
    $('input.typeahead').typeahead({
        source: function (query, process) {
            return $.get(path, {query: query }, function (data){
                return process(data);
            });
        }
    });
</script>
