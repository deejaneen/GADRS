<!-- Modal -->
<div class="modal fade" id="gymReservationModal" tabindex="-1" aria-labelledby="gymReservationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-6">
                    <h1 class="modal-title" id="gymReservationModalLabel">Gym Reservation</h1>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            </div>
            <form id="gymReservationForm" action="{{ route('gym_cart.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="reservationDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="reservationDate" name="selectedDateText"
                                required>
                        </div>
                        <div class="col">
                            <label for="startTime" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="startTime" name="timepicker-am" required
                                min="06:00">
                        </div>
                        <div class="col">
                            <label for="endTime" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="endTime" name="timepicker-pm" required
                                max="21:00">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="employeeType" class="form-label">Employee Type</label>
                            <select class="form-select" id="employeeType" name="employee_type" required>
                                <option value="COA Employee">COA Employee</option>
                                <option value="Non-COA">Non-COA</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="purpose" class="form-label">Purpose</label>
                            <select class="form-select" id="purpose" name="purpose" required>
                                <option value="Basketball">Basketball</option>
                                <option value="Volleyball">Volleyball</option>
                                <option value="Badminton">Badminton</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        onclick="resetForm()">Clear</button>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script>

    </script>
@endsection
