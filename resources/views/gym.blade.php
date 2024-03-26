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
            <h1 class="banner-name">GYM RESERVATION</h1>
            <a href="#reservation-section" class="btn btn-info btn-lg btn-block mt-2" data-mdb-ripple-init>Book Now</a>
        </div>
    </div>
@endsection

@section('gym_table')
    @include('gym.gym_table')
    {{-- <div>
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
                            <input type="checkbox" class="reservation-checkbox" data-price="{{ $gymcart->price }}" onclick="updateTotal()">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h2></h2>
        <p>Total: <span id="total-price">0</span></p> {{-- Make this be updated real-time when a user clicks the checkbox. --}}
        {{-- <button id="checkout-btn">Checkout</button> --}}
    {{-- </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get all checkboxes
            const checkboxes = document.querySelectorAll('.reservation-checkbox');
            const totalPriceDisplay = document.getElementById('total-price');

            let totalPrice = 0;

            checkboxes.forEach(function (checkbox) {
                checkbox.checked = false; // Uncheck the checkbox on page load
                checkbox.addEventListener('change', function () {
                    // If checkbox is checked, add the price; otherwise, subtract it
                    const price = parseFloat(this.dataset.price);
                    if (this.checked) {
                        totalPrice += price;
                    } else {
                        totalPrice -= price;
                    }
                    // Update total price display
                    totalPriceDisplay.textContent = totalPrice.toFixed(2);
                });
            });

            // Optional: Handle checkout button click
            const checkoutBtn = document.getElementById('checkout-btn');
            checkoutBtn.addEventListener('click', function () {
                // Implement checkout functionality here
                alert('Total price: $' + totalPrice.toFixed(2));
            });
        });
    </script>  --}}
@endsection

