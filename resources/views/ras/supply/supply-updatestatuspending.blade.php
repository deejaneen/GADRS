@extends('layout.supplylayout')

@section('supplydashboard')
@include('ras.supply.supply-sidebar')
<main>
    <h1 style="margin: 1rem 0;">Edit Dorm Reservation Details</h1>

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
    <form id="updateDormStatusForm" method="post" action="{{ route('changeStatusDorm', $dorm->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Received" {{ $dorm->status === 'Received' ? 'selected' : '' }}>Received</option>
                    <option value="Pending" {{ $dorm->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
                @error('status')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror

            </div>
            <div class="col-4">
                @if(!$dorm->receiver_name)
                <label for="receiver_name" class="form-label">Receiving Personnel</label>
                <input type="text" class="form-control" id="receiver_name" value="{{ $receivingUser->first_name . ' ' . $receivingUser->middle_name . ' ' . $receivingUser->last_name }}" name="receiver_name" required>
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
            <button type="button" class="btn btn-confirm-payment-gym" id="formSubmitBtn">Update Status</button>
            <a href="{{ route('supplyreservations') }}" class="btn btn-go-back">Back</a>
        </div>
    </form>
    <!-- <div>
        <p>Note: Reservations with similar form group number will automatically be assigned with this form number(reservation number).</p>
    </div> -->
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {


        // Add event listener to the click event of the form submit button
        document.getElementById('formSubmitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action of following the link

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
                    document.getElementById('updateDormStatusForm').submit();
                }
            });
        });
    });
</script>