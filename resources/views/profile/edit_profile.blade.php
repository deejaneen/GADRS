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
    <div class="profileview-container">
        @include('profile.leftcolumn_sidebar')
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
                    <input type="text" value="{{ $user->email }}" name="email">
                    <span>Email</span>
                    @error('email')
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="inputBox contact-number">
                    <input type="text" value="{{ $user->contact_number }}" name="contact_number">
                    <span>Contact Number</span>
                    @error('contact_number')
                        <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <button class="btn-save-profile-changes btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
@endsection



