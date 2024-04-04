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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        onclick="resetForm()">Clear</button>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function resetForm() {
        document.getElementById("gymReservationForm").reset();
    }

    // Set minimum date to the present day
    document.getElementById("reservationDate").min = new Date().toISOString().split('T')[0];

    // Ensure start time is AM and end time is at least 2 hours ahead
    document.getElementById("startTime").addEventListener("change", function() {
        this.value = this.value.replace(/^([0-9]|0[0-5]):([0-5][0-9])/, "06:00");
        validateDuration();
        // Update minimum value for end time
        updateMinEndTime();
    });

    document.getElementById("endTime").addEventListener("change", function() {
        if (this.value <= document.getElementById("startTime").value) {
            this.value = "";
            alert("End time must be after the start time.");
            return;
        }
        validateDuration();
    });

    // Update minimum value for end time based on selected start time
    function updateMinEndTime() {
        var startTime = document.getElementById("startTime").value;
        var minEndTime = addHours(startTime, 2); // Adding 2 hours to the start time
        document.getElementById("endTime").min = minEndTime;
    }

    // Function to add hours to a given time
    function addHours(time, hours) {
        var parts = time.split(':');
        var hour = parseInt(parts[0], 10);
        var minute = parseInt(parts[1], 10);
        hour += hours;
        if (hour >= 24) hour -= 24;
        return (hour < 10 ? '0' : '') + hour + ':' + (minute < 10 ? '0' : '') + minute;
    }

    // Validate duration
    function validateDuration() {
        var startTime = document.getElementById("startTime").valueAsDate;
        var endTime = document.getElementById("endTime").valueAsDate;
        if (startTime && endTime && startTime < endTime) {
            var duration = (endTime - startTime) / (1000 * 60 * 60); // Duration in hours
            if (duration < 2) {
                alert("The reservation must be at least 2 hours long. Please select a valid end time.");
                document.getElementById("endTime").value = ""; // Reset end time
            }
        }
    }
</script>
@endsection
