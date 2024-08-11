@extends('layout.adminlayout')
@section('admindashboard')
@include('admin.admin_reservation_modals')

{{-- -------------------------------END-OF-ASIDE-------------------- --}}
<main class="fullspan">

    <div class="row mb-3">
        <div class="col-6">
            <div class="sales-analytics">
                <h2>Add Dates</h2>
                <div class="item add-product" class="right" data-bs-toggle="modal"
                    data-bs-target="#addAvailableDateModalGym">
                    <div class="icon">
                        <span class="ri-add-line"></span>
                    </div>
                    <div>
                        <div class="info">
                            <h3>ADD NEW AVAILABLE DATES</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">

            <div class="sales-analytics">
                <h2>Remove Dates</h2>
                <div class="item add-product" class="right" data-bs-toggle="modal"
                    data-bs-target="#addRestrictedDateModalGym">
                    <div class="icon">
                        <span class="ri-add-line"></span>
                    </div>
                    <div>
                        <div class="info">
                            <h3>RESTRICT DATES</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <h1 class="page-title">DATES THAT CANNOT BE BOOKED</h1>
    <div class="row mb-4">
        <div class="col-6">
            <div class="card" id="AdminGymRestrictReservationTableCard">
                <div>
                    <h2 class="card-header text-center home">Gym Dates Restricted</h2>
                </div>
                <table class="table-home table-hover stripe" id="AdminGymRestrictReservationTable" style="width: 100%">
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
                                <form class="delete-form-dateRestrictGym" id="dateRestrictionDelete"
                                    name="dateRestrictionDelete"
                                    action="{{ route('admin.destroyDateRestriction', $gymDateRestriction->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-delete-profile rounded-pill"
                                        id="gymRestrictTableDeletebtn" onclick="confirmDeleteGym(this.form)">
                                        Delete
                                    </button>


                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-6">
            <div class="card" id="AdminDormRestrictReservationTableCard">
                <div>
                    <h2 class="card-header text-center home">Dorm Dates Restricted</h2>
                </div>
                <table class="table-home table-hover stripe" id="AdminDormRestrictReservationTable" style="width: 100%">
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
                                <form class="delete-form-dateRestrictDorm" id="dateRestrictionDelete"
                                    name="dateRestrictionDelete"
                                    action="{{ route('admin.destroyDateRestriction', $dormDateRestriction->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-delete-profile rounded-pill" id="RestrictTableDeletebtn"
                                        onclick="confirmDeleteDorm(this.form)">
                                        Delete
                                    </button>


                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
    <h1 class="page-title">ADDED RESERVATION DATES</h1>
    <div class="row mb-4">
        <div class="col-6">
            <div class="card" id="AdminGymNewAvailableReservationTableCard">
                <div>
                    <h2 class="card-header text-center home">Added Gym Dates For Reservation</h2>
                </div>
                <table class="table-home table-hover stripe" id="AdminGymNewAvailableReservationTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">Available Date Added</th>
                            <th scope="col">Description</th>
                            <th scope="col">Buttons</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gymDateAdditions as $gymDateAddition)
                        <tr class="table-active">
                            <td>{{ date('F j, Y', strtotime($gymDateAddition->added_date)) }}</td>
                            <td>{{ $gymDateAddition->description }}</td>
                            <td>
                                <form class="delete-form-dateAddedGymDate" id="dateDeleteAddedGym"
                                    name="dateDeleteAddedGym"
                                    action="{{ route('admin.destroyAddedDateReservation', $gymDateAddition->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-delete-profile rounded-pill"
                                        id="gymAddDateTableDeletebtn" onclick="confirmDeleteGym(this.form)">
                                        Delete
                                    </button>


                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="col-6">
            <div class="card" id="AdminDormNewAvailableReservationTableCard">
                <div>
                    <h2 class="card-header text-center home">Added Dorm Dates For Reservation</h2>
                </div>
                <table class="table-home table-hover stripe" id="AdminDormNewAvailableReservationTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col">Available Date Added</th>
                            <th scope="col">Description</th>
                            <th scope="col">Buttons</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dormDateAdditions as $dormDateAddition)
                        <tr class="table-active">
                            <td>{{ date('F j, Y', strtotime($dormDateAddition->added_date)) }}</td>
                            <td>{{ $dormDateAddition->description }}</td>
                            <td>
                                <form class="delete-form-dateAddedDorm" id="dateDeleteAddedGym"
                                    name="dateDeleteAddedGym"
                                    action="{{ route('admin.destroyAddedDateReservation', $dormDateAddition->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-delete-profile rounded-pill" id="AddedDateTableDeletebtn"
                                        onclick="confirmDeleteDorm(this.form)">
                                        Delete
                                    </button>


                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}
        </div>
    </div>


    {{-- ------------------END OF INSIGHTS------------------ --}}

</main>

{{-- ------------------END OF MAIN------------------ --}}


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