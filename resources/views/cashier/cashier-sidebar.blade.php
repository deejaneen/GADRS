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
            <a href="{{ route('cashierhome') }}" class="sidebar-link">
                <span class="ri-dashboard-line ">
                    <h3>Dashboard</h3>
                </span>
            </a>

            <a href="{{ route('cashierforpayment') }}" class="sidebar-link">
                <span class="ri-wallet-3-fill">
                    <h3>For Payment</h3>
                    @if($dormsReceivedCountView != 0 || $gymsReceivedCountView != 0)
                    <span class="message-count">{{ $dormsReceivedCountView + $gymsReceivedCountView }}</span>
                    @endif
                </span>

            </a>
            <a href="{{ route('cashierpaid') }}" class="sidebar-link">
                <span class="ri-receipt-line">
                    <h3>Paid</h3>
               
                </span>
            </a>

            <a href="{{ route('cashierprofile') }}" class="sidebar-link">
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