@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="heading text-center">Custom Droid</h1>
    <p class="lead text-center">Click a section and select your individual sections below and create your custom droid.</p>

	<table class="customDroid-table" >
		<tr>
			<td class="customDroid-cell">
				<table class="customDroid-displayTable">
					<tr>
						<td class="customDroid-displayCell" style="vertical-align:bottom">
							<img id="domeDisplay" src="" class="img-fluid" width=180>
						</td>
					</tr>
					<tr>
						<td class="customDroid-displayCell" style="vertical-align:top">
							<img id="bodyDisplay" src="" class="img-fluid" width=180>
						</td>
					</tr>
				</table>
			</td>
			<td class="customDroid-cell">
				<table class="customDroid-partsTable">
					<tr>
						<td>
							<h2>Dome Selection</h2>
							<select class="customDroid-select" name="domes" id ="domeCombo" onchange="optionSelected(domeDisplay)">
								<option disabled selected value style="display:none;">Please select</option>
								@foreach($domes as $dome)
									<option value="{{$dome->class}}:{{$dome->version}}" img="{{$dome->image}}">{{$dome->class}} {{$dome->version}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<h2>Body Selection</h2>
							<select class="customDroid-select" name="bodies" id ="bodies" onchange="optionSelected(bodyDisplay)">
								<option disabled selected value style="display:none">Please select</option>
								@foreach($bodies as $body)
									<option value="{{$body->class}}:{{$body->version}}" img="{{$body->image}}">{{$body->class}} {{$body->version}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<h2>Leg Selection</h4>
							<select class="customDroid-select" name="legs" id ="legs">
								<option disabled selected value style="display:none">Please select</option>
								@foreach($legs as $leg)
									<option value="{{$leg->class}}:{{$leg->version}}">{{$leg->class}} {{$leg->version}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<h2>Feet Selection</h4>
							<select class="customDroid-select" name="feet" id ="feet">
								<option disabled selected value style="display:none">Please select</option>
								@foreach($feets as $feet)
									<option value="{{$feet->class}}:{{$feet->version}}">{{$feet->class}} {{$feet->version}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td class="customDroid-submitCell">
							<button type="submit" class="btn btn-baddeley customDroid-buildBtn">Build my droid</button>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

    <!--
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
    -->

</div>

<script>

function optionSelected()
{
	var combo = event.target || event.srcElement;
	var selected = combo.options[combo.selectedIndex];
	var src = selected.getAttribute('img');
	arguments[0].src = src;
}

</script>

@endsection

