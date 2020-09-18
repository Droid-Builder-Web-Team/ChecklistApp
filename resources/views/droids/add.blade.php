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
            <form action="{{ route('droids.index.store') }}" method="POST" enctype="multipart/form-data" id="upload_image_form">
                @csrf
                @if(session('errors'))
                    @foreach($errors as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                @endif
                @if(session('success'))
                    {{ session('success') }}
                @endif
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="class">Droid Class & Version</label>
                            <input type="text" class="form-control" name="class"  data-toggle="tooltip" data-placement="top" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Droid Description</label>
                            <select class="form-control" name="description">
                                <option value="Full Droid">Full Droid</option>
                                <option value="Dome Only">Dome Only</option>
                                <option value="Body Only">Body Only</option>
                                <option value="Work In Progress">Work In Progress</option>
                                <option value="Microdroid">Microdroid</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group d-flex flex-column">
                                <label for="image">Droid Image</label>
                                <input type="file" name="image" id="image" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" required>
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
                                <input type="file" name="partslist" id="partslist"class="form-control {{ $errors->has('file') ? ' is-invalid' : '' }}" required>
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
            <img id="image_preview_container" src="{{ asset('/images/no-image.png') }}" alt="Preview Image" class="img-fluid">
        </div>
    </div>
</div>
@push('scripts')
{{-- <script>
    $(document).ready(function (e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#image').change(function(){

            let reader = new FileReader();
            reader.onload = (e) => {
              $('#image_preview_container').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);

        });

        $('#upload_image_form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: "{{ route('droids.index.store')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    alert('Image has been uploaded successfully');
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    });
</script> --}}
@endpush
@endsection
