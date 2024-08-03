@extends('layout.receivinglayout')
@section('receivingdashboard')
<main>
    <h1>Received</h1>
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
    <form id="addORNumberForm" method="post" action="{{ route('addORNumber', $gym->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-4">
                {{-- Add if here --}}
                <label for="receiver_name" class="form-label">Add OR Number</label>
                <input type="text" class="form-control" id="oop_number" value="{{ $gym->oop_number }}" name="oop_number" required>
                @error('oop_number')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                {{-- Add else here if needed--}}
                {{-- Add endif here --}}
                <input type="hidden" class="form-control" id="or_date" value="{{ \Carbon\Carbon::now()->toDateString() }}" name="or_date" required>
            </div>

            <div class="col-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Received">Received</option>
                    <option value="Reserved">Paid</option>
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
            <button type="button" class="btn btn-confirm-payment-gym" id="formSubmitBtn">Save</button>
            <a href="{{ route('receivingreceived') }}" class="btn btn-go-back">Back</a>
        </div>
    </form>
    <div>
        <p>Note: Reservations with similar form group number will automatically be configured as well.</p>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('formSubmitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Display confirmation dialog
            Swal.fire({
                title: "Do you want to save this changes?",
                text: "Once the status is configured to Paid, it will be uneditable.",
                showCancelButton: true,
                confirmButtonText: "Yes",
                customClass: {
                    popup: 'small-modal'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form after confirmation
                    document.getElementById('addORNumberForm').submit();
                }
            });
        });
    });
</script>
@endsection