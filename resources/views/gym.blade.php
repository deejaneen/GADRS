@extends('layout.weblayout')

@section('banner')
    <!-- Banner Section -->
    <div class="container-gym" >
       <img src="{{asset('images/Volleyball.png')}}" alt="Volleyball" class="volleyball">
       <img src="{{asset('images/Basketball.png')}}" alt="Basketball" class="basketball">
        <div class="banner-gym-text" id="contentcontainer">
            
            <h1 class="banner-name">GYM RESERVATION</h1>
            <a href="#reservation-section" class="btn btn-info btn-lg btn-block mt-2" data-mdb-ripple-init>Book Now</a>
        </div>
    </div>
@endsection

@section('gym_table')
    @include('gym.gym_table')
@endsection
