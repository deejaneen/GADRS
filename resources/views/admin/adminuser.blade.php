@extends('layout.adminlayout')

@section('admindashboard')
@include('admin.admin-add-user-modal')
<main>
    <h1 class="page-title">USERS</h1>

    <div class="card" id="AdminUserTableCard">
        <div>
            <h4 class="card-header text-center home">User List</h4>
        </div>
        <table class="table-home table-hover stripe" id="AdminUserTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Last Name</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Middle Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Role</th>
                    <th scope="col">Buttons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="table-active">
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->middle_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->contact_number }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="actions-column">
                        <div class="btn-edit-profile-container">
                            <a href="{{ route('admin.editUser', $user->id) }}" class="btn btn-lg btn-edit-profile rounded-pill">
                                <label for="btn-edit-profile" id="btn-edit-profile"> Edit</label>
                            </a>
                        </div>

                        <form class="delete-form-user" id="adminUserIdDelete_{{ $user->id }}" name="admin_user_id_delete" action="{{ route('admin.destroyUser', $user->id) }}" method="POST">
                            @csrf
                            @method('delete')

                            <button class="btn btn-lg rounded-pill btn-delete-profile" onclick="confirmDeleteDorm(event)">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

                <div>

                </div>
                @endforeach
            </tbody>
        </table>
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

    {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
    <div class="sales-analytics">
        <h2>Create New User</h2>

        <div class="item add-product" data-bs-toggle="modal" data-bs-target="#addUserAdminModal">
            <div class="icon">
                <span class="ri-add-line"></span>
            </div>
            <div class="right">
                <div class="info">
                    <h3>ADD NEW USER</h3>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function confirmDeleteDorm(event) {
        event.preventDefault(); // Prevent default form submission

        // Show confirmation dialog
        Swal.fire({
            title: "Are you sure you want to delete this item?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form associated with the clicked button
                const form = event.target.closest(".delete-form-user");
                form.submit();
            }
        });
    }
</script>
@endsection