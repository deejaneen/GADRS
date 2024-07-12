@extends('layout.weblayout')

@section('content')
<div class="container">
    <div class="card" id="EditDormReservationCard">
        <h2>Edit Dorm Reservation</h2>
        <form action="{{ route('dorm.update', $reservation->id) }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="form-group col-6">
                    <label for="reservation_start_date">Reservation Start Date</label>
                    <input type="date" class="form-control" id="reservation_start_date" name="reservation_start_date"
                        value="{{ $reservation->reservation_start_date }}">
                </div>
                <div class="form-group col-6">
                    <label for="reservation_end_date">Reservation End Date</label>
                    <input type="date" class="form-control" id="reservation_end_date" name="reservation_end_date"
                        value="{{ $reservation->reservation_end_date }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-6">
                    <label for="reservation_start_time">Start Time</label>
                    <input type="time" class="form-control" id="reservation_start_time" name="reservation_start_time"
                        value="{{ $reservation->reservation_start_time }}" disabled>
                </div>
                <div class="form-group col-6">
                    <label for="reservation_end_time">End Time</label>
                    <input type="time" class="form-control" id="reservation_end_time" name="reservation_end_time"
                        value="{{ $reservation->reservation_end_time }}" disabled>
                </div>
            </div>
            <div class="row mb-3">
               
                <div class="form-group col-6">
                    <label for="total_price">Total Price</label>
                    <input type="text" class="form-control" id="total_price" name="total_price"
                        value="{{ $reservation->total_price }}" disabled>
                </div>
                <div class="form-group col-6">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" name="status"
                        value="{{ $reservation->status }}" disabled>
                </div>
            </div>
          
            <button type="submit" class="btn btn-save-password-changes">Update Reservation</button>
            <button class="btn btn-go-back" id="back-button">Back</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        document.getElementById('back-button').addEventListener('click', function(event) {
            event.preventDefault(); 

            Swal.fire({
                title: 'Are you sure?',
                text: "Go back without saving?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, go back',
                cancelButtonText: 'No, stay here'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.history.back(); 
                }
            });
        });
    </script>
@endsection

