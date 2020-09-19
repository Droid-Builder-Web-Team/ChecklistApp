@extends('layouts.app')

@section('content')
<progress value="0" max="9" id="clicked" class="One change">
    <div class="progressbar clear-fix">
      <span class="progressbar-bar"></span>
    </div>
</progress>

<div class="container">
    <section id="gsRow">
        <div class="row mt-auto mb-auto">
            <div class="col col-12 col-md-12 text-center">
                <h1 class="gsHeading p-2 " data-aos="fade-up" data-aos-delay="100">getting started</h1>
                <h3 class="gssubText p-2" data-aos="fade-left" data-aos-delay="300">welcome! we are so happy to have you here, welcome to the printed droids checklist.
                    it's very easy to get started and you will compiling your droid in no time.
                </h3>
                <img class="img-fluid" data-aos-delay="500" data-aos="fade-right" src="assets/img/GS1.jpg">
                <div class="hero" data-aos="zoom-in" data-aos-delay="700">
                    <a href="#gsRow2" class="scroll-down">
                        <div class="mouse"><span></span></div>
                        <div class="arrow"><span></span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="gsRow2">
        <div class="row mt-auto mb-auto">
            <div class="col col-12 col-md-12 mt-auto mb-auto text-center">
                <h1 class="gsHeading p-2" data-aos="fade-left" data-aos-delay="100">Finding your Droid</h1>
                <h3 class="gssubText p-2" data-aos="fade-left" data-aos-delay="300">
                    Before you can start looking for parts, you need to find your droid. Locate the Droid Mainframe from the Navigation Bar to bring up the Mainframe of Droids you can build.
                </h3>
                <img class="img-fluid" data-aos="fade-right" data-aos-delay="500" src="assets/img/DroidMainframe.jpg">
                <div class="hero" data-aos="zoom-in" data-aos-delay="700">
                    <a href="#gsRow3" class="scroll-down">
                        <div class="mouse"><span></span></div>
                        <div class="arrow"><span></span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="gsRow3">
        <div class="row mt-auto mb-auto">
            <div class="col col-12 col-md-12 mt-auto mb-auto text-center">
                <h1 class="gsHeading p-2" data-aos="fade-right" data-aos-delay="100">Selecting your Droid</h1>
                <h3 class="gssubText p-2" data-aos="fade-right" data-aos-delay="300">
                    The Droid Mainframe will give you a display of all the avaliable droids including an image,
                    their names and a breif description of the droid. Find your droid and click the build button to begin.
                </h3>
                <img class="img-fluid" data-aos-delay="500" data-aos="fade-left" src="assets/img/GS2.jpg">
                <div class="hero" data-aos="zoom-in" data-aos-delay="700">
                    <a href="#gsRow4" class="scroll-down">
                        <div class="mouse"><span></span></div>
                        <div class="arrow"><span></span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="gsRow4">
        <div class="row mt-auto mb-auto">
            <div class="col col-12 col-md-12 mt-auto mb-auto text-center">
                <h1 class="gsHeading p-2" data-aos="fade-up" data-aos-delay="100">Your Build Page</h1>
                <h3 class="gssubText p-2" data-aos="fade-right" data-aos-delay="300">
                    Your build page is where you get to organise what parts you are printing. You have a quick overview
                    at the top of the page, a Droid Information section on the left and the Checklist on the right!
                </h3>
                <img class="img-fluid" data-aos="fade-left" data-aos-delay="500" src="assets/img/BuildPage.jpg">
                <div class="hero" data-aos="zoom-in" data-aos-delay="700">
                    <a href="#gsRow5" class="scroll-down">
                        <div class="mouse"><span></span></div>
                        <div class="arrow"><span></span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="gsRow5">
        <div class="row mt-auto mb-auto">
            <div class="col col-12 col-md-12 mt-auto mb-auto text-center">
                <h1 class="gsHeading p-2" data-aos="fade-left" data-aos-delay="100">Droid information</h1>
                <h3 class="gssubText p-2" data-aos="fade-left" data-aos-delay="300">
                    in this section you can easily create a back story for your droid, giving it a designation, description, colours as well as going into detail on control system, electronics
                    and how you are going to power the droid.
		        </h3>
                <img class="img-fluid" id="infoImg" data-aos="fade-right" data-aos-delay="500" src="assets/img/GS4.jpg">
                <div class="hero" data-aos="zoom-in" data-aos-delay="700">
                    <a href="#gsRow6" class="scroll-down">
                        <div class="mouse"><span></span></div>
                        <div class="arrow"><span></span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="gsRow6">
        <div class="row mt-auto mb-auto">
            <div class="col col-12 col-md-12 mt-auto mb-auto text-center">
                <h1 class="gsHeading p-2" data-aos="fade-left" data-aos-delay="100">Checklist</h1>
                <h3 class="gssubText p-2" data-aos="fade-left" data-aos-delay="300">the checklist is the key feature of this program. find the part you are printing and tick it off when you're done. if you are not using
                    a specific part, tick the n/a button to exclude it from the count. a counter keeps track of your progress.
                </h3>
                <img class="img-fluid" data-aos-delay="500" data-aos="fade-right" src="assets/img/Checklist.jpg">
                <div class="hero" data-aos="zoom-in" data-aos-delay="700">
                    <a href="#gsRow7" class="scroll-down">
                        <div class="mouse"><span></span></div>
                        <div class="arrow"><span></span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="gsRow7">
        <div class="row mt-auto mb-auto">
            <div class="col col-12 col-md-12 mt-auto mb-auto text-center">
                <h1 class="gsHeading" data-aos="fade-left" data-aos-delay="100">Your Profile</h1>
                <h3 class="gssubText" data-aos="fade-left" data-aos-delay="300">
                    Make sure you fill in your profile! For a future addition to the site, your profile could be viewed by other builders...but keep that a secret!
                </h3>
                <img class="img-fluid" data-aos-delay="500" data-aos="fade-right" src="assets/img/Profile.jpg">
                <div class="hero" data-aos="zoom-in" data-aos-delay="700">
                    <a href="#gsRow8" class="scroll-down">
                        <div class="mouse"><span></span></div>
                        <div class="arrow"><span></span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="gsRow8">
        <div class="row mt-auto mb-auto">
            <div class="col col-12 col-md-12 mt-auto mb-auto text-center">
                <h1 class="gsHeading text-center p-2" data-aos="fade-up" data-aos-delay="100">Future Additions</h1>
                <h3 class="gssubText text-center p-2" data-aos="fade-left" data-aos-delay="300">
                    We are always coming up with new ideas on how to best help the Droid Building Community. We have many features planned for future upgrades
                    that we can't wait to share.
                </h3>
                <img src="assets/img/coding.svg" class="img-fluid">
                <div class="hero" data-aos="zoom-in" data-aos-delay="700">
                    <a href="#gsRow9" class="scroll-down">
                        <div class="mouse"><span></span></div>
                        <div class="arrow"><span></span></div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<section id="gsRow9">
    <div class="row mt-auto mb-auto">
        <div class="col col-12 col-md-12 mt-auto mb-auto text-center">
            <h1 class="gsHeading p-2" data-aos="fade-up" data-aos-delay="100">Ready to Begin?</h1>
            <h3 class="gssubText p-2" data-aos="fade-left" data-aos-delay="300">
                Let's start building!
            </h3>
            <img src="assets/img/robot.svg" class="img-fluid">
            <a class="button-anon-pen p-2" href="{{ route('droids.index.index') }}" data-aos="fade-right" data-aos-delay="1500" role="button"><span>Start Building</span></a>
        </div>
    </div>
</section>
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
