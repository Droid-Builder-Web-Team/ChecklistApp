@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="heading text-center">Custom Droid</h1>
    <p class="lead text-center">Click a section and select your individual sections below and create your custom droid.</p>

	<form action="{{ route('droid.assignCustomDroid') }}" method="POST">
		<table class="customDroid-table" >
			<tr>
				<td class="customDroid-cell" style="width:40%">
					<div class="customDroid-displayTable" style="position:relative; height:100%; width:100%; padding:10px">
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="frontDomeDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="frontLegDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="frontFeetDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="frontBodyDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
					</div>
				</td>
				<td class="customDroid-cell" style="width:20%">
					<table class="customDroid-partsTable">
						<tr>
							<td>
								<h2>Dome Selection</h2>
								<select class="customDroid-select" name="dome" id ="domeCombo" onchange="optionSelected('Dome')">
									<option disabled selected value style="display:none;">Please select</option>
									@foreach($domes as $dome)
										<option id="{{$dome->id}}" value="{{$dome->class}}:{{$dome->version}}" frontImg="{{$dome->frontImage}}" sideImgFore="{{$dome->sideImageFore}}" sideImgBack="{{$dome->sideImageBack}}">{{$dome->class}} {{$dome->version}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<h2>Body Selection</h2>
								<select class="customDroid-select" name="body" id ="bodies" onchange="optionSelected('Body')">
									<option disabled selected value style="display:none">Please select</option>
									@foreach($bodies as $body)
										<option id="{{$body->id}}" value="{{$body->class}}:{{$body->version}}" frontImg="{{$body->frontImage}}" sideImgFore="{{$body->sideImageFore}}" sideImgBack="{{$body->sideImageBack}}">{{$body->class}} {{$body->version}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<h2>Leg Selection</h4>
								<select class="customDroid-select" name="leg" id ="legs" onchange="optionSelected('Leg')">
									<option disabled selected value style="display:none">Please select</option>
									@foreach($legs as $leg)
										<option id="{{$leg->id}}" value="{{$leg->class}}:{{$leg->version}}" frontImg="{{$leg->frontImage}}" sideImgFore="{{$leg->sideImageFore}}" sideImgBack="{{$leg->sideImageBack}}">{{$leg->class}} {{$leg->version}}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<h2>Feet Selection</h4>
								<select class="customDroid-select" name="feet" id ="feet" onchange="optionSelected('Feet')">
									<option disabled selected value style="display:none">Please select</option>
									@foreach($feets as $feet)
										<option id="{{$feet->id}}" value="{{$feet->class}}:{{$feet->version}}" frontImg="{{$feet->frontImage}}" sideImgFore="{{$feet->sideImageFore}}" sideImgBack="{{$feet->sideImageBack}}">{{$feet->class}} {{$feet->version}}</option>
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
				<td class="customDroid-cell" style="width:40%">
					<div class="customDroid-displayTable" style="position:relative; height:100%; width:100%; padding:10px">
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="sideFeetBackDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="sideLegBackDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="sideDomeForeDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="sideBodyForeDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="sideLegForeDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
						<div style="position:absolute; height:100%; width:100%; padding:10px">
							<div id="sideFeetForeDisplay" style="height:100%; width:100%; background:url('')no-repeat; background-size: contain; background-position: center" ></div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</form>
</div>

<script>

function optionSelected()
{
	var combo = event.target || event.srcElement;
	var selected = combo.options[combo.selectedIndex];
	var src = selected.getAttribute('frontImg');
	var display = document.getElementById('front' + arguments[0] + 'Display');
	display.style.background = "Url(" + src + ") center center / contain no-repeat";
	
	src = selected.getAttribute('sideImgFore');
	display = document.getElementById('side' + arguments[0] + 'ForeDisplay');
	display.style.background = "Url(" + src + ") center center / contain no-repeat";
	
	src = selected.getAttribute('sideImgBack');
	display = document.getElementById('side' + arguments[0] + 'BackDisplay');
	display.style.background = "Url(" + src + ") center center / contain no-repeat";
}

</script>

@endsection

