@extends('layout.receivinglayout')

@section('receivingdashboard')
<!-- @include('ras.receiving.receiving-side-bar') -->

<div class="right">
    <div class="top">
        <button id="menu-btn">
            <span class="ri-menu-line"></span>
        </button>
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
            <input type="text" class="form-control" id="employee_id" value="{{ $gym->employee_id }}" name="employee_id" disabled hidden>
        </div>
    </div>
    <hr>
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
        <!-- @if($gym->purpose == 'Badminton')
        <div class="col">
            <label for="number_of_courts" class="form-label">Number of Courts</label>
            <input type="text" class="form-control" id="number_of_courts" value="{{ $gym->number_of_courts }}" name="number_of_courts" disabled>
        </div>
        @endif -->
        <div class="col">
            <label for="price" class="form-label">Total Price</label>
            <input type="text" class="form-control" id="price" value="{{ $gym->total_price }}" name="price" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="oop_number" class="form-label">OR Number</label>
            <input type="text" class="form-control" id="oop_number" value="{{ $gym->oop_number }}" name="oop_number" disabled>
        </div>
        <div class="col">
            <label for="or_date" class="form-label">OR Date</label>
            <input type="text" class="form-control" id="or_date" value="{{ $gym->or_date }}" name="or_date" disabled>
        </div>
        <div class="col">
            <label for="reservation_number" class="form-label">Reservation Number</label>
            <input type="text" class="form-control" id="reservation_number" value="{{ $gym->reservation_number }}" name="reservation_number" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <label for="receiver_name" class="form-label">Receiving Personnel</label>
            <input type="text" class="form-control" id="receiver_name" value="{{ $gym->receiver_name }}" name="receiver_name" disabled>
        </div>
        <div class="col-3">
            <label for="cashier_name" class="form-label">Cashier</label>
            <input type="text" class="form-control" id="cashier_name" value="{{ $gym->cashier_name }}" name="cashier_name" disabled>
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