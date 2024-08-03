@extends('layout.supplylayout')

@section('supplydashboard')
@include('ras.supply.supply-sidebar')
<main>
    <h1 style="margin: 1rem 0;">Add Form Number</h1>

</main>
<div class="card" id="ReceivingPendingTableCard">
    <h2>User Details</h2>
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
    <form id="addFormNumberForm" method="post" action="{{ route('addFormNumber', $dorm->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">

            <div class="col-4">
                {{-- Add if here --}}
                <label for="receiver_name" class="form-label">Add Form Number</label>
                <div class="form_number_container">
                    <input type="text" class="form-control fixed-year" id="fixed-year-form" value="" style="width:110px;" disabled>
                    <input type="number" class="form-control" id="Form_number" name="Form_number" maxlength="3" value="{{ $formNumberInput }}" required>
                </div>
                @error('Form_number')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                <span class="text-danger fs-6" id="reservation_number_error"></span>
                {{-- Add else here if needed--}}
                {{-- Add endif here --}}

            </div>
        </div>
        <hr>
        <div>
            <button type="button" class="btn btn-confirm-payment-gym" id="formSubmitBtn">Add Form Number</button>
            <a href="{{ route('supplypaid') }}" class="btn btn-go-back">Back</a>
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
        const currentMonth = String(new Date().getMonth() + 1).padStart(2, '0'); // Get the month and pad with leading zero if necessary

        // Set the fixed year month value for the input
        document.getElementById('fixed-year-form').value = `${currentYear}-${currentMonth}-`;

        // Add event listener to the click event of the form submit button
        document.getElementById('formSubmitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action of following the link

            // Reservation Number Handling
            const fixedYearMonth = document.getElementById('fixed-year-form').value;
            const userFormNumber = document.getElementById('Form_number').value;
            const completeFormNumber = fixedYearMonth + userFormNumber;

            if (!userFormNumber || isNaN(userFormNumber) || userFormNumber.length > 3) {
                document.getElementById('reservation_number_error').textContent = 'Please enter a valid 3-digit form number.';
            } else {
                document.getElementById('reservation_number_error').textContent = '';
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'Form_number';
                hiddenInput.value = completeFormNumber;
                document.getElementById('addFormNumberForm').appendChild(hiddenInput);

                // Display confirmation dialog
                Swal.fire({
                    title: "Do you want to assign this form number?",
                    text: "Once the status is configured to Received, it will be uneditable.",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    customClass: {
                        popup: 'small-modal'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form after confirmation
                        document.getElementById('addFormNumberForm').submit();
                    }
                });
            }
        });
    });
</script>