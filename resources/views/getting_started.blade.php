@extends('layouts.app')

@section('content')
<div class="container">
    <section style="height:100vh;">
        <div class="row m-4">
            <div class="col col-md-6 my-auto">
                <h1 class="gsHeading">getting started</h1>
                <h3 class="gssubText">welcome! we are so happy to have you here, welcome to the printed droids checklist.&nbsp;</h3>
            </div>
            <div class="col col-md-6"><img class="img-fluid" src="assets/img/GS1.jpg"></div>
        </div>
    </section>

    <section style="height:100vh;">
        <div class="row m-4">
            <div class="col col-md-6"><img class="img-fluid" src="assets/img/GS2.jpg"></div>
            <div class="col col-md-6 my-auto">
                <h1 class="gsHeading">Building a droid</h1>
                <h3 class="gssubText">to get started, you're going to click the droid mainframe button in the navigation bar which will reveal a list of droids you can build.&nbsp;<br><br>click the droid you want to build. it's that simple!</h3>
            </div>
        </div>
    </section>

    <section style="height:100vh;">
        <div class="row m-4">
            <div class="col col-md-6 my-auto">
                <h1 class="gsHeading">what does it all mean?</h1>
                <h3 class="gssubText">The top of the page tells you which droid you are editing as well as your current progress and even a part count.</h3>
            </div>
            <div class="col col-md-6 my-auto"><img class="img-fluid" src="assets/img/GS3.jpg"></div>
        </div>
    </section>

    <section style="height:100vh;">
        <div class="row m-4">
            <div class="col col-md-6"><img class="img-fluid" src="assets/img/GS4.jpg" style="height:500px;"></div>
            <div class="col col-md-6 my-auto">
                <h1 class="gsHeading">Droid information</h1>
                <h3 class="gssubText">it's always great to have key information about your droid to hand. in this section you can easily create a back story for your droid, giving it a designation, description, colours as well as going into detail on control system, electronics
                    and how you are going to power the droid.</h3>
            </div>
        </div>
    </section>

    <section style="height:100vh;">
        <div class="row m-4">
            <div class="col col-md-6 my-auto">
                <h1 class="gsHeading">Checklist</h1>
                <h3 class="gssubText">the checklist is the key feature in this program. parts are split up into the structure of the onedrive and into further sections. find the section and the part you are printing and tick it off when you're done.<br><br>if you are not using
                    a specific part, tick the n/a button to exclude it from the count.</h3>
            </div>
            <div class="col col-md-6 my-auto"><img class="img-fluid" src="assets/img/GS5.jpg"></div>
        </div>
    </section>
</div>

@endsection
