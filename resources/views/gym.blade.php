@extends('layout.weblayout')

@section('banner')
    <!-- Banner Section -->
    <div class="container" >
        <div class="hero-section">
            <div class="banner-gym-top"></div>
            <div class="banner-gym-bottom"></div>
            <div class="column-bar-gym"></div>
            <img class="volleyball" src="{{ asset('images/Volleyball.png') }}" alt="">
            <img class="basketball" src="{{ asset('images/Basketball.png') }}" alt="">
        </div>

        <div class="banner-gym-text" id="contentcontainer">
            <h1 class="banner-name">GYM RESERVATION</h1>
            <a href="#reservation-section" class="btn btn-info btn-lg btn-block mt-2" data-mdb-ripple-init>Book Now</a>
        </div>
    </div>
@endsection

@section('gym_table')
    @include('gym.gym_table')
@endsection
