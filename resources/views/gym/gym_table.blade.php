<section id="reservation-section" class="mt-4">
    <div class="container">
        <div class="container-gym-table" id="calendar_container">
            <div class="button-container">
                <button type="button" class="btn btn-reservation-gym" data-bs-toggle="modal"
                    data-bs-target="#gymReservationModal">
                    Book Reservation
                </button>
                <input type="date" id="datePicker" class="btn btn-calendar-gym" min="<?php echo date('Y-m-d'); ?>">
            </div>
            <h1 id="month-heading" class="h1 text-center"></h1>
            <div class="day-container" id="week-container">
                <!-- Days will be dynamically added here using JavaScript -->
            </div>
        </div>
    </div>

</section>
@include('gym.gym_reservation_modal')
@include('cart_sidebar')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get today's date
        let currentDate = new Date();
        // Adjust the start time and end time
        let startTime = 6;
        let endTime = 21;

        // Get the container elements
        let weekContainer = document.getElementById("week-container");
        let monthHeading = document.getElementById("month-heading");
        let dateInput = document.getElementById("datePicker");
        let modalTitle = document.getElementById("gymReservationModalLabel");
        let selectedDateInput = document.getElementById("reservationDate");

        // Set the heading to the current month
        let monthOptions = {
            month: 'long'
        };
        let currentMonth = currentDate.toLocaleDateString('en-US', monthOptions);
        monthHeading.textContent = currentMonth;

        // Function to update the table based on selected date
        function updateTable(selectedDate) {
            // Clear the week container
            weekContainer.innerHTML = '';

            // Days of the week
            let daysOfWeek = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];

            // Loop through the next 7 days starting from the selected date
            for (let i = 0; i < 7; i++) {
                // Calculate the date for the current day
                let currentDay = new Date(selectedDate);
                currentDay.setDate(currentDay.getDate() + i);

                // Format the date with the desired format for the day-box
                let formattedDateDayBox = daysOfWeek[currentDay.getDay()] + ', ' +
                    (currentDay.getMonth() + 1) + '/' + currentDay.getDate();

                // Create a new day-box element
                let dayBox = document.createElement("div");
                dayBox.classList.add("day-box");

                // Create content for the day-box
                let content = `<h4>${formattedDateDayBox}</h4><ul>`;

                for (let hour = startTime; hour <= endTime; hour++) {
                    // Check if the hour is reserved (you need to implement this logic)
                    // Example: If the current hour is reserved, display it
                    // Replace this with your actual logic to determine reservation status
                    // For demonstration purposes, I'm assuming all hours are unreserved initially
                    if (hour % 2 === 0) {
                        let startHour = hour;
                        let endHour = hour + 1;
                        let timeSlot =
                            `${formatHour(startHour)}-${formatHour(endHour)} ${hour < 12 ? 'AM' : 'PM'}`;
                        let reservationStatus = 'reserved';

                        content +=
                            `<li class="hour ${reservationStatus}">${timeSlot} \n ${reservationStatus.charAt(0).toUpperCase() + reservationStatus.slice(1)}</li>`;
                        // Add a line between hours (except for the last hour)
                        if (hour < endTime) {
                            content += `<hr class="hour-divider" >`;
                        }
                    }
                }

                content += "</ul>";

                // Set the innerHTML of the day-box
                dayBox.innerHTML = content;

                // Append the day-box to the week container
                weekContainer.appendChild(dayBox);
            }
        }

        // Add an event listener to the date input field
        dateInput.addEventListener("change", function(event) {
            // Get the selected date and update the table
            let selectedDate = event.target.value;
            updateTable(selectedDate);

            // Update the modal title
            modalTitle.textContent = `Gym Reservation for ${selectedDate}`;
            selectedDateInput.value = `${selectedDate}`;
        });

        // Function to format hour to 12-hour format
        function formatHour(hour) {
            return hour % 12 === 0 ? 12 : hour % 12;
        }

        // Reset date input content on page load
        dateInput.value = '';

        // Initialize the table with the current date
        updateTable(currentDate.toLocaleDateString('en-US'));

    });
</script>
