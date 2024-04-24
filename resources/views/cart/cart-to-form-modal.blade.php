<div class="modal fade" id="cartToFormModal" tabindex="-1" aria-labelledby="cartToFormModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-6">
                    <h1 class="modal-title" id="cartToFormModalModalLabel">Reservation Form</h1>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
            </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="reservationDate" class="form-label">Name of Requesting Company</label>
                            <input type="text" class="form-control" id="companyName" name="companyName"
                                required>
                        </div>
                        <div class="col">
                            <label for="startTime" class="form-label">Name of Representative</label>
                            <input type="text" class="form-control" id="nameRepresentative" name="nameRepresentative" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="startTime" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="col">
                            <label for="startTime" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contactNumber" name="contactNumber" required pattern="(\+?63|0)[.-\s]?(\d{3})[.-\s]?(\d{4})$" title="Please enter a valid Philippine contact number">
                        </div>
                        {{-- <div class="col">
                            <label for="purpose" class="form-label">Purpose</label>
                            <select class="form-select" id="purpose" name="purpose" required>
                                <option value="Basketball">Basketball</option>
                                <option value="Volleyball">Volleyball</option>
                                <option value="Badminton">Badminton</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="resetFormGymCartModal()">Clear</button>
                    <button type="button" class="btn btn-primary" onclick="confirmation()">Place Reservation</button>

                </div>

        </div>
    </div>
</div>

