@extends('layouts.app')

<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')
<div class="container">
    <div class="heading">
        @if($droidDetails->droid_designation == NULL)
            <h1 class="title text-center">Editing Droid: {{ $currentBuild->class }} </h1>
        @else
            <h1 class="title text-center">Editing Droid: {{ $droidDetails->droid_designation }} </h1>
        @endif

        <checklist-progress :completed="{{ $partsPrinted }}" :parts="{{ $partsNum }}" :id="{{ $droidDetails->id }}"></checklist-progress>
    </div>
    {{-- <div class="row mt-3">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <span class="d-inline-block"  tabindex="0" data-toggle="tooltip" data-placement="top" title="Patience Young Builder, Coming Soon">
                        <a class="nav-link disabled" href="#">Instructions</a>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="d-inline-block"  tabindex="0" data-toggle="tooltip" data-placement="top" title="Patience Young Builder, Coming Soon">
                        <a class="nav-link disabled" href="#">Bill of Materials</a>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="d-inline-block"  tabindex="0" data-toggle="tooltip" data-placement="top" title="Patience Young Builder, Coming Soon">
                        <a class="nav-link disabled" href="#">Wiki</a>
                    </span>
                </li>
                <li class="nav-item">
                    <span class="d-inline-block"  tabindex="0" data-toggle="tooltip" data-placement="top" title="Patience Young Builder, Coming Soon">
                        <a class="nav-link disabled" href="#">Notes</a>
                    </span>
                </li>
            </ul>
        </div>
    </div> --}}
    <div class="row mt-3" id="edit-panel">
        <div class="col-md-6 order-md-12">
            <checklist droid="{{ json_encode($currentBuild) }}" sections="{{ json_encode($sections) }}" :id="{{ $droidDetails->id }}"></checklist>
        </div>

        <div class="col-md-6 order-md-1">
            <form action="{{ route('droid.user.update', $droidDetails->id ) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <h2 class="sub sub-title text-center">Droid Information</h2>
                <p class="sub sub-text">You can enter handy build information about your droid below.</p>
                <div class="wrapper">
                    <div class="form-group mt-4" id="edit">
                        <label for="droid_designation">Droid Designation:</label>
                        <input type="text" id="droid_designation" name="droid_designation" value="{{ $droidDetails->droid_designation }}" placeholder="Example: Y1-P4">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="builder_name">Builder Name:</label>
                        <input type="text" id="builder_name" name="builder_name" value="{{ $droidDetails->builder_name }}" placeholder="Example: George Lucas">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="description">Description:</label>
                        <input type="text" id="description" name="description" value="{{ $droidDetails->description }}" rows="3" placeholder="Example: A Pilot Droid"></textarea>
                    </div>
                    {{-- <div class="form-group "id="edit">
                        <label for="droid_version">Droid Version:</label>
                        <input type="text" id="droid_version" name="droid_version" value="{{ $droidDetails->droid_version }}" rows="3"></textarea>
                    </div> --}}
                    <div class="form-group" id="edit">
                        <label for="colors">Colors:</label>
                        <input type="text" id="colors" name="colors" value="{{ $droidDetails->colors }}" placeholder="Example: Red, White, Blue">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="mobility">Mobility:</label>
                        <input type="text" id="mobility" name="mobility" value="{{ $droidDetails->mobility }}" placeholder="Example: Feet & Dome Motors">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="electronics">Electronics:</label>
                        <input type="text" id="electronics" name="electronics" value="{{ $droidDetails->electronics }}" placeholder="Example: Lights and Sounds">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="control_system">Control System:</label>
                        <input type="text" id="control_system" name="control_system" value="{{ $droidDetails->control_system }}" placeholder="Example: Padawan360">                  </div>
                    <div class="form-group" id="edit">
                        <label for="drive_system">Drive System:</label>
                        <input type="text" id="drive_system" name="drive_system" value="{{ $droidDetails->drive_system }}" placeholder="Example: Chain Drive">
                    </div>
                    <div class="form-group" id="edit">
                        <label for="power">Power:</label>
                        <input type="text" id="power" name="power" value="{{ $droidDetails->power }}" placeholder="Example: x2 12V SLA Batteries">
                        <input type="hidden" id="droidDetailInput" name="droidDetailInput" value="{{ $droidDetails->droid_user_id }}">
                    </div>

                    <button type="submit" class="btn btn-submitButton mb-5">Update Archives</button>

                </div>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function test() {
        console.log("test");
    }
</script>
@endpush
