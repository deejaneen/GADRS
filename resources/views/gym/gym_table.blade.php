<section id="reservation-section" class="reservation-section">
    <div class="container centered">

        <div class="container-gym-table" id="calendar_container">
            <div class="button-container">
                <button type="button" class="btn btn-reservation-gym" data-bs-toggle="modal"
                    data-bs-target="#gymReservationModal">
                    Book Reservation
                </button>
                <input type="date" id="datePicker" class="btn btn-calendar-gym" min="{{ date('Y-m-d') }}">
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
        let weekContainer = document.getElementById("week-container");
        let dateInput = document.getElementById("datePicker");
        let modalTitle = document.getElementById("gymReservationModalLabel");
        let selectedDateInput = document.getElementById("reservationDate");

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

        dateInput.addEventListener("change", function(event) {
            let selectedDate = event.target.value;
            updateTable(selectedDate);
            modalTitle.textContent = `Gym Reservation for ${formatDate(selectedDate)}`;
            selectedDateInput.value = `${selectedDate}`;
        });

        // Reset date input content on page load
        dateInput.value = '';

        // Initialize the table with the current date
        const today = new Date().toISOString().split('T')[0];
        updateTable(today);
        modalTitle.textContent = `Gym Reservation for ${formatDate(today)}`;
        selectedDateInput.value = `${today}`;
    });
</script>
