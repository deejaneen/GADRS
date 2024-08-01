<aside>
    <div class="top">
        <div class="logo">
            <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
            <h2 class="primary-light">COA <span class="danger">CAR</span></h2>
        </div>
        <div class="profile">
            <div class="info">
                <p>Hey, <b>{{ Auth::user()->first_name }}</b></p>
            </div>
            <div class="role">
                <small class="">Dorm-in-charge</small>
            </div>
        </div>
        <div class="close" id="close-btn">
            <span class="ri-close-fill"></span>
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
                <span class="ri-time-line">
                    <h3>Pending</h3>
                    @if($dormsPendingCountView != 0)
                    <span class="message-count">{{ $dormsPendingCountView }}</span>
                    @endif
                </span>
            </a>
            <a href="{{ route('supplyreservationsrd') }}" class="sidebar-link">
                <span class="ri-receipt-line">
                    <h3>Received</h3>
                    @if($dormsReceivedCountView != 0)
                    <span class="message-count">{{ $dormsReceivedCountView }}</span>
                    @endif
                </span>
            </a>
            <a href="{{ route('supplypaid') }}" class="sidebar-link">
                <span class="ri-receipt-fill">
                    <h3>Paid</h3>
                    @if($dormsReceivedCountView != 0)
                    <span class="message-count">{{ $dormsReceivedCountView }}</span>
                    @endif
                </span>
            </a>
            <a href="{{ route('supplyprofile') }}" class="sidebar-link">
                <span class="ri-user-line">
                    <h3>Change Password</h3>
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