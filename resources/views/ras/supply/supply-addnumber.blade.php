@extends('layout.supplylayout')

@section('supplydashboard')
@include('ras.supply.supply-sidebar')
<!-- <div class="right">
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

</div> -->
<div class="card" id="ReceivingPendingTableCard">
    <h2>User Details</h2>
    <div class="row mb-3">
        <div class="col">
            <label for="employee_id" class="form-label">User ID</label>
            <input type="text" class="form-control" id="employee_id" value="{{ $dorm->employee_id }}" name="employee_id" disabled>
        </div>
        <div class="col">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" value="{{ $userDetails->first_name . ' ' . $userDetails->middle_name . ' ' . $userDetails->last_name }}
" name="username" disabled>
        </div>
    </div>
    <form id="addReservationNumberForm" method="post" action="{{ route('addFormNumber', $dorm->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-4">
                <label for="Form_number" class="form-label">Form Number</label>
                <input type="text" class="form-control" id="Form_number" value="{{$dorm->Form_number}}" name="Form_number" maxlength="7" required>
                @error('Form_number')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <!-- <div class="col">
                <div class="col-4">
                    <input type="hidden" class="form-control" id="status" value="Received" name="status" required>
                </div>
            </div> -->
            <div class="col-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Received" {{ $dorm->status === 'Received' ? 'selected' : '' }}>Received</option>
                    <option value="Pending" {{ $dorm->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
                @error('status')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-4">
                @if(!$dorm->receiver_name)
                <label for="receiver_name" class="form-label">Receiving Personnel</label>
                <input type="text" class="form-control" id="receiver_name" value="{{ $userDetails->first_name . ' ' . $userDetails->middle_name . ' ' . $userDetails->last_name }}" name="receiver_name" required>
                @error('receiver_name')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                @else
                <label for="receiver_name" class="form-label">Receiving Personnel</label>
                <input type="text" class="form-control" id="receiver_name" value="{{ $dorm->receiver_name }}" name="receiver_name" required>
                @error('receiver_name')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                @endif

            </div>
        </div>
        <div>
            <button type="button" class="btn btn-confirm-payment-gym" id="formSubmitBtn">Add Form Number</button>
            <button class="btn btn-go-back" onclick="goBack()">Back</button>
        </div>
    </form>
    <!-- <div>
        <p>Note: Reservations with similar form group number will automatically be assigned with this form number(reservation number).</p>
    </div> -->
</div>
@endsection
<script>
    function goBack() {
        window.history.back();
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener to the click event of the logout button
        document.getElementById('formSubmitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action of following the link

            // Display confirmation dialog
            Swal.fire({
                title: "Are you want to assign this form number?",
                text: "Once the status is configured to Received, they will be uneditable.",
                showCancelButton: true,
                confirmButtonText: "Yes",
                customClass: {
                    popup: 'small-modal'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the logout form after confirmation
                    document.getElementById('addReservationNumberForm').submit();
                }
            });
        });
    });
</script>