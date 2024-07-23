@extends('layout.cashierlayout')

@section('cashierdashboard')
    <div class="card" id="ReceivingPendingTableCard">
        <div class="row mb-3">
            <div class="col">
                <label for="reservation_start_date" class="form-label">Reservation Start Date</label>
                <input type="text" class="form-control" id="reservation_start_date"
                    value="{{ date('F j, Y', strtotime($dorm->reservation_start_date)) }}" name="reservation_start_date"
                    disabled>
            </div>
            <div class="col">
                <label for="reservation_start_time" class="form-label">Reservation Start Time</label>
                <input type="text" class="form-control" id="reservation_start_time"
                    value="{{ date('g:i A', strtotime($dorm->reservation_start_time)) }}" name="reservation_start_time"
                    disabled>
            </div>
            <div class="col">
                <label for="reservation_end_date" class="form-label">Reservation End Date</label>
                <input type="text" class="form-control" id="reservation_end_date"
                    value="{{ date('F j, Y', strtotime($dorm->reservation_end_date)) }}" name="reservation_end_date"
                    disabled>
            </div>
            <div class="col">
                <label for="reservation_end_time " class="form-label">Reservation End Time</label>
                <input type="text" class="form-control" id="reservation_end_time "
                    value="{{ date('g:i A', strtotime($dorm->reservation_end_time)) }}" name="reservation_end_time "
                    disabled>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" id="gender" value="{{ $dorm->gender }}" name="gender"
                    disabled>
            </div>
            <div class="col">
                <label for="price" class="form-label">Room Price</label>
                <input type="text" class="form-control" id="price" value="{{ $dorm->price }}" name="price"
                    disabled>
            </div>
            <div class="col">
                <label for="quantity" class="form-label">Beds</label>
                <input type="text" class="form-control" id="quantity" value="{{ $dorm->quantity }}" name="quantity"
                    disabled>
            </div>
            <div class="col">
                <label for="amount" class="form-label">Total Amount to be Paid</label>
                <input type="text" class="form-control" id="amount" value="{{ $dorm->total_price }}" name="amount"
                    disabled>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="occupant_type" class="form-label">Occupant Type</label>
                <input type="text" class="form-control" id="occupant_type" value="{{ $dorm->occupant_type }}"
                    name="occupant_type" disabled>
            </div>
            <div class="col">
                <label for="Form_number" class="form-label">Form Number</label>
                <input type="text" class="form-control" id="Form_number" value="{{ $dorm->Form_number }}"
                    name="Form_number" disabled>
            </div>
            <div class="col">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" value="{{ $dorm->contact_number }}"
                    name="contact_number" disabled>
            </div>
            <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" value="{{ $dorm->email }}" name="email"
                    disabled>
            </div>
        </div>
        <hr>
        <h2>CONFIRM PAYMENT DORM</h2>
        <form id="addReservationNumberForm" method="post" action="{{ route('cashier.confirmPayDorm', $dorm->id) }}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col">
                    <label for="or_number" class="form-label">OR Number</label>
                    <div class="or_number_container">
                        <input type="text" class="form-control fixed-year" id="fixed-year-form" value=""
                            style="width:110px;" disabled>
                        <input type="text" class="form-control" id="or_number" value="{{ $dorm->or_number }}"
                            name="or_number" maxlength="3" required>
                    </div>
                    @error('or_number')
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                    <span class="text-danger fs-6" id="reservation_number_error"></span>
                </div>
                <div class="col">
                    <label for="amount_paid" class="form-label">Amount Paid</label>
                    <input type="text" class="form-control" id="amount_paid" value="{{ $dorm->total_price }}"
                        name="amount_paid" maxlength="12" required>
                    @error('amount_paid')
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="Received" {{ $dorm->status === 'Received' ? 'selected' : '' }}>For Payment</option>
                        <option value="Reserved" {{ $dorm->status === 'Reserved' ? 'selected' : '' }}>Paid</option>
                        <option value="Cancelled" {{ $dorm->status === 'Cancelled' ? 'selected' : '' }}>Cancel</option>
                    </select>
                    <i class="fas fa-chevron-down dropdown-icon cashier-dorm"></i>
                    @error('status')
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <div class="row">
                <div class="col-4">
                    <input type="hidden" class="form-control" id="or_date"
                        value="{{ \Carbon\Carbon::now()->toDateString() }}" name="or_date" required>
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
        const currentYear = new Date().getFullYear();
        const currentMonth = String(new Date().getMonth() + 1).padStart(2,
        '0'); // Get the month and pad with leading zero if necessary

        // Set the fixed year month value for the input
        document.getElementById('fixed-year-form').value = `${currentYear}-${currentMonth}-`;


        // Reservation Number Handling
        const fixedYearMonth = document.getElementById('fixed-year-form').value;
        const userFormNumber = document.getElementById('Form_number').value;
        const completeFormNumber = fixedYearMonth + userFormNumber;

        if (!userFormNumber || isNaN(userFormNumber) || userFormNumber.length > 3) {
            document.getElementById('reservation_number_error').textContent =
                'Please enter a valid 3-digit form number.';
        } else {
            document.getElementById('reservation_number_error').textContent = '';
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'Form_number';
            hiddenInput.value = completeFormNumber;
            document.getElementById('addReservationNumberForm').appendChild(hiddenInput);

            // Submit the form
            document.getElementById('addReservationNumberForm').submit();
        }
        // Add event listener to the click event of the logout button
        document.getElementById('formSubmitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action of following the link

            // Display confirmation dialog
            Swal.fire({
                title: "Are you sure you want to save these configurations?",
                text: "Once the reservation payment is confirmed(Paid) or cancelled(Cancel) it will be uneditable.",
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
