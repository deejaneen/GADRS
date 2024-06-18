@extends('layout.receivinglayout')
@section('receivingdashboard')
<!-- @include('ras.receiving.receiving-side-bar') -->
<div class="right">
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

</div>
<div class="card" id="ReceivingPendingTableCard">
    <form id="addReservationNumberForm" method="post" action="{{ route('addFormNumberRec', $gym->id) }}">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-4">
                <label for="reservation_number" class="form-label">Reservation Number</label>
                <input type="text" class="form-control" id="reservation_number" maxlength="7" value="{{$gym->reservation_number}}" name="reservation_number" required>
                @error('reservation_number')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <!-- <div class="col-4">
                <label for="reservation_date" class="form-label">Date</label>
                <input type="date" class="form-control" id="reservation_date" value="{{$gym->reservation_date}}" name="reservation_date" required>
                @error('reservation_date')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div> -->

            <div class="col-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Received" {{ $gym->status === 'Received' ? 'selected' : '' }}>Received</option>
                    <option value="Pending" {{ $gym->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
                @error('status')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="row mb-3">
            <div class="col-4">
                <label for="or_number " class="form-label">OR Number</label>
                <input type="text" class="form-control" id="or_number " value="{{$gym->or_number }}" maxlength="7" name="or_number" required>
                @error('or_number')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-4">
                <label for="or_date " class="form-label">OR Date</label>
                <input type="date" class="form-control" id="or_date " value="{{$gym->or_date }}" name="or_date" required>
                @error('or_date')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-primary" id="formSubmitBtn">Save</button>
            <button class="btn btn-primary" onclick="goBack()">Back</button>
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
        // Add event listener to the click event of the logout button
        document.getElementById('formSubmitBtn').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action of following the link

            // Display confirmation dialog
            Swal.fire({
                title: "Are you sure you want to save these configurations?",
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