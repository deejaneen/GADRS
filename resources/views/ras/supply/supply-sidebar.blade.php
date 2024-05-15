<aside>
    <div class="top">
        <div class="logo">
            <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
            <h2 class="primary-light">COA <span class="danger">CAR</span></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="ri-close-fill"></span>
        </div>

        <div class="sidebar">
            <a href="{{ route('supplyhome') }}" class="sidebar-link">
                <span class="ri-dashboard-line ">
                    <h3>Dashboard</h3>
                </span>
            </a>
            <a href="{{ route('supplyreservations') }}" class="sidebar-link">
                <span class="ri-receipt-line">
                    <h3>Reservations</h3>
                    <!-- <span class="message-count">26</span> -->
                </span>
            </a>
            <a href="{{ route('supplyreservationsrd') }}" class="sidebar-link">
                <span class="ri-receipt-line">
                    <h3>Received</h3>
                    <!-- <span class="message-count">26</span> -->
                </span>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form-navbar">
                @csrf

                <button class="no-underline logout btn btn-danger btn-md" type="submit" id="logout-button">
                    <span class="ri-logout-box-r-line">
                        <h3>LOGOUT</h3>
                    </span>
                </button>
            </form>
        </div>
    </div>
</aside>
