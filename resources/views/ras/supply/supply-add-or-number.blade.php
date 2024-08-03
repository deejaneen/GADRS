@extends('layout.supplylayout')

@section('supplydashboard')
@include('ras.supply.supply-sidebar')
<main>
    <h1 style="margin: 1rem 0;">Add OR Number</h1>

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
    <form id="addORNumberForm" method="post" action="{{ route('addORNumber', $dorm->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">

            <div class="col-4">
                {{-- Add if here --}}
                <label for="or_number" class="form-label">Add OR Number</label>
                <input type="number" class="form-control" id="or_number" value="{{ $dorm->or_number }}" name="or_number" required>
                @error('or_number')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                <input type="hidden" class="form-control" id="or_date" value="{{ \Carbon\Carbon::now()->toDateString() }}" name="or_date" required>

            </div>
            <div class="col-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Received" {{ $dorm->status === 'Received' ? 'selected' : '' }}>Received</option>
                    <option value="Reserved" {{ $dorm->status === 'Reserved' ? 'selected' : '' }}>Paid</option>
                </select>
                @error('status')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror

            </div>

        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-4">
                <label for="amount_paid" class="form-label">Amount Paid</label>
                <input type="text" class="form-control" id="amount_paid" value="{{ $dorm->total_price }}" name="amount_paid" maxlength="12" required>
                @error('amount_paid')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4">
                @if(!$dorm->cashier_name)
                <label for="cashier_name" class="form-label">OR Number Issued By:</label>
                <input type="text" class="form-control" id="cashier_name" value="{{ $dorm->receiver_name }}" name="cashier_name" required>
                @error('cashier_name')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                @else
                <label for="cashier_name" class="form-label">OR Number Issued By:</label>
                <input type="text" class="form-control" id="cashier_name" value="{{ $dorm->cashier_name }}" name="cashier_name" required>
                @error('cashier_name')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                @endif

            </div>
        </div>
        <div>
            <button type="button" class="btn btn-confirm-payment-gym" id="formSubmitBtn">Update Status</button>
            <a href="{{ route('supplyreservationsrd') }}" class="btn btn-go-back">Back</a>
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
                title: "Do you want to save your changes?",
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