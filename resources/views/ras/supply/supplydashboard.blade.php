@extends('layout.supplylayout')

@section('supplydashboard')
    <main>
        <h1>Dashboard</h1>
        <div class="date">
            <input type="date" name="" id="">
        </div>

        <div class="insights">
            {{-- -------------------------------END-OF-SALES-------------------- --}}
            <div class="totalreservation">
                <span class="ri-key-2-line"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Reservations</h3>
                        <h1>
                            Php25,024
                        </h1>
                    </div>
                    <div class="progress">
                        <svg viewBox="0 0 100 100">
                            <circle class="sales-circle" cx="50" cy="50" r="40"></circle>
                        </svg>
                        <div class="number">
                            <p>81%</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
            <div class="gymreservation">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Gym Reservations</h3>
                        <h1>
                            Php25,024
                        </h1>
                    </div>
                    <div class="progress">
                        <svg viewBox="0 0 100 100">
                            <circle class="sales-circle" cx="50" cy="50" r="40"></circle>
                        </svg>
                        <div class="number">
                            <p>81%</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
            <div class="dormreservations">
                <span class="ri-hotel-bed-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Dorm Reservations</h3>
                        <h1>
                            Php25,024
                        </h1>
                    </div>
                    <div class="progress">
                        <svg viewBox="0 0 100 100">
                            <circle class="sales-circle" cx="50" cy="50" r="40"></circle>
                        </svg>
                        <div class="number">
                            <p>81%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ------------------END OF INSIGHTS------------------ --}}
        <div class="recent-orders">
            <h2>Recent Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Number</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fdhsajkdakdh</td>
                        <td>Adska</td>
                        <td>Due</td>
                        <td class="warning">Pending</td>
                        <td class="warning-orange">Details</td>
                    </tr>
                    <tr>
                        <td>Fdhsajkdakdh</td>
                        <td>Adska</td>
                        <td>Due</td>
                        <td class="warning">Pending</td>
                        <td class="warning-orange">Details</td>
                    </tr>
                    <tr>
                        <td>Fdhsajkdakdh</td>
                        <td>Adska</td>
                        <td>Due</td>
                        <td class="warning">Pending</td>
                        <td class="warning-orange">Details</td>
                    </tr>
                    <tr>
                        <td>Fdhsajkdakdh</td>
                        <td>Adska</td>
                        <td>Due</td>
                        <td class="warning">Pending</td>
                        <td class="warning-orange">Details</td>
                    </tr>
                    <tr>
                        <td>Fdhsajkdakdh</td>
                        <td>Adska</td>
                        <td>Due</td>
                        <td class="warning">Pending</td>
                        <td class="warning-orange">Details</td>
                    </tr>
                    <tr>
                        <td>Fdhsajkdakdh</td>
                        <td>Adska</td>
                        <td>Due</td>
                        <td class="warning">Pending</td>
                        <td class="warning-orange">Details</td>
                    </tr>
                </tbody>
            </table>
            <a href="#">Show All</a>
        </div>
    </main>

    {{-- ------------------END OF MAIN------------------ --}}
    <div class="right">
        <div class="top">
            <button id="menu-btn">
                <span class="ri-menu-line"></span>
            </button>
            <div class="theme-toggler">
                <span class="ri-sun-fill active"></span>
                <span class="ri-moon-fill"></span>
            </div>
            <div class="profile">
                <div class="info">
                    <p>Hey, <b>{{ Auth::user()->first_name }}</b></p>
                    <small class="text-muted">{{ Auth::user()->role }}</small>
                </div>
                <div class="profile-photo">
                    <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                </div>
            </div>
        </div>
        {{-- ------------------END OF TOP------------------ --}}
        <div class="recent-updates">
            <h2>Recent Updates</h2>
            <div class="updates">
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                    <div class="message">
                        <p><b>Mike Tyson </b>Loreendis, cupiditate ipsam, saepe orro tempora.</p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                    <div class="message">
                        <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque
                            aspernatur nostrum, </p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                    <div class="message">
                        <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adae illo, nulla voluptates
                            porro tempora.</p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>
            </div>
        </div>
        {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
        <div class="sales-analytics">
            <h2>Sales Analytics</h2>
            <div class="item online">
                <div class="icon">
                    <span class="ri-shopping-cart-2-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ONLINE ORDERS</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="success">+39%</h5>
                    <h3>3849</h3>
                </div>
            </div>
            <div class="item offline">
                <div class="icon">
                    <span class="ri-shopping-bag-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>OFFLINE ORDERS</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="danger">-17%</h5>
                    <h3>3849</h3>
                </div>
            </div>
            <div class="item customers">
                <div class="icon">
                    <span class="ri-user-fill"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>NEW CUSTOMERS</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="success">+225%</h5>
                    <h3>3849</h3>
                </div>
            </div>
            <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD PRODUCT</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="success">+225%</h5>
                    <h3>3849</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
