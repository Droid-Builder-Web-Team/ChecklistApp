@extends('layouts.app')

@section('content')
<h2>Droid Stuff</h2> 

<div class="text-center heading">
        <h1> Droid Builder - Image Uploader</h1>


        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif
  
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>I have a bad feeling about this...</strong> There was a disturbance in the force.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action = "{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <label for="imageuploader">Image Uploader - not much validation!</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>

        <button type="submit" class="mb-5 btn btn-submitButton">Submit</button>

        </form>
    </div>
@endsection

