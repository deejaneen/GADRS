@extends('layout.weblayout')

@section('banner')
    <!-- Banner Section -->
    {{-- <div class="banner-dorm">
    <div class="container">
        <h1 class="banner-name" style="margin-top:75px;">DORM RESERVATION</h1>
        <a href="#dorm_reservation_section" class="btn btn-info btn-lg btn-block mt-2" data-mdb-ripple-init>Book Now</a>
    </div>
</div> --}}
    <div class="container">
        <div class="hero-section">
            <div class="banner-dorm-top"></div>
            <div class="banner-dorm-bottom"></div>
            <div class="column-bar-dorm"></div>

            <img class="pillow1" src="{{ asset('images/pillow2.png') }}" alt="">
            <img class="pillow2" src="{{ asset('images/pillow2.png') }}" alt="">
        </div>

        <div class="banner-dorm-text">
            <h1 class="banner-name ">DORM RESERVATION</h1>
            <a href="#reservation-section" class="btn btn-info btn-lg btn-block mt-2" data-mdb-ripple-init>Book Now</a>
        </div>
    </div>
@endsection


@section('dorm_reservation_card')
    @include('dorm.dorm_reservation_card')
@endsection

