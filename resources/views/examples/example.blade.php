@extends('layouts.app')

@section('page_title')
    Page Title
@endsection

@section('content')
<div class="container">

    <!-- Title -->
    <div class="heading mb-5">
        <h1 class="title text-center">Title</h1>
    </div>

    <!-- Content -->
    <div class="row justify-content-center">
        <div class="col-md-12">
        <stl-viewer></stl-viewer>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <!-- Add scripts here -->

    <script>
        console.log("This is a test");
    </script>
@endpush

@push('styles')
    <!-- <link href="{{ asset('css/example.css') }}" rel="stylesheet"> -->
@endpush

