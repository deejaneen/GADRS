@extends('layout.weblayout')
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#imageUpload').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection

@section('profileview')
<div class="container py-4">
    <div class="profileview-container">
        <div class="left-column">
            <div class="sidebar">
                <a href="{{ route('profile') }}" class="active">
                    <span class="ri-user-line"></span>
                    <h3>Your Account</h3>
                </a>
                <a href="{{ route('passwordprofile') }}">
                    <span class="ri-key-2-line"></span>
                    <h3>Change Password</h3>
                </a>
                <a href="{{ route('reservationhistoryprofile') }}">
                    <span class="ri-receipt-line"></span>
                    <h3>Reservation History</h3>
                </a>
            </div>
        </div>
        <form enctype="multipart/form-data" method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('put')
            <div class="right-column profile">
                <input id="imageUpload" name="profile_image" type="file" class="form-control" style="display: none;">
                <div class="img-circle text-center" onclick="document.getElementById('imageUpload').click()">
                    <img id="previewImage" src="{{ $user->getImageURL() }}" alt="">
                    <span class="ri-camera-line"></span>
                </div>

                @error('profile_image')
                <span class="text-danger fs-6">{{ $message }}</span>
                @enderror
                <hr>

                <div class="inputBox firstname">
                    <input type="text" value="{{ $user->first_name }}" name="first_name">
                    <span>First Name</span>
                    @error('first_name')
                    <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="inputBox middlename">
                    <input type="text" value="{{ $user->middle_name }}" name="middle_name">
                    <span>Middle Name</span>
                    @error('middle_name')
                    <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="inputBox lastname">
                    <input type="text" value="{{ $user->last_name }}" name="last_name">
                    <span>Last Name</span>
                    @error('last_name')
                    <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="inputBox email">
                    <input type="email" value="{{ $user->email }}" name="email">
                    <span>Email</span>
                    @error('email')
                    <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="inputBox contact-number">
                    <input type="text" value="{{ $user->contact_number }}" name="contact_number" pattern="(09|\+639)\d{9}" title="Enter a valid Philippine phone number" placeholder="(e.g., 09123456789)" maxlength="11">
                    <span>Contact Number</span>
                    <span class="text-danger fs-6" id="contactNumberError"></span>
                </div>

                <button class="btn-save-profile-changes btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection