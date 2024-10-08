<!-- Modal -->
<div class="modal fade" id="gymReservationModal" tabindex="-1" aria-labelledby="gymReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-6">
                    <h1 class="modal-title" id="gymReservationModalLabel">Gym Reservation</h1>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <form id="gymReservationForm" action="{{ route('gym_cart.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="reservationDate" class="form-label">Date</label>
                            <input type="text" class="form-control" id="reservationDate" name="selectedDateText" placeholder="Select a date" required>
                        </div>
                        <div class="col">
                            <label for="startTime" class="form-label">Start Time</label>
                            <input type="time" class="form-control" id="startTime" name="timepicker-am" required>
                        </div>
                        <div id="timeWarning" class="alert alert-warning d-none" role="alert">
                            Please select a time no earlier than 6:00 PM.
                        </div>

                        <div class="col">
                            <label for="endTime" class="form-label">End Time</label>
                            <input type="time" class="form-control" id="endTime" name="timepicker-pm" required >
                        </div>
                    </div>
                    <div class="row">
                        <p> Monday-Friday: 6:00 PM - 9:00 PM</p>
                        <p> Saturday-Sunday: 6:00 AM – 9:00 PM(Including Holidays, if permitted)</p>


                    </div>


                    <div class="row mb-3">
                        <div class="col">
                            <label for="employeeType" class="form-label">Employee Type</label>
                            <div class="dropdown-container">
                                <select class="form-select" id="employeeType" name="employee_type" required>
                                    <option value="COA Employee">COA Employee</option>
                                    <option value="Non-COA">Non-COA</option>
                                </select>
                            </div>
                            <p>Non-COA max end time is 8:00 PM, COA employee is 9:00 PM.</p>
                        </div>
                        <div class="col">
                            <label for="purpose" class="form-label">Purpose</label>
                            <div class="dropdown-container">
                                <!-- <select class="form-select" id="purpose" name="purpose" required onchange="toggleNumberOfCourts()"> -->
                                <select class="form-select" id="purpose" name="purpose" required>
                                    <option value="Basketball">Basketball</option>
                                    <option value="Volleyball">Volleyball</option>
                                    <option value="Badminton">Badminton</option>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="row mb-3" style="margin-left: 2px;">
                            <div class="col"></div>
                            <div class="col" id="number_of_courts_wrapper" style="display: none;">
                                <label for="number_of_courts" class="form-label">Number of courts</label>
                                <input type="number" class="form-control" id="number_of_courts" name="number_of_courts" min="1" max="4" required>
                            </div>
                        </div> -->

                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="hours" class="form-label">Hours</label>
                            <input type="text" class="form-control" id="hours" name="hours" value="" readonly>
                        </div>
                        <div class="col-4">
                            <label for="price" class="form-label">Price per hour</label>
                            <input type="text" class="form-control" id="price" name="price" value="" readonly>
                        </div>
                        <div class="col-4">
                            <label for="total_price" class="form-label">Total Price</label>
                            <input type="text" class="form-control" id="total_price" name="total_price" value="" required readonly>
                        </div>
                        <h4>PRICE</h4>
                        <p>₱600.00</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="resetForm()">Clear</button>
                    <button type="submit" class="btn btn-primary">Add Reservation</button>
                </div>
            </form>
        </div>
    </div>
</div>