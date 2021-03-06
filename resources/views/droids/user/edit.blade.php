@extends('layouts.app')

<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')
<div class="container">
    <div class="heading">

        @if($droidDetails->droid_designation == NULL)
            <h1 class="text-center title">Editing Droid: {{ $currentBuild->class }} </h1>
        @else
            <h1 class="text-center title">Editing Droid: {{ $droidDetails->droid_designation }} </h1>
        @endif

        <checklist-progress :completed="{{ $partsPrinted }}" :parts="{{ $partsNum }}" :id="{{ $droidDetails->id }}"></checklist-progress>
    </div>
    <div class="mt-3 row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                    {{-- Checklist --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="checklist-tab" data-toggle="tab" href="#checklist" role="tab" aria-controls="home" aria-selected="true">Checklist</a>
                </li>
                    {{-- Materials --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="materials-tab" data-toggle="tab" href="#materials" role="tab" aria-controls="profile" aria-selected="false">Bill of Materials</a>
                </li>
                    {{-- Instructions --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="instructions-tab" data-toggle="tab" href="#instructions" role="tab" aria-controls="contact" aria-selected="false">Instructions</a>
                </li>
                    {{-- Notes --}}
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="contact" aria-selected="false">Notes</a>
                </li>

              </ul>

              <div class="tab-content" id="myTabContent">
                  {{-- Checklist --}}
                <div class="tab-pane fade show active" id="checklist" role="tabpanel" aria-labelledby="checklist-tab">
                    <div class="mt-3 row" id="edit-panel">
                        <div class="col-md-6 order-md-12">
                            <checklist droid="{{ json_encode($currentBuild) }}" sections="{{ json_encode($sections) }}" :id="{{ $droidDetails->id }}"></checklist>
                        </div>
                
                        <div class="pb-3 col-md-6 order-md-1">
                            <form action="{{ route('droid.user.update', $droidDetails->id ) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                <h2 class="text-center sub sub-title">Droid Information</h2>
                                <p class="sub sub-text">You can enter handy build information about your droid below.</p>
                                <div class="wrapper">
                
                                    <div class="form-group edit" >
                                        <label for="droid_designation">Droid Designation:</label>
                                        <input type="text" id="droid_designation" name="droid_designation" value="{{ $droidDetails->droid_designation }}" placeholder="Example: Y1-P4">
                                    </div>
                
                                    <div class="form-group edit" >
                                        <label for="builder_name">Builder Name:</label>
                                        <input type="text" id="builder_name" name="builder_name" value="{{ $droidDetails->builder_name }}" placeholder="Example: George Lucas">
                                    </div>
                
                                    <div class="form-group edit" >
                                        <label for="description">Description:</label>
                                        <input type="text" id="description" name="description" value="{{ $droidDetails->description }}" rows="3" placeholder="Example: A Pilot Droid"></textarea>
                                    </div>
                
                                    <div class="form-group edit" >
                                        <label for="colors">Colors:</label>
                                        <input type="text" id="colors" name="colors" value="{{ $droidDetails->colors }}" placeholder="Example: Red, White, Blue">
                                    </div>
                
                                    <div class="form-group edit" >
                                        <label for="mobility">Mobility:</label>
                                        <input type="text" id="mobility" name="mobility" value="{{ $droidDetails->mobility }}" placeholder="Example: Feet & Dome Motors">
                                    </div>
                
                                    <div class="form-group edit" >
                                        <label for="electronics">Electronics:</label>
                                        <input type="text" id="electronics" name="electronics" value="{{ $droidDetails->electronics }}" placeholder="Example: Lights and Sounds">
                                    </div>
                
                                    <div class="form-group edit" >
                                        <label for="control_system">Control System:</label>
                                        <input type="text" id="control_system" name="control_system" value="{{ $droidDetails->control_system }}" placeholder="Example: Padawan360">
                                    </div>
                
                                    <div class="form-group edit" >
                                        <label for="drive_system">Drive System:</label>
                                        <input type="text" id="drive_system" name="drive_system" value="{{ $droidDetails->drive_system }}" placeholder="Example: Chain Drive">
                                    </div>
                
                                    <div class="form-group edit" >
                                        <label for="power">Power:</label>
                                        <input type="text" id="power" name="power" value="{{ $droidDetails->power }}" placeholder="Example: x2 12V SLA Batteries">
                                    </div>
                
                                    <div class="form-group edit" >
                                        <label for="power">Image:<br>
                                            <span style="font-size:.75rem;">File Size Limit 2MB</span>
                                        </label>
                                        <input type="file" id="imagePicker" name="imagePicker" class="droid-details-input" accept=".gif,.jpg,.jpeg,.png,.svg">
                                        <input type="hidden" id="image" name="image" value="{{ $droidDetails->image }}">
                                    </div>
                
                                    <div class="droid-details-image-preview">
                                        <img src="{{ $droidDetails->image }}" id="image-preview">
                                        <button type="button" id="btn-remove-image" class="btn btn-secondary" onclick="removeImage()">Remove</button>
                                    </div>
                
                                    <div class="text-center col">
                                        <button type="submit" class="mb-5 btn btn-submitButton">Update Archives</button>
                                    </div>
                
                                </div>
                            </form>
                        </div>
                
                    </div>
                
                </div>

                {{-- Materials --}}
                <div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="materials-tab">
                        <h3 class="text-center text-light">
                            R2, that stabilizers broken loose again, see if you can't lock it down!
                            <br><br>
                            Nothing exists here yet...sorry about that!
                        </h3>                
                </div>

                {{-- Instructions --}}
                <div class="tab-pane fade text-center" id="instructions" role="tabpanel" aria-labelledby="instructions-tab">
                    @forelse($droidInstructions as $instruction)
                            <a style="font-size: 1.5rem;" class="btn btn-link" href="{{ $instruction->instruction_url }}">{{ $instruction->instruction_label }}</a>
                    @empty
                        <h3 class="text-center text-light">
                            R2, that stabilizers broken loose again, see if you can't lock it down!
                            <br><br>
                            Nothing exists here yet...sorry about that!
                        </h3>
                    @endforelse
                </div>

                {{-- Notes --}}
                <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                    <div class="form-group">
                    <h3 class="text-center text-light">Using this section you can write notes, logs and even reminders for your build. Once you are done you can export these logs to PDF or Word for adding into any external build logs.</h3>
                    <form method="post" action="{{ route('droid.user.update', $droidDetails->id ) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                          <textarea class="form-control editor" cols="30" rows="10" id="editor" name="notes" placeholder="Enter notes about your build here...">{{ $droidDetails->notes }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                    </div>
                </div>
              </div>
              
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Handle hiding/showing the remove button when the page loads
    (function() {
        if ($("#image").val())
        {
            $("#btn-remove-image").show();
        }
        else
        {
            $("#btn-remove-image").hide();
        }
    })();

    function removeImage()
    {
        $("#image").val(null);
        $("#imagePicker").val(null);
        $("#image-preview").hide();
        $("#btn-remove-image").hide();
    }

    // Display the droid image file name
    $('#imagePicker').on('change', function(event)
    {
        // Show the image preview and the "remove" button
        $("#image-preview").show();
        $("#btn-remove-image").show();

        // Display the image
        var reader = new FileReader();
        reader.onload = function (e)
        {
            $("#image-preview").attr('src', e.target.result);
        }
        reader.readAsDataURL(event.target.files[0]);
    });

    
    // ClassicEditor
    // .create( document.querySelector( '#editor' ) )
    // .catch( error => {
    //     console.error( error );
    // } );
</script>
<script src="{{ asset('ckeditor/build/ckeditor.js') }}"></script>
<script>
    ClassicEditor
			.create( document.querySelector( '.editor' ), {
				
				toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo',
						'exportPdf',
						'exportWord',
						'todoList',
						'fontColor',
						'fontSize'
					]
				},
				language: 'en',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side',
						'linkImage'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				
			} )
			.then( editor => {
				window.editor = editor;
		
				
				
				
		
				
				
				
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: b9uv5259wa1h-y6f7vvvg2hee' );
				console.error( error );
			} );
</script>
@endpush
