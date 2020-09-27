@extends('layouts.app')
@section('content')

<h3 class="text-center">Add New Droid</h3>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif

<div class="container">

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

    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

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
                            <input type="text" class="form-control" name="class" value="{{ old('class') }}" data-toggle="tooltip" data-placement="top" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Droid Description</label>
                            <select class="form-control" name="description" value="{{ old('description') }}" >
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
                            <div class="custom-file">
                                <input type="file" name="image" id="image" value="{{ old('image') }}" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" accept=".gif,.jpg,.jpeg,.png,.svg" required>
                                <label class="custom-file-label" for="image">Choose image...</label>
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group d-flex flex-column">
                                <label for="partslist">Parts CSV</label>
                                <div class="custom-file">
                                    <input type="file" name="partslist" id="partslist" value="{{ old('partslist') }}" class="form-control{{ $errors->has('partslist') ? ' is-invalid' : '' }}" accept=".csv" required>
                                    <label class="custom-file-label" for="partslist">Choose parst CSV file...</label>
                                    @if ($errors->has('partslist'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('partslist') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
@endsection

@push('scripts')
<script>
    // Display the droid image file name
    $('#image').on('change', function(event)
    {
        // Display the filename
        let file = event.target.files[0]
        $(this).next('.custom-file-label').html(file.name);

        // Display the image
        var reader = new FileReader();
        reader.onload = function (e)
        {
            console.log("sefef");
            $("#image_preview_container").attr('src', e.target.result);
            console.log($("#image_preview_container"));
        }
        reader.readAsDataURL(event.target.files[0]);
    });

    // Display the CSV parts list file name
    $('#partslist').on('change', function(e)
    {
        console.log(e);
        let filename = e.target.files[0].name;
        $(this).next('.custom-file-label').html(filename);
    });
</script>
@endpush
<script>
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
</script>

