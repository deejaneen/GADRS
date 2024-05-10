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
    <form id="addReservationNumberForm" method="post" action="{{ route('addFormNumber', $gym->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-4">
                <label for="reservation_number" class="form-label">Form Number</label>
                <input type="text" class="form-control" id="reservation_number" value="{{$gym->reservation_number}}" name="reservation_number" required>
                @error('reservation_number')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <div class="col-4">
                    <input type="hidden" class="form-control" id="status" value="Received" name="status" required>
                </div>
            </div>

        </div>
        <div>
            <button type="submit" class="btn btn-primary">Add Form Number</button>
            <button class="btn btn-primary" onclick="goBack()">Back</button>
        </div>
    </form>

</div>
@endsection
<script>
    function goBack() {
        window.history.back();
    }
</script>
