@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="heading text-center">Custom Droid</h1>
    <p class="lead text-center">Click a section and select your individual sections below and create your custom droid.</p>
    <div class="row text-center">
        <div class="panel-group" id="accordion">

            <form action="{{ route('droid.assignCustomDroid') }}" method="POST">
            @csrf
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordionLink" data-toggle="collapse" data-parent="#accordion" href="#domes">
                                Dome Selection <i class="fas fa-chevron-down"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="domes" class="panel-collapse collapse in">
                        @foreach($domes as $dome)
                            <label>
                                <input type="radio" name="dome" id ="{{$dome->id}}"value="{{$dome->class}} {{$dome->version}}" >
                                <img src="{{$dome->image}}" class="img-fluid" alt="Tooltip" title="{{$dome->class}}:{{$dome->version}}" width = 180>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordionLink" data-toggle="collapse" data-parent="#accordion" href="#bodies">
                                Body Selection <i class="fas fa-chevron-down"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="bodies" class="panel-collapse collapse in">
                    @foreach($bodies as $body)
                        <label>
                            <input type="radio" name="body" id="{{$body->id}}" value="{{$body->class}} {{$body->version}}">
                            <img src="{{$body->image}}" class="img-fluid" alt="Tooltip" title="{{$body->class}}:{{$body->version}}" width = 180>
                        </label>
                    @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordionLink" data-toggle="collapse" data-parent="#accordion" href="#legs">
                                Leg Selection <i class="fas fa-chevron-down"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="legs" class="panel-collapse collapse in">
                        @foreach($legs as $leg)
                            <label>
                                <input type="radio" name="leg" id="{{$leg->id}}" value="{{$leg->class}} {{$leg->version}}">
                                <img src="{{$leg->image}}" class="img-fluid" alt="Tooltip" title="{{$leg->class}}:{{$leg->version}}" width = 180>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordionLink" data-toggle="collapse" data-parent="#accordion" href="#feet">
                                Feet Selection <i class="fas fa-chevron-down"></i>
                            </a>
                        </h4>
                    </div>
                    <div id="feet" class="panel-collapse collapse in">
                        @foreach($feets as $feet)
                            <label>
                                <input type="radio" name="feet" id="{{$feet->id}}" value="{{$feet->class}} {{$feet->version}}">
                                <img src="{{$feet->image}}" class="img-fluid" alt="Tooltip" title="{{$feet->class}}:{{$feet->version}}" width = 180>
                            </label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Build your Droid</button>
            </form>
        </div>
    </div>
</div>
@endsection

