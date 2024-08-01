@extends('layout.receivinglayout')
@section('receivingdashboard')
    <main>
        <h1>Received</h1>
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
                <input type="text" class="form-control" id="username"
                    name="username" disabled>
            </div>
        </div>
        <hr>
        <h2>Gym Reservation Form</h2>
        <form id="addReservationNumberForm" method="post" action="">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-4">
                    {{-- Add if here --}}
                        <label for="receiver_name" class="form-label">Add OR Number</label>
                        <input type="text" class="form-control" id="receiver_name"
                            value=""
                            name="receiver_name" required>
                        @error('receiver_name')
                            <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    {{-- Add else here if needed--}}
                    {{-- Add endif here --}}

                </div>
                <div class="col-4">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Received">Received</option>
                        <option value="Pending">Paid</option>
                    </select>
                    @error('status')
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div>
                <button type="button" class="btn btn-confirm-payment-gym" id="formSubmitBtn">Save</button>
                <button class="btn btn-go-back" onclick="goBack()">Back</button>
            </div>
        </form>
        <div>
            <p>Note: Reservations with similar form group number will automatically be configured as well.</p>
        </div>
    </div>
@endsection

