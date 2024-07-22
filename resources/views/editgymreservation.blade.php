@extends('layout.weblayout')
@section('scripts')
<script>
    let isFormChanged = false;
    const form = document.getElementById('editReservationForm');
    const originalFormData = new FormData(form);

    form.addEventListener('input', () => {
        const currentFormData = new FormData(form);
        isFormChanged = false;

        for (const [key, value] of originalFormData.entries()) {
            if (value !== currentFormData.get(key)) {
                isFormChanged = true;
                break;
            }
        }
    });

    function showConfirmationDialog(callback) {
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
                callback();
            }
        });
    }

    function handleBeforeUnload(event) {
        if (isFormChanged) {
            event.preventDefault();
            event.returnValue = ''; // Prevent default confirmation dialog
            showConfirmationDialog(() => {
                isFormChanged = false; // Reset form change tracker
                window.removeEventListener('beforeunload', handleBeforeUnload);
                window.history.back(); // Use history.back() to navigate
            });
        }
    }

    window.addEventListener('beforeunload', handleBeforeUnload);

    form.addEventListener('submit', function() {
        window.removeEventListener('beforeunload', handleBeforeUnload);
    });

    document.getElementById('back-button').addEventListener('click', function() {
        showConfirmationDialog(() => {
            window.removeEventListener('beforeunload', handleBeforeUnload);
            // window.history.back();
            window.location.href = '{{ route("home") }}';
        });
    });

    document.querySelectorAll('a').forEach(anchor => {
        anchor.addEventListener('click', function(event) {
            if (isFormChanged) {
                event.preventDefault();
                showConfirmationDialog(() => {
                    window.removeEventListener('beforeunload', handleBeforeUnload);
                    window.location.href = anchor.href;
                });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('reservation_date').setAttribute('min', today);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const purposeSelect = document.getElementById('purpose');
        const numberOfCourtsWrapper = document.getElementById('number_of_courts_wrapper');

        function toggleNumberOfCourts() {
            var purpose = document.getElementById('purpose').value;
            var numberOfCourtsWrapper = document.getElementById('number_of_courts_wrapper');
            var numberOfCourtsInput = document.getElementById('number_of_courts');

            if (purpose === 'Badminton') {
                numberOfCourtsWrapper.style.display = 'block';
                numberOfCourtsInput.required = true; // Add required attribute
            } else {
                numberOfCourtsWrapper.style.display = 'none';
                numberOfCourtsInput.required = false; // Remove required attribute
            }
        }

        // Initialize visibility on page load
        toggleNumberOfCourts();

        // Add event listener for changes
        purpose.addEventListener('change', toggleNumberOfCourts);
    });


    // Ensure start time is AM and end time is at least 2 hours ahead
    document.getElementById("reservation_time_start").addEventListener("change", function() {
        this.value = this.value.replace(/^([0-9]|0[0-5]):([0-5][0-9])/, "06:00");
        validateDuration();
        // Update minimum value for end time
        updateMinEndTime();
    });

    document.getElementById("reservation_time_end").addEventListener("change", function() {
        if (this.value <= document.getElementById("reservation_time_start").value) {
            this.value = "";
            alert("End time must be after the start time.");
            return;
        }
        validateDuration();
    });

    // Update minimum value for end time based on selected start time
    function updateMinEndTime() {
        var startTime = document.getElementById("reservation_time_start").value;
        var minEndTime = addHours(startTime, 2); // Adding 2 hours to the start time
        document.getElementById("reservation_time_end").min = minEndTime;
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
        var startTime = document.getElementById("reservation_time_start").valueAsDate;
        var endTime = document.getElementById("reservation_time_end").valueAsDate;
        if (startTime && endTime && startTime < endTime) {
            var duration = (endTime - startTime) / (1000 * 60 * 60); // Duration in hours
            if (duration < 2) {
                alert("The reservation must be at least 2 hours long. Please select a valid end time.");
                document.getElementById("reservation_time_end").value = ""; // Reset end time
            }
        }
    }

    document.getElementById('reservation_time_start').addEventListener('change', calculateTotalPrice);
        document.getElementById('reservation_time_end').addEventListener('change', calculateTotalPrice);

        function calculateTotalPrice() {
            let startTime = document.getElementById('reservation_time_start').value;
            let endTime = document.getElementById('reservation_time_end').value;
            const employeeType = document.getElementById('employee_type').value;

            console.log('Start time:', startTime);
            console.log('End time:', endTime);

            // Handle default time format with seconds
            if (startTime.length === 8) {
                startTime = startTime.substring(0, 5);
            }
            if (endTime.length === 8) {
                endTime = endTime.substring(0, 5);
            }

            if (startTime && endTime) {
                const start = new Date(`1970-01-01T${startTime}:00`);
                const end = new Date(`1970-01-01T${endTime}:00`);

                let hours = (end - start) / 1000 / 60 / 60;
                if (hours < 0) {
                    hours += 24; // handle overnight reservations
                }

                const pricePerHour = employeeType === 'COA Employee' ? 450 : 600;
                const totalPrice = hours * pricePerHour;

                document.getElementById('total_price').value = totalPrice.toFixed(2);
            }
        }
</script>
@endsection
@section('content')
<div class="container">
    <div class="card" id="EditGymReservationCard">
        <h2>Edit Gym Reservation</h2>
        <form id="editReservationForm" action="{{ route('gym.update', $reservation->id) }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="form-group col-6">
                    <label for="reservation_date">Reservation Date</label>
                    <input type="date" class="form-control" id="reservation_date" name="reservation_date" value="{{ $reservation->reservation_date }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-6">
                    <label for="reservation_time_start">Start Time</label>
                    <input type="time" class="form-control" id="reservation_time_start" name="reservation_time_start" value="{{ $reservation->reservation_time_start }}" required min="06:00">
                </div>
                <div class="form-group col-6">
                    <label for="reservation_time_end">End Time</label>
                    <input type="time" class="form-control" id="reservation_time_end" name="reservation_time_end" value="{{ $reservation->reservation_time_end }}" required max="21:00">
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
                    <input type="text" class="form-control" id="total_price" name="total_price" value="{{ $reservation->total_price }}" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group col-6" id="number_of_courts_wrapper" style="display: none;">
                    <label for="number_of_courts" class="form-label">Number of courts</label>
                    <input type="number" class="form-control" id="number_of_courts" name="number_of_courts" min="1" max="4" value="{{ $reservation->number_of_courts }}" required>
                </div>

                <div class="col">
                    <input type="hidden" class="form-control" id="employee_type" name="employee_type" value="{{ $reservation->employee_type }}">
                </div>
            </div>
            <button type="submit" class="btn btn-save-password-changes">Update Reservation</button>
            <button type="button" class="btn btn-go-back" id="back-button">Back</button>
        </form>
    </div>
</div>
@endsection