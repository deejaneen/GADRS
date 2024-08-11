<div class="modal fade" id="addRestrictedDateModalGym" tabindex="-1" aria-labelledby="addRestrictedDateModalGymLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-6">
                    <h1 class="modal-title" id="addRestrictedDateModalGymLabel">Date Restriction</h1>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            </div>
            <form id="restrictedDateModalGymForm" method="post" action="{{ route('admin.addrestriction') }}">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dateRestriction" class="form-label">Date to be Restricted</label>
                            <input type="date" class="form-control" id="dateRestriction" name="dateRestriction"
                                min="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="details" class="form-label">Details</label>
                            <input type="text" class="form-control" id="details" name="details" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="Gym">Gym</option>
                                <option value="Dorm">Dorm</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-clear-reservation-modal" onclick="resetFormGymModal()">Clear</button>
                <button type="button" class="btn btn-submit-reservation-modal" onclick="confirmation()">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addAvailableDateModalGym" tabindex="-1" aria-labelledby="addAvailableDateModalGymLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-6">
                    <h1 class="modal-title" id="addAvailableDateModalGymLabel">Add New Date</h1>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            </div>
            <form id="addAvailableDateModalGymForm" method="post" action="{{ route('admin.adddatereservation') }}">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="date_addition" class="form-label">Date to be Added to Available Reservations</label>
                            <input type="date" class="form-control" id="date_addition" name="date_addition"
                                min="{{ date('Y-m-d') }}" required onchange="checkWeekend(this)">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="details" class="form-label">Details</label>
                            <input type="text" class="form-control" id="details" name="details" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="Gym">Gym</option>
                                {{-- <option value="Dorm">Dorm</option> --}}

                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-clear-reservation-modal" onclick="resetFormAddDate()">Clear</button>
                <button type="button" class="btn btn-submit-reservation-modal" onclick="confirmationAdd()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmation() {
        Swal.fire({
            title: "Are you sure you want to add this date to be restricted?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("restrictedDateModalGymForm").submit();
            }
        });
    }

    function resetFormGymModal() {
        var form = document.getElementById("restrictedDateModalGymForm");
        if (form) {
            form.reset(); // Reset the form
        } else {
            console.error("Form not found.");
        }
    }

    function confirmationAdd() {
        Swal.fire({
            title: "Are you sure you want to add this date?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("addAvailableDateModalGymForm").submit();
            }
        });
    }

    function resetFormAddDate() {
        var form = document.getElementById("addAvailableDateModalGymForm");
        if (form) {
            form.reset(); // Reset the form
        } else {
            console.error("Form not found.");
        }
    }

    function checkWeekend(input) {
        const selectedDate = new Date(input.value);
        const day = selectedDate.getUTCDay(); // Get the day of the week (0: Sunday, 6: Saturday)

        if (day === 0 || day === 6) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Date',
                text: 'Weekends are not allowed. Please select a weekday.',
                customClass: {
                    popup: 'small-modal'
                }
            });
            input.value = ""; // Reset the input value
        }
    }
</script>