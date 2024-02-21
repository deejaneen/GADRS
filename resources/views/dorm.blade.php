@extends('layout.layout')

@section('banner')

    <!-- Banner Section -->
    <div class="banner-dorm">
        <div class="container">
            <h1 class="banner-name">DORM RESERVATION</h1>
            <a href="{{ route('dorm') }}" class="btn btn-info btn-lg btn-block mt-2" data-mdb-ripple-init>Book Now</a>
        </div>
    </div>
    
@endsection