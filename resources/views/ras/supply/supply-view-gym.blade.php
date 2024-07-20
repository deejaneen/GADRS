@extends('layout.supplylayout')

@section('supplydashboard')
@include('ras.supply.supply-sidebar')

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
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" value="{{ $userDetails->first_name . ' ' . $userDetails->middle_name . ' ' . $userDetails->last_name }}
" name="username" disabled>
        </div>
        <div class="col">
            <label for="employee_id" class="form-label" hidden>User ID</label>
            <input type="text" class="form-control" id="employee_id" value="{{ $dorm->employee_id }}" name="employee_id" disabled hidden>
        </div>
    </div>
    <hr>
    <div class="row mb-3">
        <div class="col">
            <label for="reservation_start_date" class="form-label">Reservation Start Date</label>
            <input type="text" class="form-control" id="reservation_start_date" value="{{ date('F j, Y', strtotime($dorm->reservation_start_date)) }}" name="reservation_start_date" disabled>
        </div>
        <div class="col">
            <label for="reservation_start_time" class="form-label">Reservation Start Time</label>
            <input type="text" class="form-control" id="reservation_start_time" value="{{ date('g:i A', strtotime($dorm->reservation_start_time)) }}" name="reservation_start_time" disabled>
        </div>
        <div class="col">
            <label for="reservation_end_date" class="form-label">Reservation End Date</label>
            <input type="text" class="form-control" id="reservation_end_date" value="{{ date('F j, Y', strtotime($dorm->reservation_end_date)) }}" name="reservation_end_date" disabled>
        </div>
        <div class="col">
            <label for="reservation_end_time " class="form-label">Reservation End Time</label>
            <input type="text" class="form-control" id="reservation_end_time " value="{{ date('g:i A', strtotime($dorm->reservation_end_time )) }}" name="reservation_end_time " disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="gender" class="form-label">Dorm Type</label>
            <input type="text" class="form-control" id="gender" value="{{ $dorm->gender }}" name="gender" disabled>
        </div>
        <div class="col">
            <label for="occupant_type" class="form-label">Occupant Type</label>
            <input type="text" class="form-control" id="occupant_type" value="{{ $dorm->occupant_type }}" name="occupant_type" disabled>
        </div>
        <div class="col">
            <label for="price" class="form-label">Total Price</label>
            <input type="text" class="form-control" id="price" value="{{ $dorm->total_price }}" name="price" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" value="{{ $dorm->email }}" name="email" disabled>
        </div>
        <div class="col">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" value="{{ $dorm->contact_number }}" name="contact_number" disabled>
        </div>
        <div class="col">
            <label for="quantity" class="form-label">Beds</label>
            <input type="text" class="form-control" id="quantity" value="{{ $dorm->quantity }}" name="quantity" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <label for="receiver_name" class="form-label">Receiving Personnel</label>
            <input type="text" class="form-control" id="receiver_name" value="{{ $dorm->receiver_name }}" name="receiver_name" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <button class="btn btn-go-back" onclick="goBack()">Back</button>
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