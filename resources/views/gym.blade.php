@extends('layout.weblayout')

@section('banner')

<!-- Banner Section -->
<div class="banner-gym">
    <div class="container">
        <h1 class="banner-name " style="margin-top:75px;">GYM RESERVATION</h1>
        <a href="#reservation-section" class="btn btn-info btn-lg btn-block mt-2" data-mdb-ripple-init>Book Now</a>
    </div>
</div>

@endsection

@section('gym_table')
    @include('gym.gym_table')
@endsection