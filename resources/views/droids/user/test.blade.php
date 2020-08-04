@extends('layouts.app')

@section('content')
<h2>Droid Factory</h2> 

<div class="heading text-center">
        <h1>Custom Droid Builder</h1>
        <p class="lead">Which bits do you want?</p>
        <img src = "/img/droidfactory.png" width =600>
    </div>


    <div class="row mt-5">
        <div class="col-md-3 mb-5">    
                <form>
                <label>
                <input type="radio" name="test" value="small" checked>
                <img src="http://placehold.it/40x60/0bf/fff&text=A">
                </label>

                <label>
                <input type="radio" name="test" value="big">
                <img src="http://placehold.it/40x60/b0f/fff&text=B">
                </label>

                <label>
                <input type="radio" name="test" value="small" checked>
                <img src="http://placehold.it/40x60/0bf/fff&text=A">
                </label>

                <label>
                <input type="radio" name="test" value="big">
                <img src="http://placehold.it/40x60/b0f/fff&text=B">
                </label>

                <label>
                <input type="radio" name="test" value="small" checked>
                <img src="http://placehold.it/40x60/0bf/fff&text=A">
                </label>

                <label>
                <input type="radio" name="test" value="big">
                <img src="http://placehold.it/40x60/b0f/fff&text=B">
                </label>

                <label>
                <input type="radio" name="test" value="small" checked>
                <img src="http://placehold.it/40x60/0bf/fff&text=A">
                </label>

                <label>
                <input type="radio" name="test" value="big">
                <img src="http://placehold.it/40x60/b0f/fff&text=B">
                </label>
                </form>
         
        </div>
    </div>
  

@endsection