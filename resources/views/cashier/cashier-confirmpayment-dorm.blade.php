@extends('layout.cashierlayout')

@section('cashierdashboard')
<div class="card" id="ReceivingPendingTableCard">
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
            <label for="gender" class="form-label">Gender</label>
            <input type="text" class="form-control" id="gender" value="{{ $dorm->gender }}" name="gender" disabled>
        </div>
        <div class="col">
            <label for="occupant_type" class="form-label">Occupant Type</label>
            <input type="text" class="form-control" id="occupant_type" value="{{ $dorm->occupant_type }}" name="occupant_type" disabled>
        </div>
        <div class="col">
            <label for="quantity" class="form-label">Beds</label>
            <input type="text" class="form-control" id="quantity" value="{{ $dorm->quantity }}" name="quantity" disabled>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label for="Form_number" class="form-label">Form Number</label>
            <input type="text" class="form-control" id="Form_number" value="{{ $dorm->Form_number }}" name="Form_number" disabled>
        </div>
        <div class="col">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" value="{{ $dorm->contact_number }}" name="contact_number" disabled>
        </div>
        <div class="col">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" value="{{ $dorm->email }}" name="email" disabled>
        </div>
    </div>
    <hr>
    <h2>CONFIRM PAYMENT DORM</h2>
    <form id="addReservationNumberForm" method="post" action="{{ route('cashier.confirmPayDorm', $dorm->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-4">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" value="{{$dorm->price}}" name="price" maxlength="12" required>
                @error('price')
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
                    <option value="Reserved" {{ $dorm->status === 'Reserved' ? 'selected' : '' }}>Reserved</option>
                </select>
                @error('status')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>

        </div>
        <div>
            <button type="button" class="btn btn-confirm-payment-dorm" id="formSubmitBtn">Confirm Payment</button>
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
                title: "Are you sure you want to save these configurations?",
                text: "Once the reservation payment is confirmed(Paid), it will be uneditable.",
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