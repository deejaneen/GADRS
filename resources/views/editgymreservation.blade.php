@extends('layout.weblayout')

@section('content')
    <div class="container">
        <div class="card" id="EditGymReservationCard">
            <h2>Edit Gym Reservation</h2>
            <form action="{{ route('gym.update', $reservation->id) }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="form-group col-6">
                        <label for="reservation_date">Reservation Date</label>
                        <input type="date" class="form-control" id="reservation_date" name="reservation_date"
                            value="{{ $reservation->reservation_date }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-6">
                        <label for="reservation_time_start">Start Time</label>
                        <input type="time" class="form-control" id="reservation_time_start" name="reservation_time_start"
                            value="{{ $reservation->reservation_time_start }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="reservation_time_end">End Time</label>
                        <input type="time" class="form-control" id="reservation_time_end" name="reservation_time_end"
                            value="{{ $reservation->reservation_time_end }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-group col-6">
                        <label for="purpose">Purpose</label>
                        <select class="form-select" id="purpose" name="purpose" required>
                            <option value="Basketball" {{ $reservation->purpose === 'Basketball' ? 'selected' : '' }}>Basketball</option>
                            <option value="Volleyball" {{ $reservation->purpose === 'Volleyball' ? 'selected' : '' }}>Volleyball</option>
                            <option value="Badminton" {{ $reservation->purpose === 'Badminton' ? 'selected' : '' }}>Badminton</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="total_price">Total Price</label>
                        <input type="text" class="form-control" id="total_price" name="total_price"
                            value="{{ $reservation->total_price }}" disabled>
                    </div>
                </div>
                <button type="submit" class="btn btn-save-password-changes">Update Reservation</button>
                <button type="button" class="btn btn-go-back" id="back-button">Back</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('back-button').addEventListener('click', function() {
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
