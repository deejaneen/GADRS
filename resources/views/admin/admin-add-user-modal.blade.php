<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@if ($errors->any())
<script>
    // Add this script to reopen the modal on page load if there are validation errors
    $(document).ready(function() {
        $('#addUserAdminModal').modal('show');
    });
</script>
@endif
<div class="modal fade" id="addUserAdminModal" tabindex="-1" aria-labelledby="addUserAdminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-6">
                    <h1 class="modal-title" id="addUserAdminModalLabel">Create New User</h1>
                </div>
                <div class="col-6 text-end">
                    <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.createUser') }}" method="post" id="createUserForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name"  class="form-control">
                            @error('first_name')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name"  class="form-control">
                            @error('middle_name')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name"  class="form-control">
                            @error('last_name')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                            @enderror
                        </div>


                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"  class="form-control">
                            @error('email')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password"  class="form-control">
                            @error('password')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="confirm-password"  class="form-control">
                            @error('confirm-password')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- <button type="submit" name="submit" class="btn" value="submit">Register</button> -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="resetFormGymModal()">Clear</button>
                <button type="button" class="btn btn-primary" onclick="confirmation()">Create User</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function confirmation() {
        Swal.fire({
            title: "Are you sure you want to create this new user?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("createUserForm").submit();
            }
        });
    }

    function resetFormGymModal() {
        var form = document.getElementById("createUserForm");
        if (form) {
            form.reset(); // Reset the form
        } else {
            console.error("Form not found.");
        }
    }
</script>
