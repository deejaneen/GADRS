@section('scripts')
<script>
    const gymDateAdditions = @json($gymDateAdditions); // Convert PHP array to JavaScript array
    document.addEventListener('DOMContentLoaded', function() {
        const reservationDateInput = document.getElementById('reservationDate');
        const startTimeInput = document.getElementById('startTime');
        const endTimeInput = document.getElementById('endTime');

        function updateTimeFieldsBasedOnDate() {
            const selectedDateStr = reservationDateInput.value; // Get the selected date as a string
            const selectedDate = new Date(selectedDateStr);
            const selectedDay = selectedDate.getDay();

            // Check if the selected date is in gymDateAdditions
            if (gymDateAdditions.includes(selectedDateStr)) {
                startTimeInput.setAttribute('min', '06:00');
                endTimeInput.setAttribute('max', '21:00');
                startTimeInput.value = '06:00'; // Set default start time to 6:00 AM
            } else if (selectedDay >= 1 && selectedDay <= 5) { // Monday to Friday
                startTimeInput.setAttribute('min', '18:00');
                endTimeInput.setAttribute('max', '21:00');
                startTimeInput.value = '18:00'; // Set default start time to 6:00 PM
            } else { // Saturday and Sunday
                startTimeInput.setAttribute('min', '06:00');
                endTimeInput.setAttribute('max', '21:00');
                startTimeInput.value = '06:00'; // Set default start time to 6:00 AM
            }
        }


        // Initialize date picker with jQuery UI
        $("#reservationDate").datepicker({
            dateFormat: 'yy-mm-dd', // Set the date format
            minDate: 0, // Minimum selectable date (today)
            onSelect: function(selectedDate) {
                reservationDateInput.value = selectedDate;
                updateTimeFieldsBasedOnDate();
            }
        });

        // Add event listener to date input to handle manual changes
        reservationDateInput.addEventListener('change', function() {
            updateTimeFieldsBasedOnDate();
        });

        // Initialize the time fields based on the current date
        updateTimeFieldsBasedOnDate();
    });



    document.getElementById('startTime').addEventListener('input', calculateTotalPrice);
    document.getElementById('endTime').addEventListener('input', calculateTotalPrice);
    document.getElementById('employeeType').addEventListener('change', calculateTotalPrice);

    function calculateTotalPrice() {
        const startTime = document.getElementById('startTime').value;
        const endTime = document.getElementById('endTime').value;
        const employeeType = document.getElementById('employeeType').value;

        if (startTime && endTime) {
            const start = new Date(`1970-01-01T${startTime}:00`);
            const end = new Date(`1970-01-01T${endTime}:00`);

            let hours = (end - start) / 1000 / 60 / 60;
            if (hours < 0) {
                hours += 24; // handle overnight reservations
            }

            // const pricePerHour = employeeType === 'COA Employee' ? 450 : 600;
            const pricePerHour = 600;
            const totalPrice = hours * pricePerHour;

            document.getElementById('total_price').value = totalPrice.toFixed(2);
            document.getElementById('hours').value = hours;
            document.getElementById('price').value = pricePerHour;
        }
    }

</script>
<script>
    $(document).ready(function() {
        const weekContainer = document.getElementById("week-container");
        const selectedDateInput = document.getElementById("reservationDate");
        const disabledDates = <?= json_encode($gymDateRestrictions) ?>;
        const startTimeInput = document.getElementById('startTime');
        const endTimeInput = document.getElementById('endTime');


        function updateTimeFieldsBasedOnDate() {
            const selectedDateStr = selectedDateInput.value; // Get the selected date as a string
            const selectedDate = new Date(selectedDateStr);
            const selectedDay = selectedDate.getDay();

            // Check if the selected date is in gymDateAdditions
            if (gymDateAdditions.includes(selectedDateStr)) {
                startTimeInput.setAttribute('min', '06:00');
                endTimeInput.setAttribute('max', '21:00');
                startTimeInput.value = '06:00'; // Set default start time to 6:00 AM
            } else if (selectedDay >= 1 && selectedDay <= 5) { // Monday to Friday
                startTimeInput.setAttribute('min', '18:00');
                endTimeInput.setAttribute('max', '21:00');
                startTimeInput.value = '18:00'; // Set default start time to 6:00 PM
            } else { // Saturday and Sunday
                startTimeInput.setAttribute('min', '06:00');
                endTimeInput.setAttribute('max', '21:00');
                startTimeInput.value = '06:00'; // Set default start time to 6:00 AM
            }
        }

        // Initialize date picker with disabled dates
        $("#datePicker").datepicker({
            dateFormat: 'yy-mm-dd', // Set the date format
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [disabledDates.indexOf(string) == -1];
            },
            minDate: 0, // Minimum selectable date (today)
            onSelect: function(selectedDate) {
                updateTable(selectedDate);
                selectedDateInput.value = selectedDate;
                updateTimeFieldsBasedOnDate();
            }
        });
    });

    // Function to format date in desired format
    function formatDate(dateString) {
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return new Date(dateString).toLocaleDateString('en-US', options);
    }

    // Function to format time in desired format
    function formatTime(timeString) {
        return new Date('1970-01-01T' + timeString).toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit'
        });
    }

    // Function to update the table based on selected date
    function updateTable(selectedDate) {
        fetch('/get-reservations', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    selected_date: selectedDate
                })
            })
            .then(response => response.json())
            .then(data => {
                const weekContainer = document.getElementById("week-container");
                weekContainer.innerHTML = ''; // Clear the container
                if (data.length === 0) {
                    weekContainer.innerHTML = "<p>No reservations for this date.</p>";
                } else {
                    data.forEach(reservation => {
                        let dayBox = document.createElement("div");
                        dayBox.classList.add("day-box");
                        let content =
                            `<h4>${formatDate(reservation.reservation_date)}</h4><ul>`;
                        content +=
                            `<li>${formatTime(reservation.reservation_time_start)} - ${formatTime(reservation.reservation_time_end)}</li>`;
                        // Add more content as needed
                        content += "</ul>";
                        dayBox.innerHTML = content;
                        weekContainer.appendChild(dayBox);
                    });
                }
            })
            .catch(error => console.error('Error fetching reservations:', error));
    }


    function resetForm() {
        var form = document.getElementById("gymReservationForm");
        if (form) {
            form.reset();
            // toggleNumberOfCourts();
        } else {
            console.error("Form not found.");
        }
    }

    // Ensure start time is AM and end time is at least 2 hours ahead
    document.getElementById("startTime").addEventListener("change", function() {
        const reservationDateInput = document.getElementById('reservationDate');
        const selectedDate = new Date(reservationDateInput.value);
        const selectedDay = selectedDate.getDay();
        let minStartTime = '06:00'; // Default start time for Saturday and Sunday

        if (selectedDay >= 1 && selectedDay <= 5) { // Monday to Friday
            minStartTime = '18:00';
            this.value = minStartTime;
        }

        // Replace the value with the minimum start time if it is earlier than the allowed time
        this.value = this.value.replace(/^([0-9]|0[0-5]):([0-5][0-9])/, function(match) {
            return match < minStartTime ? minStartTime : match;
        });

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

    $(document).ready(function() {
        const datePicker = $("#datePicker");
        const reservationDate = $("#reservationDate");
        const disabledDates = <?= json_encode($gymDateRestrictions) ?>;

        // Initialize date picker with disabled dates
        datePicker.add(reservationDate).datepicker({
            dateFormat: 'yy-mm-dd', // Set the date format
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [disabledDates.indexOf(string) == -1];
            },
            minDate: 0 // Minimum selectable date (today)
        });
    });
</script>
@endsection


<section id="reservation-section" class="reservation-section">

    <div class="container centered">

        <div class="container-gym-table" id="calendar_container">
            <div class="button-container">
                <button type="button" class="btn btn-reservation-gym" data-bs-toggle="modal" data-bs-target="#gymReservationModal">
                    Book Reservation
                </button>
                <input type="text" id="datePicker" class="btn btn-calendar-gym" min="{{ date('Y-m-d') }}" placeholder="Select a date">
            </div>
            <h1 id="month-heading" class="h1 text-center"></h1>
            <div class="day-container" id="week-container">
                <!-- Days will be dynamically added here using JavaScript -->
            </div>
        </div>
    </div>
</section>

@include('gym.gym_reservation_modal')