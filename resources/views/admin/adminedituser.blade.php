@extends('layout.adminlayout')

@section('admindashboard')
<aside>
    <div class="top">
        <div class="logo">
            <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
            <h2 class="primary-light">COA <span class="danger">CAR</span></h2>
        </div>
        <div class="close" id="close-btn">
            <span class="ri-close-fill"></span>
        </div>

        <div class="sidebar">
            <a href="{{ route('adminhome') }}">
                <span class="ri-dashboard-line ">
                    <h3>Dashboard</h3>
                </span>
            </a>
            <a href="{{ route('adminusers') }}" class="active">
                <span class="ri-team-line">
                    <h3>Users</h3>
                </span>
            </a>
            <a href="{{ route('adminreservations') }}">
                <span class="ri-receipt-line">
                    <h3>Reservations</h3>
                    <span class="message-count">26</span>
                </span>
            </a>
            <a href="{{ route('admingym') }}">
                <span class="ri-basketball-fill">
                    <h3>Gym</h3>
                </span>
            </a>
            <a href="{{ route('admindorm') }}">
                <span class="ri-home-3-line">
                    <h3>Dorm</h3>
                </span>

            </a>
            <a href="{{ route('adminprofile') }}">
                <span class="ri-user-line">
                    <h3>Change Password</h3>
                </span>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form-navbar">
                @csrf

                <button class="no-underline logout btn btn-danger btn-md" type="submit" id="logout-button">
                    <span class="ri-logout-box-r-line">
                        <h3>LOGOUT</h3>
                    </span>
                </button>
            </form>
        </div>
    </div>
</aside>
{{-- -------------------------------END-OF-ASIDE-------------------- --}}
<main>
    <h1 class="page-title">USER EDIT</h1>

    <div class="card" id="AdminUserTableCard">
        <form id="editUserAdminForm" method="POST" action="{{ route('admin.updateUser', $user->id) }}" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                    @error('first_name')
                    <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $user->middle_name }}">
                    @error('middle_name')
                    <span class="text-danger fs-6">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
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
                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $user->contact_number }}">
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
            <div class="modal-footer">
                <button class="btn btn-back-edit"  onclick="goBack()" style="margin-right: 10px">Back</button>
                <button class="btn btn-save-edit-changes" type="submit">Save Changes</button>
            </div>

        </form>
    </div>




    {{-- ------------------END OF INSIGHTS------------------ --}}

</main>


{{-- ------------------END OF MAIN------------------ --}}
<div class="right">
    <div class="top">
        <button id="menu-btn">
            <span class="ri-menu-line"></span>
        </button>

        @auth()
        <div class="profile">
            <div class="info">
                <p>Hey, <b>{{ Auth::user()->first_name }}</b></p>
                <small class="text-muted">{{ Auth::user()->role }}</small>
            </div>
            <div class="profile-photo">
                <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
            </div>
        </div>
        @endauth
    </div>

</div>
@endsection
<script>
    function goBack() {
        window.history.back();
    }
</script>
