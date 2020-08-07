@extends('layouts.app')

<script>
function unTick()
    {
        alert("You are working backwards? Not implemented yet");
    }
</script>

@section('content')
    @foreach($currentBuilds as $currentBuild)
    <div class="heading">
        <h1 class="title text-center">Editing Droid: {{ $currentBuild->class }} </h1>


        <div class="tracking">
            <p class="text-center">Progress: {{ $percentComplete}}%</p>
        </div>
        <p class="lead text-center" style="color:white;">Build {{ $partsPrinted }} of  {{ $partsNum }}</p>
    </div>
    @endforeach
    <div class="row mt-3" id="edit-panel">
        <div class="col-md-6 mt-5 mb-5" id="split-panel">
            @foreach($droidDetails as $droidDetail)
            <form action="{{ route('droid.user.update', $droidDetail->droid_user_id ) }}" method="POST" >
                @csrf
                {{ method_field('PUT') }}
                <h2 class="sub sub-title text-center">Droid Information</h2>
                <p class="sub sub-text">Keep the information about your droid up to date.</p>
                <div class="wrapper">
                    <div class="form-group mt-4" id="edit">
                        <label for="droid_designation">Droid Designation:</label>
                        <input type="text" id="droid_designation" name="droid_designation" value="{{ $droidDetail->droid_designation }}" placeholder="Example: Y1-P4">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="builder_name">Builder Name:</label>
                        <input type="text" id="builder_name" name="builder_name" value="{{ $droidDetail->builder_name }}" placeholder="Your Name">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="description">Description:</label>
                        <input type="text" id="description" name="description" value="{{ $droidDetail->description }}" rows="3" placeholder="Example: A Pilot Droid"></textarea>
                    </div>
                    {{-- <div class="form-group "id="edit">
                        <label for="droid_version">Droid Version:</label>
                        <input type="text" id="droid_version" name="droid_version" value="{{ $droidDetail->droid_version }}" rows="3"></textarea>
                    </div> --}}
                    <div class="form-group" id="edit">
                        <label for="colors">Colors:</label>
                        <input type="text" id="colors" name="colors" value="{{ $droidDetail->colors }}" placeholder="Example: Red, White, Blue">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="mobility">Mobility:</label>
                        <input type="text" id="mobility" name="mobility" value="{{ $droidDetail->mobility }}" placeholder="Example: Feet & Dome Motors">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="electronics">Electronics:</label>
                        <input type="text" id="electronics" name="electronics" value="{{ $droidDetail->electronics }}" placeholder="Example: Lights and Sounds">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="control_system">Control System:</label>
                        <input type="text" id="control_system" name="control_system" value="{{ $droidDetail->control_system }}">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="drive_system">Drive System:</label>
                        <input type="text" id="drive_system" name="drive_system" value="{{ $droidDetail->drive_system }}">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="power">Power:</label>
                        <input type="text" id="power" name="power" value="{{ $droidDetail->power }}">
                        <input type="hidden" id="droidDetailInput" name="droidDetailInput" value="{{ $droidDetail->droid_user_id }}">
                    </div>

                    <button type="submit" class="btn btn-submitButton mb-5">Update Archives</button>

                </div>
                @endforeach
            </form>
        </div>

        <div class="col-md-6 mt-5 mb-5">
            <div class="checklist">

                <?php
                    $section = '';
                    $sub_section = '';
                    $bad_chars = array(" ", "&");
                    $sub_chars = array("-", "and");
                ?>
                <div class="panel-group" id="accordion">
                    <h2 class="sub sub-title text-center">Checklist</h2>
                    <p class="sub sub-text">Tick off the parts you have printed, place a tick in the N/A box to exclude that part.</p>
                    <form action="{{ route('droid.updatePart') }}" method="post">
                        @csrf
                        @foreach($partsList as $versionPart)         <!-- changed to partList -->
							{{-- Closers --}}
							@if($versionPart->sub_section != $sub_section)
								@if($sub_section != '')
									</table>
								</div>
								@endif
							@endif
							@if($versionPart->droid_section != $section)
								@if($section != '')
								</div>
								@endif
							@endif

							{{-- Sections --}}
							@if($versionPart->droid_section != $section)
								<?php
									$section = $versionPart->droid_section;
									$section_id = str_replace($bad_chars, $sub_chars, $section);
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a id="partHeading" data-toggle="collapse" data-parent="#accordion" href="#{{ $section_id }}">
												<span class="glyphicon glyphicon-folder-close"></span>{{ $versionPart->droid_section }} - {{ $versionPart->droid_version }}
											</a>
										</h4>
									</div>
								</div>
								<div id="{{ $section_id }}" class="panel-collapse collapse in">
							@endif
							{{-- Sub-Section --}}
							@if($versionPart->sub_section != $sub_section)
								<?php
									$sub_section = $versionPart->sub_section;
									$sub_section_id = str_replace($bad_chars, $sub_chars, $sub_section);
								?>
								<div class="panel panel-default">
									<h2 class="sub-title">
										<a id="partHeading" data-toggle="collapse" data-parent="#accordion" href="#{{ $sub_section_id }}">
											<span class="glyphicon glyphicon-folder-close"></span>{{ $versionPart->sub_section }}
										</a>
									</h2>
								</div>
								<div id="{{ $sub_section_id }}" class="panel-collapse collapse in">
									<table class="partsTable" border=1>
										<tr>
											<th style="text-align: left">Part Name</th>
											<th style="width: 20%">Complete</th>
											<th style="width: 20%">N/A</th>
										</tr>
							@endif
							{{-- Parts-Section --}}
										<tr>
											<td style="text-align: left">
												<label class="form-check-label" for="{{ $versionPart->part_name }}">
													{{ $versionPart->part_name }}
												</label>
											</td>
											<td>
												<input type="checkbox" name="partid[]" value="{{ $versionPart->id}}"
												<?php
													if ($versionPart->completed == true)
													{
														echo "checked";
													}
												?>
												onchange="unTick()" >
											</td>
											<td>
                                                <input type="checkbox" name="na[]" value="{{ $versionPart->id}}"
                                                <?php
                                                if ($versionPart->NA == true)
													{
														echo "checked";
													}
                                                ?>
                                                >
											</td>
										</tr>
                        @endforeach
									</table>
								</div>
							</div>
                        <button type="submit" class="btn btn-submitButton">Submit Updates</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    $("#progressbar").

    
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});

</script>
