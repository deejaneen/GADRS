<div class="modal fade" id="cartToFormModalGym" tabindex="-1" aria-labelledby="cartToFormModalGymLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-6">
                    <h1 class="modal-title" id="cartToFormModalGymLabel">Gym Reservation Form</h1>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <form id="cartToFormModalGymForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="companyName" class="form-label">Name of Requesting Company</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" required>
                        </div>
                        <div class="col">
                            <label for="nameRepresentative" class="form-label">Name of Representative</label>
                            <input type="text" class="form-control" id="nameRepresentative" name="nameRepresentative" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nameRepresentative" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="col">
                            <label for="contactNumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contactNumber" name="contactNumber" placeholder="(e.g., 09123456789)" maxlength="11" required>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="resetFormGymCartModal()">Clear</button>
                <button type="button" class="btn btn-primary" onclick="confirmation()">Place Reservation</button>

            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="cartToFormModalDorm" tabindex="-1" aria-labelledby="cartToFormModalDormLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-6">
                    <h1 class="modal-title" id="cartToFormModalDormLabel">Dorm Reservation Form</h1>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <form id="cartToFormModalDormForm">
                <div class="modal-body">
                    <div class="row" style="display: none;" id="dormFormNonCoanInfo">
                        <div class="col">
                            <p>One or more of the items you selected are referred for Non-Coan. You need to fill out the
                                Referred By section.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="col">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename" required>
                        </div>
                        <div class="col">
                            <label for="surname" class="form-label">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="office" class="form-label">Office</label>
                            <input type="text" class="form-control" id="office" name="office" required>
                        </div>
                        <div class="col">
                            <label for="office_address" class="form-label">Office Address</label>
                            <input type="text" class="form-control" id="office_address" name="office_address" required>
                        </div>
                        <div class="col">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="contact_number_dorm" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contact_number_dorm" name="contact_number_dorm" placeholder="(e.g., 09123456789)" maxlength="11" required>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="(e.g., example@email.com)" required>
                        </div>
                        <div class="col">
                            <label for="ei_number" class="form-label">Employee ID Number</label>
                            <input type="text" class="form-control" id="ei_number" name="ei_number" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="id_presented" class="form-label">Other ID Presented</label>
                            <input type="text" class="form-control" id="id_presented" name="id_presented" required>
                        </div>
                        <div class="col">
                            <label for="pos" class="form-label">Purpose of Stay</label>
                            <input type="text" class="form-control" id="pos" name="pos" required>
                        </div>
                    </div>
                    <hr class="line-break" style="border-top: 1px solid black;" id="line_break">

                    <p id="title_referred">Referred By</p>
                    <div class="row mb-3" style="" id="COARow1">
                        <div class="col">
                            <label for="coaEm_name" class="form-label">Name of COA Employee</label>
                            <input type="text" class="form-control" id="coaEm_name" name="coaEm_name" required>
                        </div>
                        <div class="col">
                            <label for="coaEm_relationshipGuest" class="form-label">Relationship with Guest</label>
                            <input type="text" class="form-control" id="coaEm_relationshipGuest" name="coaEm_relationshipGuest" required>
                        </div>

                    </div>

                    <div class="row mb-3" style="" id="COARow2">
                        <div class="col">
                            <label for="coaEm_office" class="form-label">Office</label>
                            <input type="text" class="form-control" id="coaEm_office" name="coaEm_office" required>
                        </div>
                        <div class="col">
                            <label for="coaEm_office_address" class="form-label">Office Address</label>
                            <input type="text" class="form-control" id="coaEm_office_address" name="coaEm_office_address" required>
                        </div>
                    </div>
                    <hr class="line-break" style="border-top: 1px solid black;">
                    <p>In Case of Emergency</p>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="ptn" class="form-label">Person to Notify</label>
                            <input type="text" class="form-control" id="ptn" name="ptn" required>
                        </div>

                        <div class="col">
                            <label for="ptn_contact" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="ptn_contact" name="ptn_contact" placeholder="(e.g., 09123456789)" maxlength="11" required>
                        </div>

                        <div class="col">
                            <label for="ptn_home_address" class="form-label">Home Address</label>
                            <input type="text" class="form-control" id="ptn_home_address" name="ptn_home_address" required>
                        </div>

                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="resetFormDormCartModal()">Clear</button>
                <button type="button" class="btn btn-primary" onclick="confirmation()">Place Reservation</button>

            </div>

        </div>
    </div>
</div>