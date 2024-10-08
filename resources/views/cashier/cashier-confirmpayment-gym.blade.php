@extends('layout.cashierlayout')

@section('cashierdashboard')
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
        <!-- @if($gym->purpose == 'Badminton')
        <div class="col">
            <label for="number_of_courts" class="form-label">Number of Courts</label>
            <input type="text" class="form-control" id="number_of_courts" value="{{ $gym->number_of_courts }}" name="number_of_courts" disabled>
        </div>
        @endif -->
        <div class="col">
            <label for="occupant_type" class="form-label">Occupant Type</label>
            <input type="text" class="form-control" id="occupant_type" value="{{ $gym->occupant_type }}" name="occupant_type" disabled>
        </div>
        <div class="col">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" value="{{ $gym->contact_number }}" name="contact_number" disabled>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <label for="reservation_number" class="form-label">Reservation Number</label>
            <input type="text" class="form-control" id="reservation_number" value="{{ $gym->reservation_number }}" name="reservation_number" disabled>
        </div>
    </div>
    <hr>
    <h2>CONFIRM PAYMENT GYM</h2>
    <form id="addReservationNumberForm" method="post" action="{{ route('cashier.confirmPayGym', $gym->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-4">
                <label for="oop_number" class="form-label">OR Number</label>
                <input type="number" class="form-control" id="oop_number" value="{{ $gym->oop_number }}" name="oop_number" required>
            </div>
            <div class="col-4">
                <label for="or_date" class="form-label">OR Date</label>
                <input type="date" class="form-control" id="or_date" value="{{ $gym->or_date }}" name="or_date" required>
            </div>
        </div>
        <div class="row mb-3">
            <!-- <div class="col-4">
                <label for="price " class="form-label">Price</label>
                <input type="text" class="form-control" id="price " value="{{$gym->price }}" maxlength="12" name="price" required>
                @error('price')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div> -->
            <div class="col-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Received" {{ $gym->status === 'Received' ? 'selected' : '' }}>For Payment</option>
                    <option value="Reserved" {{ $gym->status === 'Reserved' ? 'selected' : '' }}>Paid</option>
                </select>
                @error('status')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4">
                @if(!$gym->cashier_name)
                <label for="cashier_name" class="form-label">Cashier Name</label>
                <input type="text" class="form-control" id="cashier_name" value="{{ $receivingUser->first_name . ' ' . $receivingUser->middle_name . ' ' . $receivingUser->last_name }}" name="cashier_name" required>
                @error('cashier_name')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                @else
                <label for="cashier_name" class="form-label">Cashier Name</label>
                <input type="text" class="form-control" id="cashier_name" value="{{ $gym->cashier_name }}" name="cashier_name" required>
                @error('cashier_name')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                @endif

            </div>

        </div>
        <div>
            <button type="button" class="btn btn-confirm-payment-gym" id="formSubmitBtn">Confirm Payment</button>
            <button class="btn btn-go-back" onclick="goBack()">Back</button>
        </div>
    </form>
    <!-- <div>
        <p>Note: Reservations with similar form group number will automatically be configured as well.</p>
    </div> -->
</div>
@endsection
<script>
    function goBack() {
        window.history.back();
    }

    document.addEventListener('DOMContentLoaded', function() {

        const orNumberInput = document.getElementById('oop_number');

        // Restrict input to numbers only
        orNumberInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
        });

        // Limit the length to 7 characters
        orNumberInput.addEventListener('input', function() {
            if (this.value.length > 7) {
                this.value = this.value.slice(0, 7); // Truncate to 7 characters
            }
        });

        // Optionally prevent pasting non-numeric characters
        orNumberInput.addEventListener('paste', function(e) {
            let pasteData = (e.clipboardData || window.clipboardData).getData('text');
            if (!/^\d*$/.test(pasteData)) {
                e.preventDefault();
            }
        });
        // Function to format the date to YYYY-MM-DD
        function formatDate(date) {
            const d = new Date(date);
            let month = '' + (d.getMonth() + 1);
            let day = '' + d.getDate();
            const year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

        // Get today's date in YYYY-MM-DD format
        const today = formatDate(new Date());

        // Set the min attribute of the date input to today's date
        const orDateInput = document.getElementById('or_date');
        if (orDateInput) {
            orDateInput.setAttribute('min', today);
        }
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