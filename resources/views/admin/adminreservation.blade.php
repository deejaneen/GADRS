@extends('layout.adminlayout')
@section('admindashboard')
@include('admin.admin_reservation_modals')
<!-- <aside>
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
                <a href="{{ route('adminusers') }}">
                    <span class="ri-team-line">
                        <h3>Users</h3>
                    </span>
                </a>
                <a href="{{ route('adminreservations') }}" class="active">
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
    </aside> -->
{{-- -------------------------------END-OF-ASIDE-------------------- --}}
<main>
    <h1 class="page-title">RESERVATIONS DATES THAT CANNOT BE BOOKED</h1>
    <div class="card" id="AdminGymReservationTableCard">
        <div>
            <h2 class="card-header text-center home">Gym Dates Restricted</h2>
        </div>
        <table class="table-home table-hover stripe" id="AdminGymReservationTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Restricted Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Buttons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gymDateRestrictions as $gymDateRestriction)
                <tr class="table-active">
                    <td>{{ date('F j, Y', strtotime($gymDateRestriction->restricted_date)) }}</td>
                    <td>{{ $gymDateRestriction->description }}</td>
                    <td>
                        <form class="delete-form-dateRestrictGym" id="dateRestrictionDelete" name="dateRestrictionDelete" action="{{ route('admin.destroyDateRestriction', $gymDateRestriction->id) }}" method="POST">
                            @csrf
                            @method('delete')

                            <button class="btn btn-delete-profile rounded-pill" id="gymRestrictTableDeletebtn" onclick="confirmDeleteGym(this.form)">
                                Delete
                            </button>


                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card" id="AdminDormReservationTableCard">
        <div>
            <h2 class="card-header text-center home">Dorm Dates Restricted</h2>
        </div>
        <table class="table-home table-hover stripe" id="AdminDormReservationTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Restricted Date</th>
                    <th scope="col">Description</th>
                    <th scope="col">Buttons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dormDateRestrictions as $dormDateRestriction)
                <tr class="table-active">
                    <td>{{ date('F j, Y', strtotime($dormDateRestriction->restricted_date)) }}</td>
                    <td>{{ $dormDateRestriction->description }}</td>
                    <td>
                        <form class="delete-form-dateRestrictDorm" id="dateRestrictionDelete" name="dateRestrictionDelete" action="{{ route('admin.destroyDateRestriction', $dormDateRestriction->id) }}" method="POST">
                            @csrf
                            @method('delete')

                            <button class="btn btn-delete-profile rounded-pill" id="RestrictTableDeletebtn" onclick="confirmDeleteDorm(this.form)">
                                Delete
                            </button>


                        </form>
                    </td>
                </tr>
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
        <h2>Add Reservation Dates</h2>
        <div class="item add-product" class="right" data-bs-toggle="modal" data-bs-target="#addRestrictedDateModalGym">
            <div class="icon">
                <span class="ri-add-line"></span>
            </div>
            <div>
                <div class="info">
                    <h3>ADD NEW DATE RESTRICTIONS</h3>
                </div>
            </div>
        </div>
        {{-- <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD NEW DORM DATE ONLY</h3>
                        <span class="ri-hotel-bed-fill"></span>
                    </div>
                </div>
            </div>
            <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD DATE FOR BOTH</h3>
                        <span class="ri-basketball-fill"></span>
                        <span class="ri-hotel-bed-fill"></span>
                    </div>
                </div>
            </div> --}}
    </div>
</div>

<script>
    function confirmDeleteDorm(form) {
        event.preventDefault(); // Prevent default form submission

        // Show confirmation dialog
        Swal.fire({
            title: "Are you sure you want to delete this Dorm date item?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form
                form.submit();
            }
        });
    }

    function confirmDeleteGym(form) {
        event.preventDefault(); // Prevent default form submission

        // Show confirmation dialog
        Swal.fire({
            title: "Are you sure you want to delete this Gym date item?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form
                form.submit();
            }
        });
    }
</script>
@endsection