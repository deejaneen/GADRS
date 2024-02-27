<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl d-flex align-items-center justify-content-center">
        <form id="reservationForm" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your form content goes here -->
                <div class="container">
                    <div class="container">
                        <div class="row" style="justify-content: center;">
                            <h5>Date</h5>
                            <div class="btn-group" style="min-width: 100%;">
                                <button class="btn btn-secondary rounded-btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 100%;" id="date-dropdown">
                                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <p>Note: The gym can only be used for sports events such as basketball, volleyball, or badminton. The gym must be booked for a minimum of 2 hours</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Left Column Content -->
                                <h5>Start Time</h5>
                                <div class="btn-group" style="min-width: 100%;">
                                    <button class="btn btn-secondary rounded-btn" type="button" id="startTimeDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="startTimeDropdownButton" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                    </ul>
                                </div>
                                <hr>
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="color: red;" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    Minimum of 2 hours
                                </p>

                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="color: red;" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                    </svg>
                                    Input a valid time for reservation
                                </p>
                            </div>
                            <div class="col-md-6">
                                <!-- Right Column Content -->
                                <h5>End Time</h5>
                                <div class="btn-group" style="min-width: 100%;">
                                    <button class="btn btn-secondary rounded-btn" type="button" id="endTimeDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="endTimeDropdownButton" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                    </ul>
                                </div>
                                <hr>
                                <h5>Reservor</h5>
                                <div class="btn-group" style="min-width: 100%;">
                                    <button class="btn btn-secondary" type="button" id="reservorDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Employee
                                    </button>
                                    <ul class="dropdown-menu " aria-labelledby="reservorDropdownButton" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <!-- Use type="reset" to reset the form -->
                <button type="reset" class="btn btn-primary rounded-btn">Clear</button>
                <button type="button" class="btn btn-primary rounded-btn btn-add-to-cart" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">Add to Cart</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Store the selected values for dropdown menus
        let selectedDateValue;

        // Add an event listener to the form for reset handling
        document.getElementById("reservationForm").addEventListener("reset", function(event) {
            // Prevent the actual form submission
            event.preventDefault();

            // Store the selected value for the date dropdown
            selectedDateValue = document.getElementById("date-dropdown").value;

            // Manually reset form elements
            document.getElementById("reservationForm").reset();

            // Restore the selected value for the date dropdown
            document.getElementById("date-dropdown").value = selectedDateValue;

            // You can update the modal title or other elements as needed
            document.getElementById("exampleModalLabel").textContent = 'Modal title';
            // ...
        });
    });
</script>