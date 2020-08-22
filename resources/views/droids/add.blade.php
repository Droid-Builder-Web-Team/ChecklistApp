@extends('layouts.app')
@section('content')

<h3 class="text-center">Add New Droid</h3>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-6" id="addDroid">
            <form action="{{ route('droids.index.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="class">Droid Class & Version</label>
                            <input type="text" class="form-control" name="class"  data-toggle="tooltip" data-placement="top">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Droid Description</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group d-flex flex-column">
                                <label for="image">Droid Image</label>
                                <input type="file" name="image" id="image" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" >
                                @if ($errors->has('file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group d-flex flex-column">
                                <label for="partslist">Parts CSV</label>
                                <input type="file" name="partslist" id = "partslist"class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" >
                                @if ($errors->has('file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">Add Droid</button>
                    </div>
            </form>
        </div>
        <div class="col-md-6" id="addDroid">

        </div>
    </div>
</div>

@endsection


<script>

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});


</script>
