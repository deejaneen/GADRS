<form id="editUserAdminForm" method="POST" action="{{ route('admin.updateUser', $user->id) }}"
    enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="modal-body">
        <div class="row mb-3">
            {{-- <label for="firstNameEdit" class="form-label">Profile Picture will be here</label> --}}
            {{-- <input id="imageUpload" name="profile_image" type="file" class="form-control"
                style="display: none;">
            <div class="img-circle text-center" onclick="document.getElementById('imageUpload').click()">
                <img id="previewImage" src="{{ $user->getImageURL() }}" alt="">
                <span class="ri-camera-line"></span>
            </div> --}}
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name"
                    value="{{ $user->first_name }}">
                @error('first_name')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <label for="middle_name" class="form-label">Middle Name</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name"
                    value="{{ $user->middle_name }}">
                @error('middle_name')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                    value="{{ $user->last_name }}">
                @error('last_name')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror

            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                @error('email')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror

            </div>
            <div class="col">
                <label for="contact_number" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number"
                    value="{{ $user->contact_number }}">
                @error('contact_number')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
            <div class="col">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role">
                    <option value="Guest" {{ $user->role == 'Guest' ? 'selected' : '' }}>Guest</option>
                    <option value="Cashier" {{ $user->role == 'Cashier' ? 'selected' : '' }}>Cashier
                    </option>
                    <option value="Receiving" {{ $user->role == 'Receiving' ? 'selected' : '' }}>Receiving
                    </option>
                </select>
                @error('role')
                    <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Save Changes</button>
    </div>
    </div>
</form>
