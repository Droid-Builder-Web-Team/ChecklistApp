@extends('layouts.app')
@section('content')

<h3 class="text-center">Add New Droid</h3>
@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<div class="container-fluid">

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach($errors->all() as $error)
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
        <div class="col-md-4" id="addDroid">
            <form action="{{ route('droids.index.store') }}" method="POST"
                enctype="multipart/form-data" id="upload_image_form">
                @csrf
                @if(session('errors'))
                    @foreach($errors as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                @endif
                @if(session('success'))
                    {{ session('success') }}
                @endif
                {{-- Droid Class and Version --}}
                <div class="col-md-12">
                    <div class="form-group d-flex flex-column">
                        <label for="class">Droid Class & Version</label>
                        <input type="text" class="form-control" name="class" placeholder="B0 V4"
                            value="{{ old('class') }}" data-toggle="tooltip" data-placement="top"
                            required>
                    </div>
                </div>
                {{-- Description --}}
                <div class="col-md-12">
                    <div class="form-group d-flex flex-column">
                        <label for="description">Droid Description</label>
                        <select class="form-control" name="description"
                            value="{{ old('description') }}">
                            <option value="Full Droid">Full Droid</option>
                            <option value="Dome Only">Dome Only</option>
                            <option value="Body Only">Body Only</option>
                            <option value="Work In Progress">Work In Progress</option>
                            <option value="Microdroid">Microdroid</option>
                        </select>
                    </div>
                </div>
                {{-- Droid Image Upload --}}
                <div class="col-md-12">
                    <div class="form-group d-flex flex-column">
                        <label for="image">Droid Image</label>
                        <div class="custom-file">
                            <input type="file" name="image" id="image" value="{{ old('image') }}"
                                class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                accept=".gif,.jpg,.jpeg,.png,.svg" required>
                            <label class="custom-file-label" for="image">Choose image...</label>
                            @if($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Droid CSV --}}
                <div class="col-md-12">
                    <div class="form-group d-flex flex-column">
                        <label for="partslist">Parts CSV</label>
                        <div class="custom-file">
                            <input type="file" name="partslist" id="partslist"
                                value="{{ old('partslist') }}"
                                class="form-control{{ $errors->has('partslist') ? ' is-invalid' : '' }}"
                                accept=".csv" required>
                            <label class="custom-file-label" for="partslist">Choose parst CSV file...</label>
                            @if($errors->has('partslist'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('partslist') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Droid Instruction --}}
                <div class="col-md-12">
                    <div class="form-group d-flex flex-column">
                        <label for="instructions">Droid Instructions</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Label</span>
                            </div>
                            <input type="text" placeholder="Enter Instructions Label" class="form-control"
                                name="instructions_label" id="instructions_label" value="">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">URL</span>
                            </div>
                            <input type="text" placeholder="Enter Instructions URL" class="form-control"
                                name="instructions_url" id="instructions_url" value="">
                        </div>

                        @if($errors->has('instructions_label'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('instructions_label') }}</strong>
                            </span>
                        @endif
                        @if($errors->has('instructions_url'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('instructions_url') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Add Droid</button>
                </div>
            </form>
        </div>

        {{-- Image Preview --}}
        <div class="col-md-4" id="addDroid">
            <div class="form-group d-flex flex-column">
                <label for="image_preview_container">Image Preview</label>
                <img id="image_preview_container" src="{{ asset('/images/no-image.png') }}"
                    alt="Preview Image" class="img-fluid">
            </div>
        </div>

        {{-- Instructions Table --}}
        <div class="col-md-4" id="addDroid">
            <div class="form-group d-flex flex-column">
                <label for="image_preview_container">Droid Instructions</label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamicTable">  

                        <tr>

                            <th>Part Label</th>

                            <th>URL</th>
                            
                            <th>Add More</th>

                        </tr>

                        <tr>  

                            <td><input type="text" name="addmore[0][instruction_label]" placeholder="Part Instructions Label" class="form-control" /></td>  
                            <td><input type="text" name="addmore[0][instruction_url]" placeholder="URL of the Instructions" class="form-control" /></td>  

                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  

                        </tr>  

                    </table>  
                </div>          
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
    <script>
        // Display the droid image file name
        $('#image').on('change', function (event) {
            // Display the filename
            let file = event.target.files[0]
            $(this).next('.custom-file-label').html(file.name);

            // Display the image
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#image_preview_container").attr('src', e.target.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        });

        // Display the CSV parts list file name
        $('#partslist').on('change', function (e) {
            let filename = e.target.files[0].name;
            $(this).next('.custom-file-label').html(filename);
        });

    </script>

    <script type="text/javascript">

   

    var i = 0;

       

    $("#add").click(function(){

   

        ++i;

   

        $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][instruction_label]" placeholder="Part Instructions Label" class="form-control" /></td><td><input type="text" name="addmore['+i+'][instruction_url]" placeholder="URL of the Instructions" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');

    });

   

    $(document).on('click', '.remove-tr', function(){  

         $(this).parents('tr').remove();

    });  

   

</script>

@endpush
