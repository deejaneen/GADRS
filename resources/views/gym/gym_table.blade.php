<section id="reservation-section" class="mt-4">
    <div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Book Reservation
    </button>
    </div>
    <div class="container" id="calendar_container">
        <hr>
        <h1 id="month-heading" class="h1 text-center"></h1>
        <div class="day-container" id="week-container">
            <!-- Days will be dynamically added here using JavaScript -->
        </div>
        <hr>
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
        let endTime = 20;

        // Get the container elements
        let weekContainer = document.getElementById("week-container");
        let monthHeading = document.getElementById("month-heading");

        // Set the heading to the current month
        let monthOptions = {
            month: 'long'
        };
        let currentMonth = currentDate.toLocaleDateString('en-US', monthOptions);
        monthHeading.textContent = currentMonth;

        // Days of the week
        let daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        // Loop through the next 7 days
        for (let i = 0; i < 7; i++) {
            // Calculate the date for the current day
            let currentDay = new Date();
            currentDay.setDate(currentDate.getDate() + i);

            // Create a new day-box element
            let dayBox = document.createElement("div");
            dayBox.classList.add("day-box");

            // Format the date and get the day of the week
            let formattedDate = currentDay.toLocaleDateString('en-US', {
                month: 'numeric',
                day: 'numeric',
                weekday: 'short'
            });

            // Check if there's a line break character in the formattedDate
            let hasLineBreak = formattedDate.includes('\n');

            // Create content for the day-box
            let content = `<h4>${hasLineBreak ? formattedDate : formattedDate.replace(' ', '\n')}</h4><ul>`;

            for (let hour = startTime; hour <= endTime; hour++) {
                // Check if the hour is reserved (you need to implement this logic)
                // Example: If the current hour is reserved, display it
                // Replace this with your actual logic to determine reservation status
                // For demonstration purposes, I'm assuming all hours are unreserved initially
                if (hour % 2 === 0) {
                    let startHour = hour;
                    let endHour = hour + 1;
                    let timeSlot = `${formatHour(startHour)}-${formatHour(endHour)} ${hour < 12 ? 'AM' : 'PM'}`;
                    let reservationStatus = 'reserved';

                    content += `<li class="hour ${reservationStatus}">${timeSlot} \n ${reservationStatus.charAt(0).toUpperCase() + reservationStatus.slice(1)}</li>`;
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

    });

    function formatHour(hour) {
        // Format hour to 12-hour format
        return hour % 12 === 0 ? 12 : hour % 12;
    }
</script>