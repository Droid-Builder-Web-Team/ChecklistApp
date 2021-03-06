@extends('layouts.app')

@section('content')
<div class="container-fluid home-container">
    <div class="row justify-content-center full-height-percentage">
        <div class="col-md-12 profile-container full-height-percentage">
            <div class="overlay" id="bodyOverlay"></div>

            {{-- Mobile Carousel --}}
            <div id="mobileBuilder" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="/img/BuilderImg/Brain_Diaz.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Mark_Morey.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Chris_Rosenbaum.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Ryanlee_Moffitt.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Matt_Chicon.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Mark_Andrew.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Chris_Emerson.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Trevor_Zaharichuk.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Joseph_Masci.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Jon_Haag_DO.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="/img/BuilderImg/Andy_Whiteley.jpg" class="d-block w-100" alt="...">
                  </div>

                </div>
            </div>

            <div class="demo__gallery" id="gallery">
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
                <div class="demo__placeholder"></div>
            </div>

            <div class="flex-center position-ref half-height">
                <div class="content">
                    <div class="home-title m-b-md noclick">
                        Printed Parts Checklist
                    </div>

                    <div class="links">
                        <a href="https://www.facebook.com/groups/MrBaddeley" id="facebook">Facebook</a>
                        <a href="https://www.patreon.com/mrbaddeley/posts" id="patreon">Patreon</a>
                        <a href="https://www.youtube.com/channel/UC_to0ElS5JqOOvnQMR_DVFA" id="youtube">YouTube</a>
                        <a href="https://3dprinteddroids.com/" id="forum">Forum</a>
                        <a href="https://www.madcat3d.com/shop/" id="shop">Shop</a>
                        <a href="https://discord.gg/q6n6vVk" id="discord">Discord</a>
                    </div>
                    <a href="{{ route('getting_started') }}" class="btn btn-ionic mt-4" role="button"><strong>Get Started</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
