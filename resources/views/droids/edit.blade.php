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

                            <div class="mb-3 input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="DroidClass">Droid Class</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Class" value="{{ $droid->class }}" name="class" required>
                            </div>

                            <div class="mb-3 input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="DroidDescription">Droid Description</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Description" value="{{ $droid->description }}" name="description" required>
                            </div>

                            <div class="mb-3 input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Parts CSV</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="partslist" id="partslist" value="{{ old('partslist') }}" class="form-control{{ $errors->has('partslist') ? ' is-invalid' : '' }}" accept=".csv">
                                    @if ($errors->has('file'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                    <label class="custom-file-label" for="partslist">Choose file</label>
                                </div>
                            </div>

                            <div class="mb-4 input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="DroidImage">Droid Image</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="form-control" placeholder="Choose file" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 text-center col-md-12">
                                    <img id="image-preview" src="{{ $droid->image }}" style="height:300px;">
                                </div>
                            </div>

                            {{-- Droid Instruction --}}
                            <div class="col-md-12">
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

                            <!-- Save -->
                            <div class="row">
                                <div class="text-center col-md-12">
                                    <button type="submit" class="btn btn-baddeley">Update</button>
                                </div>
                            </div>

                            @if (Session::has('success'))
                                <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
                                    {{  Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="mt-4 alert alert-danger alert-dismissible fade show" role="alert">
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

        function readURL(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#image-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function()
        {
            readURL(this);
        });

        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
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
