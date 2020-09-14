@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row sec1" id="gsRow">
        <div class="col col-md-12 background" >
            <h1 class="gsHeading text-center p-2" data-aos="fade-up" data-aos-delay="500">getting started</h1>
            <h3 class="gssubText text-center p-2" data-aos="fade-left" data-aos-delay="1000">welcome! we are so happy to have you here, welcome to the printed droids checklist.
                it's very easy to get started and you will compiling your droid in no time.
            </h3>
            <img class="img-fluid" data-aos="fade-right" data-aos-delay="2000" src="assets/img/GS1.jpg">
            <a href="#gsRow2"><span></span>Scroll</a>

        </div>
    </div>

    <div class="row sec2" id="gsRow2">
        <div class="col col-md-6 mt-auto mb-auto"><img class="img-fluid" data-aos="fade-right" src="assets/img/DroidMainframe.jpg"></div>
        <div class="col col-md-6 mt-auto mb-auto">
            <h1 class="gsHeading p-2" data-aos="fade-left" data-aos-delay="500">Finding your Droid</h1>
            <h3 class="gssubText p-2" data-aos="fade-left" data-aos-delay="1000">
                Before you can start looking for parts, you need to find your droid. Locate the Droid Mainframe from the Navigation Bar to bring up the Mainframe of Droids you can build.
            </h3>
            <a href="#gsRow3"><span></span>Scroll</a>
        </div>
    </div>

    <div class="row" id="gsRow3">
            <div class="col col-md-6 mt-auto mb-auto">
                <h1 class="gsHeading p-2 text-right" data-aos="fade-right" data-aos-delay="500">Selecting your Droid</h1>
                <h3 class="gssubText p-2 text-right" data-aos="fade-right" data-aos-delay="1000">
                    Selecting your droid is just as easy as finding your droid. The Droid Mainframe will give you a display of all the avaliable droids including an image,
                    their names and a breif description of the droid such as Full Droids, Work in Progress, Microdroids etc. Find your droid and click the build button to begin.
                </h3>
            </div>
            <div class="col col-md-6 mt-auto mb-auto"><img class="img-fluid" data-aos="fade-left" src="assets/img/GS2.jpg"><a href="#gsRow4"><span></span>Scroll</a>
            </div>
    </div>

    <div class="row" id="gsRow4">
        <div class="col col-md-12 mt-auto mb-auto">
            <h1 class="gsHeading p-2 text-center" data-aos="fade-up">Your Build Page</h1>
            <h3 class="gssubText p-2 text-center" data-aos="fade-right" data-aos-delay="1000">
                Everything is quite simple so far wouldn't you agree? Your build page is where you get to organise what parts you are printing. You have a quick overview
                at the top of the page, a Droid Information section on the left and the Checklist on the right!
            </h3>
            <img class="img-fluid" data-aos="fade-left" data-aos-delay="2000" src="assets/img/BuildPage.jpg">
            <a href="#gsRow5"><span></span>Scroll</a>
        </div>
    </div>

        <div class="row" id="gsRow5">
            <div class="col col-md-6 mt-auto mb-auto"><img class="img-fluid" data-aos="fade-right" src="assets/img/GS4.jpg"></div>
            <div class="col col-md-6 mt-auto mb-auto">
                <h1 class="gsHeading p-2 text-left" data-aos="fade-left" data-aos-delay="500">Droid information</h1>
                <h3 class="gssubText p-2 text-left" data-aos="fade-left" data-aos-delay="1000">it's always great to have key information about your droid to hand. in this section you can easily create a back story for your droid, giving it a designation, description, colours as well as going into detail on control system, electronics
                    and how you are going to power the droid.</h3>
                <a href="#gsRow6"><span></span>Scroll</a>

            </div>
        </div>

        <div class="row" id="gsRow6">
            <div class="col col-md-6 mt-auto mb-auto">
                <h1 class="gsHeading p-2 text-right" data-aos="fade-left" data-aos-delay="500">Checklist</h1>
                <h3 class="gssubText p-2 text-right" data-aos="fade-left" data-aos-delay="1000">the checklist is the key feature of this program. parts are split up into the structure of the onedrive and then into further sections. find the section and the part you are printing and tick it off when you're done.<br><br>if you are not using
                    a specific part, tick the n/a button to exclude it from the count. You will see counters next to each section which tells you when you have completed a section.
                </h3>
            </div>
            <div class="col col-md-6 mt-auto mb-auto"><img class="img-fluid" data-aos="fade-right" src="assets/img/Checklist.jpg"><a href="#gsRow7"><span></span>Scroll</a>
            </div>
        </div>

        <div class="row" id="gsRow7">
            <div class="col col-md-12 mt-auto mb-auto">
                <h1 class="gsHeading text-center p-2" data-aos="fade-up" data-aos-delay="1000">Future Additions</h1>
                <h3 class="gssubText text-center p-2" data-aos="fade-left" data-aos-delay="2000">
                    Just as with Droid Building, we are always coming up with new ideas on how to best help the Droid Building Community. We have many features planned for future upgrades
                    and you will always be kept up-to-date with what is happening with the Printed Parts Checklist.
                </h3>
                <a href="#gsRow8"><span></span>Scroll</a>
            </div>
        </div>

        <div class="row" id="gsRow8">
            <div class="col col-md-6 mt-auto mb-auto"><img class="img-fluid" data-aos="fade-right" src="assets/img/Profile.jpg" style="height:500px;"></div>
            <div class="col col-md-6 mt-auto mb-auto">
                <h1 class="gsHeading" data-aos="fade-left" data-aos-delay="500">Your Profile</h1>
                <h3 class="gssubText" data-aos="fade-left" data-aos-delay="1000">
                    Make sure you fill in your profile! For a future addition to the site, your profile could be viewed by other builders...but keep that a secret!
                </h3>
                <a href="#gsRow9"><span></span>Scroll</a>
            </div>
        </div>

        <div class="row" id="gsRow9">
            <div class="col col-md-12 mx-auto text-center">
                <h1 class="gsHeading p-2" data-aos="fade-up" data-aos-delay="500">Ready to Begin?</h1>
                <h3 class="gssubText p-2" data-aos="fade-left" data-aos-delay="1000">
                    Let's start building!
                </h3>
                <a href="{{ route('droids.index.index') }}" class="btn btn-baddeley p-2" data-aos="fade-right" data-aos-delay="1500" role="button">Build a Droid</a>
            </div>
        </div>
</div>

@endsection
@push('scripts')
<script>
    $(function() {
    $("a[href*=\\#]").on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 500, 'linear');
    });
  });
</script>
@endpush
