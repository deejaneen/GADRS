<div class="modal fade " id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl d-flex align-items-center justify-content-center ">
        <form id="reservationForm" class="modal-content gym-modal">
            <div class="gym-modal-header">
                <h1 class="gym-modal-title" id="exampleModalLabel">GYM RESERVATION</h1>
                <button type="button" class="btn-close gym-modal-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('cart.add') }}" method="post">
                @csrf
                <div class="gym-modal-body">
                    <!-- Your form content goes here -->

                    <div class="container">
                        <div class="row" style="justify-content: center;">
                            <h5>Date</h5>
                            <input type="text" name="selectedDateText" id="selectedDateText"
                                placeholder="No date selected" disabled>
                        </div>
                        <hr>
                        <div class="row">
                            <p>Note: The gym can only be used for sports events such as basketball, volleyball, or
                                badminton. The gym must be booked for a minimum of 2 hours</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Left Column Content -->
                                <h5>Start Time</h5>
                                <div class="time-picker-container">
                                    <label for="timepicker-am">AM Time</label>
                                    <input type="text" id="timepicker-am" name="timepicker-am">
                                    <div class="flatpickr-calendar"></div>
                                </div>
                                <hr>
                                <p>
                                    Minimum of 2 hours
                                </p>

                                <p>
                                    Input a valid time for reservation
                                </p>
                            </div>
                            <div class="col-md-6">
                                <!-- Right Column Content -->
                                <h5>End Time</h5>
                                <div class="time-picker-container">
                                    <label for="timepicker-pm">PM Time</label>
                                    <input type="text" id="timepicker-pm" name="timepicker-pm">
                                    <div class="flatpickr-calendar"></div>
                                </div>
                                <hr>
                                <h5>Reservor</h5>
                                <div class="btn-group" style="min-width: 100%;">
                                    <button class="btn btn-dropdown-modal" type="button" id="reservorDropdownButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Employee
                                    </button>
                                    <ul class="dropdown-menu btn-dropdown-modal"
                                        aria-labelledby="reservorDropdownButton" style="min-width: 100%;">
                                        <li><a class="dropdown-item" data-value="COA Employee">COA
                                                Employee</a></li>
                                        <li><a class="dropdown-item" data-value="Non-COA">Non-COA</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <!-- Use type="reset" to reset the form -->
                    <button type="reset" class="btn btn-clear-cart-gym rounded-btn">Clear</button>
                    <button type="button" class="btn btn-add-cart-gym rounded-btn btn-add-to-cart"
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">Add to Cart</button>
                </div>
            </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Get the current time in AM
    var currentTimeAM = new Date();
    currentTimeAM.setHours(currentTimeAM.getHours() % 12); // Convert to AM time format

    // Initialize the AM time picker with default value, 12-hour format, and min/max times
    var timePickerAM = flatpickr("#timepicker-am", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // Use 12-hour format
        defaultDate: currentTimeAM,
        minTime: "6:00",
        maxTime: "11:59",
    });

    // Initialize the PM time picker with default value and 12-hour format
    var timePickerPM = flatpickr("#timepicker-pm", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // Use 12-hour format
        defaultDate: "12:00",
    });

    // Function to reset the form
    function resetForm() {
        document.getElementById("reservationForm").reset();
        timePickerAM.setDate(currentTimeAM); // Set the AM time picker to default value
        timePickerPM.setDate("12:00"); // Set the PM time picker to default value
    }

    // Add an event listener to window.onload to execute the resetForm function when the page is loaded
    window.onload = function() {
        resetForm();
    };


    // Get the dropdown button and dropdown items
    const dropdownButton = document.getElementById('reservorDropdownButton');
    const dropdownItems = document.querySelectorAll('#reservorDropdownButton + .dropdown-menu .dropdown-item');

    // Add click event listener to each dropdown item
    dropdownItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            const selectedValue = this.getAttribute('data-value');
            dropdownButton.textContent = selectedValue; // Update the dropdown button text
        });
    });
</script>

