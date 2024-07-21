@extends('layout.adminlayout')

@section('admindashboard')

<main>
    <h1 class="page-title">USER EDIT</h1>

    <div class="card" id="AdminUserTableCard">
        <form id="editUserAdminForm" method="POST" action="{{ route('admin.updateUser', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-body">
                <div class="row mb-3">

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
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
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
                            <option value="Supply" {{ $user->role == 'Supply' ? 'selected' : '' }}>Supply
                            </option>
                        </select>
                        @error('role')
                        <span class="text-danger fs-6">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-back-edit" onclick="goBack()" style="margin-right: 10px">Back</button>
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
<script>
    function goBack() {
        window.history.back();
    }
</script>

@endsection