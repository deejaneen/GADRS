@extends('layout.weblayout')

@section('banner')
    <!-- Banner Section -->
    <div class="container">
        <div class="hero-section">
            <div class="banner-gym-top"></div>
            <div class="banner-gym-bottom"></div>
            <div class="column-bar-gym"></div>

            <img class="volleyball" src="{{ asset('images/Volleyball.png') }}" alt="">
            <img class="basketball" src="{{ asset('images/Basketball.png') }}" alt="">
        </div>

        <div class="banner-gym-text">
            <h1 class="banner-name ">GYM RESERVATION</h1>
            <a href="#reservation-section" class="btn btn-info btn-lg btn-block mt-2" data-mdb-ripple-init>Book Now</a>
        </div>
    </div>
@endsection

@section('gym_table')
    @include('gym.gym_table')
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Reservation Date</th>
                    <th scope="col">Reservation Time Start</th>
                    <th scope="col">Reservation Time End</th>
                    <th scope="col">Price</th>
                    <th scope="col">Checkbox</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($gymcarts as $gymcart)
                    <tr>
                        <th>{{ $gymcart->reservation_date }}</th>
                        <td>{{ date('h:i A', strtotime($gymcart->reservation_time_start)) }}</td>
                        <td>{{ date('h:i A', strtotime($gymcart->reservation_time_end)) }}</td>
                        <td>{{ $gymcart->price }}</td>
                        <td>
                            <input class="form-check-input" type="checkbox" value="{{ $gymcart->price }}"
                                id="checkbox{{ $loop->iteration }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p id="total">Total: 0</p>
        <button>Checkout</button>
    </div>
@endsection

