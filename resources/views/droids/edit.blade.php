@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Droid: {{ $droid->class }}</div>

                    <div class="card-body">
                        <form action="{{ route('droids.index.update', $droid) }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            {{ method_field('PUT') }}

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="DroidClass">Droid Class</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Class" value="{{ $droid->class }}" name="class" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="DroidDescription">Droid Description</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Description" value="{{ $droid->description }}" name="description" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Parts CSV</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="partslist" id="partslist" value="{{ old('partslist') }}" class="form-control{{ $errors->has('partslist') ? ' is-invalid' : '' }}" accept=".csv" required>
                                    @if ($errors->has('file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                    <label class="custom-file-label" for="partslist">Choose file</label>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="DroidImage">Droid Image</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="form-control" placeholder="Choose file" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    {{ json_encode($droid) }}
                                    <img src="{{ $droid->image }}">
                                </div>
                            </div>

                            <!-- Save -->
                            <div class="row">
                                <div class="col-md-10 text-center">
                                    <button type="submit" class="btn btn-baddeley">Update</button>
                                </div>
                            </div>

                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                    {{  Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                                    {{  Session::get('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endpush
