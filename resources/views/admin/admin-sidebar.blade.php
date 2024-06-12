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
                <a href="{{ route('adminhome') }}" class="sidebar-link">
                    <span class="ri-dashboard-line ">
                        <h3>Dashboard</h3>
                    </span>
                </a>
                <a href="{{ route('adminusers') }}" class="sidebar-link">
                    <span class="ri-team-line">
                        <h3>Users</h3>
                    </span>
                </a>
                <a href="{{ route('adminreservations') }}" class="sidebar-link">
                    <span class="ri-receipt-line">
                        <h3>Reservations</h3>
                        <!-- <span class="message-count">26</span> -->
                    </span>
                </a>
                <a href="{{ route('admingym') }}" class="sidebar-link">
                    <span class="ri-basketball-fill">
                        <h3>Gym</h3>
                    </span>
                </a>
                <a href="{{ route('admindorm') }}" class="sidebar-link">
                    <span class="ri-home-3-line">
                        <h3>Dorm</h3>
                    </span>

                </a>
                <a href="{{ route('adminprofile') }}" class="sidebar-link">
                    <span class="ri-user-line">
                        <h3>Change Password</h3>
                    </span>
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form-navbar" class="sidebar-link">
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