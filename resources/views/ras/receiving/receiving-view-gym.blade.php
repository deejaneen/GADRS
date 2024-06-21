@extends('layout.receivinglayout')

@section('receivingdashboard')
<!-- @include('ras.receiving.receiving-side-bar') -->

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
            <label for="employee_id" class="form-label">User ID</label>
            <input type="text" class="form-control" id="employee_id" value="{{ $gym->employee_id }}" name="employee_id" disabled>
        </div>
        <div class="col">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" value="{{ $userDetails->first_name . ' ' . $userDetails->middle_name . ' ' . $userDetails->last_name }}
" name="username" disabled>
        </div>
    </div>
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