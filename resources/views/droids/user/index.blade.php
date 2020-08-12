@extends('layouts.app')

@section('content')
<div class="container">

<div class="heading mb-5">
    <h1 class="title text-center">My current builds</h1>
</div>
    <div class="row mt-5" id="droidmainframe">
    @foreach($my_droids as $my_droid)

        <div class="col-md-3 mb-5 droid-card" onclick="document.location='{{ route('droid.user.edit', $my_droid->id) }}'">
            <div class="droid-card-content">
                <div style="text-align:center">
					<img src="{{ $my_droid->image }}" alt="{{ $my_droid->class }}" class="img-fluid mb-2" style="height:300px;">
				</div>

				<div class="droid-card-table" style="z-index:2">
					<div class="droid-card-row">
						<div class="droid-card-left">
							<form action="" >
								<input type="image" src="/img/share.png">
							</form>
						</div>
						<div class="droid-card-center noclick">
							<h2 style="margin-bottom:0px">{{ $my_droid->class }}</h2>
						</div>
						<div class="droid-card-right">
							<form action="{{ route('droid.user.destroy', $my_droid->id) }}" method="POST">
								@csrf
								{{ method_field('DELETE') }}
								<input type="image" src="/img/trash.png" onclick="return confirm('Are you sure?')">
							</form>
						</div>
					</div>
				</div>

				<div class="progress-container noclick">
					<div class="progress-bar" style="width:{{$my_droid->progress}}%;">&nbsp;</div>
					<h5 class="progress-text">{{$my_droid->progress}}%</h5>
				</div>

            </div>
        </div>
    @endforeach

    </div>

</div>
@endsection

