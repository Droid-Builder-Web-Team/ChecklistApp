@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MrBaddeley Printed Droid</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div class="overlay"></div>
        <div class="demo__gallery">
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

        <div class="flex-center position-ref half-height noclick">
            <div class="content noclick">
                <div class="home-title m-b-md noclick">
                    Printed Parts Checklist
                </div>
            </div>
        </div>
        <div class="links">
            <a href="https://www.facebook.com/groups/MrBaddeley" id="facebook">Facebook</a>
            <a href="https://www.patreon.com/mrbaddeley/posts" id="patreon">Patreon</a>
            <a href="https://www.youtube.com/channel/UC_to0ElS5JqOOvnQMR_DVFA" id="youtube">YouTube</a>
            <a href="https://3dprinteddroids.com/" id="forum">Forum</a>
            <a href="https://www.madcat3d.com/shop/" id="shop">Shop</a>
            <a href="https://discord.gg/q6n6vVk" id="discord">Discord</a>
            {{-- <a href="https://vapor.laravel.com">Vapor</a>
            <a href="https://github.com/laravel/laravel">GitHub</a> --}}
        </div>
    </body>
</html>
@endsection
