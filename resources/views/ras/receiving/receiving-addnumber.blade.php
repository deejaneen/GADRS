@extends('layout.receivinglayout')
@section('receivingdashboard')
<main>
    <h1>Pending</h1>
</main>
<div class="card" id="ReceivingPendingTableCard">
    <h2>Reservation Details</h2>
    <div class="row mb-3">
        {{-- <div class="col">
            <label for="employee_id" class="form-label" hidden>User ID</label>
            <input type="text" class="form-control" id="employee_id" value="{{ $gym->employee_id }}" name="employee_id" disabled hidden>
    </div> --}}
    <div class="col">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" value="{{ $userDetails->first_name . ' ' . $userDetails->middle_name . ' ' . $userDetails->last_name }}" name="username" disabled>
    </div>
</div>
<hr>
<h2>Gym Reservation Form</h2>
<form id="changeStatusForm" method="post" action="{{ route('changeStatus', $gym->id) }}">
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <div class="col-4">
            @if (!$gym->receiver_name)
            <label for="receiver_name" class="form-label">Receiving Personnel</label>
            <input type="text" class="form-control" id="receiver_name" value="{{ $receivingUser->first_name . ' ' . $receivingUser->middle_name . ' ' . $receivingUser->last_name }}" name="receiver_name" required>
            @error('receiver_name')
            <span class="text-danger fs-6">{{ $message }}</span>
            @enderror
            @else
            <label for="receiver_name" class="form-label">Receiving Personnel</label>
            <input type="text" class="form-control" id="receiver_name" value="{{ $gym->receiver_name }}" name="receiver_name" required>
            @error('receiver_name')
            <span class="text-danger fs-6">{{ $message }}</span>
            @enderror
            @endif

        </div>
        <div class="col-4">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
                <option value="Received" {{ $gym->status === 'Received' ? 'selected' : '' }}>Received</option>
                <option value="Pending" {{ $gym->status === 'Pending' ? 'selected' : '' }}>Pending</option>
            </select>
            @error('status')
            <span class="text-danger fs-6">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div>
        <button type="button" class="btn btn-confirm-payment-gym" id="formSubmitBtn">Save</button>
        <a href="{{ route('receivingpending') }}" class="btn btn-go-back">Back</a>
    </div>
</form>
<div>
    <p>Note: Reservations with similar form group number will automatically be configured as well.</p>
</div>
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

        // Set the fixed year month value for both inputs
        // document.getElementById('fixed-year-reservation').value = `${currentYear}-${currentMonth}-`;
        // document.getElementById('fixed-year-oop').value = `${currentYear}-${currentMonth}-`;

        document.getElementById('formSubmitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Display confirmation dialog
            Swal.fire({
                title: "Do you want to save this changes?",
                text: "Once the status is configured to Received, it will be uneditable.",
                showCancelButton: true,
                confirmButtonText: "Yes",
                customClass: {
                    popup: 'small-modal'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form after confirmation
                    document.getElementById('changeStatusForm').submit();
                }
            });
        });
    });
</script>