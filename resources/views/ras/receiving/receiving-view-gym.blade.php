@extends('layout.receivinglayout')

@section('receivingdashboard')
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
            <a href="{{ route('receivinghome') }}">
                <span class="ri-dashboard-line ">
                    <h3>Dashboard</h3>
                </span>
            </a>

            <a href="{{ route('receivingpending') }}" class="active">
                <span class="ri-time-line">
                    <h3>Pending</h3>
                </span>

            </a>
            <a href="{{ route('receivingreceived') }}">
                <span class="ri-folder-received-fill">
                    <h3>Received</h3>
                </span>
            </a>
            <a href="{{ route('receivingeditreservations') }}">
                <span class="ri-edit-2-line">
                    <h3>Edit Reservations</h3>
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

<div class="right">
    <div class="top">
        <button id="menu-btn">
            <span class="ri-menu-line"></span>
        </button>
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

    {{-- ------------------ END OF RECENT UPDATES ------------------ --}}

</div>
<div class="card" id="ReceivingPendingTableCard">
    <div class="row mb-3">
        <div class="col">
            <label for="reservation_date" class="form-label">Reservation Date</label>
            <input type="text" class="form-control" id="reservation_date" value="{{ date('F j, Y', strtotime($gym->reservation_date)) }}" name="reservation_number" disabled>
        </div>
        <div class="col">
            <label for="reservation_time_start" class="form-label">Reservation Time Start</label>
            <input type="text" class="form-control" id="reservation_time_start" value="{{ date('g:i A', strtotime($gym->reservation_time_start)) }}" name="reservation_time_start" disabled>
        </div>
        <div class="col">
            <label for="reservation_time_end" class="form-label">Reservation Time End</label>
            <input type="text" class="form-control" id="reservation_time_end" value="{{ date('g:i A', strtotime($gym->reservation_time_end)) }}" name="reservation_time_end" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="purpose" class="form-label">Purpose</label>
            <input type="text" class="form-control" id="purpose" value="{{ $gym->purpose }}" name="purpose" disabled>
        </div>
        <div class="col">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" value="{{ $gym->price }}" name="price" disabled>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <button class="btn btn-primary" onclick="goBack()">Back</button>
        </div>

    </div>

</div>

</div>
@endsection

<script>
    function goBack() {
        window.history.back();
    }
</script>
