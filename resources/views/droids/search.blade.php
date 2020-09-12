
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
                            <input id="search" name="search" class="typeahead form-control" type="text" placeholder="Search...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    var route = "{{ url('autocomplete') }}";
    $('#search').typeahead({
            source: function(term, process) {
            return $.get(route, {term:term}, function (data){
                return process(data);
            });
        }
    });
</script>
