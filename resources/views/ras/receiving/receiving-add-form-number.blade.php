@extends('layout.receivinglayout')
@section('receivingdashboard')
<main>
    <h1 style="margin: 1rem 0;">Paid</h1>
</main>
<div class="card" id="ReceivingPendingTableCard">
    <h2>Reservation Details</h2>
    <div class="row mb-3">
        <div class="col">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" value="{{ $userDetails->first_name . ' ' . $userDetails->middle_name . ' ' . $userDetails->last_name }}" name="username" disabled>
        </div>
    </div>
    <hr>
    <h2>Gym Reservation Form</h2>
    <form id="addReservationNumberForm" method="post" action="{{ route('addFormNumberRec', $gym->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-4">
               
                <label for="receiver_name" class="form-label">Add Reservation Number</label>
                <div class="form_number_container">
                    <input type="text" class="form-control fixed-year" id="fixed-year-form" value="" style="width:110px;" disabled>
                    <input type="number" class="form-control" id="reservation_number" maxlength="3" value="{{ $reservationNumber }}" name="reservation_number_input" required>
                </div>
                @error('reservation_number')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                <span class="text-danger fs-6" id="reservation_number_error"></span>
              
            </div>
        </div>

        <div>
            <button type="button" class="btn btn-confirm-payment-gym" id="formSubmitBtn">Save</button>
            <a href="{{ route('receivingpaid') }}" class="btn btn-go-back">Back</a>
        </div>
    </form>
    <div>
        <p>Note: Reservations with similar form group number will automatically be configured as well.</p>
    </div>
</div>
@endsection
<script>

    document.addEventListener('DOMContentLoaded', function() {
        const currentYear = new Date().getFullYear();
        const currentMonth = String(new Date().getMonth() + 1).padStart(2, '0'); // Get the month and pad with leading zero if necessary

        // Set the fixed year month value for the input
        document.getElementById('fixed-year-form').value = `${currentYear}-${currentMonth}-`;

        // Add event listener to the click event of the form submit button
        document.getElementById('formSubmitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action of following the link

            // Reservation Number Handling
            const fixedYearMonth = document.getElementById('fixed-year-form').value;
            const userFormNumber = document.getElementById('reservation_number').value;
            const completeFormNumber = fixedYearMonth + userFormNumber;

            if (!userFormNumber || isNaN(userFormNumber) || userFormNumber.length > 3) {
                document.getElementById('reservation_number_error').textContent = 'Please enter a valid 3-digit form number.';
            } else {
                document.getElementById('reservation_number_error').textContent = '';
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'reservation_number';
                hiddenInput.value = completeFormNumber;
                document.getElementById('addReservationNumberForm').appendChild(hiddenInput);

                // Display confirmation dialog
                Swal.fire({
                    title: "Do you want to assign this reservation number?",
                    text: "Once configured, it will be uneditable.",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    customClass: {
                        popup: 'small-modal'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after confirmation
                        document.getElementById('addReservationNumberForm').submit();
                    }
                });
            }
        });
    });
</script>