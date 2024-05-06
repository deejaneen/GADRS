<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.2/flatly/bootstrap.rtl.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>

    {{-- Navbar --}}
    @include('layout.websitenav')
    @yield('secondary_nav')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    // position: "bottom-end",
                    icon: "success",
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'small-modal'
                    }
                });
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    customClass: {
                        popup: 'small-modal'
                    }
                });
            });
        </script>
    @endif
    @yield('banner')


    <div class="container py-4">
        @yield('content')
        @yield('loginform')
        @yield('profileview')
        @yield('registerform')
    </div>

    @yield('gym_table')
    @yield('dorm_reservation_card')

    <footer>
        @yield('bottom_nav')
    </footer>

    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <!-- jQuery UI -->

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')
    <script>
        $(document).ready(function() {
            $('#GymReservationsTable').DataTable();
            $('#DormReservationsTable').DataTable();
            $('#GymReservationsTableHistory').DataTable();
            $('#DormReservationsTableHistory').DataTable();
            // $('#AdminUserTable').DataTable();
            // $('#dormCartReservationsTable').DataTable({
            //     "pageLength": 5, // Display 5 rows per page
            //     "lengthMenu": [5, 10, 15, 20], // Option to change number of rows per page
            //     "paging": true, // Enable pagination
            //     "columnDefs": [{
            //         "targets": "_all",
            //         "className": "dt-head-left"
            //     }],
            // });

            $('#gymCartReservationsTable').DataTable({
                "paging": false,
                "pageLength": 5,
                "lengthMenu": [5, 10, 15, 20],
                "columnDefs": [{
                    "targets": "_all", // Corrected target to be a string "_all"
                    "className": "dt-head-left"
                }],

            });

        });
    </script>

    <script>
        $(document).ready(function() {
            // Toggle button click event for Male Dorm
            $('#maleFemaleToggleBtn').click(function(e) {
                e.preventDefault();

                // Toggle between Male and Female cards for Male Dorm
                $('#maleCard').toggle();
                $('#femaleCard').toggle();
            });

            // Toggle button click event for Female Dorm
            $('#femaleMaleToggleBtn').click(function(e) {
                e.preventDefault();

                // Toggle between Male and Female cards for Female Dorm
                $('#femaleCard').toggle();
                $('#maleCard').toggle();
            });

            // Toggle button click event for Gym Reservations Cart
            // Toggle between Gym and Dorm reservations cards
            $('#gymReservationsCartToggleBtn').click(function(e) {
                e.preventDefault();

                // Toggle between Gym Cart and Dorm Cart cards
                $('#gymReservationsCartCard').toggle();
                $('#dormReservationsCartCard').toggle();

                // Check if dorm reservations card is visible
                var dormCardVisible = $('#dormReservationsCartCard').is(':visible');
                if (dormCardVisible) {
                    // Initialize dorm reservations table if visible
                    initializeDormTable();
                } else {
                    // Destroy dorm reservations table if not visible
                    destroyDormTable();
                }
            });

            // Toggle button click event for Dorm Reservations Cart
            $('#dormReservationsCartToggleBtn').click(function(e) {
                e.preventDefault();

                // Toggle between Dorm Cart and Gym Cart cards
                $('#dormReservationsCartCard').toggle();
                $('#gymReservationsCartCard').toggle();
                // clearPrice();
            });

            //HOME PAGE
            // Toggle button click event for Dorm Reservations Cart
            $('#gymTableToggleBtn').click(function(e) {
                e.preventDefault();

                // Toggle between Dorm Cart and Gym Cart cards
                $('#GymReservationsTableCard').toggle();
                $('#DormReservationsTableCard').toggle();

            });

            // Toggle button click event for Dorm Reservations Cart
            $('#dormTableToggleBtn').click(function(e) {
                e.preventDefault();

                // Toggle between Dorm Cart and Gym Cart cards
                $('#DormReservationsTableCard').toggle();
                $('#GymReservationsTableCard').toggle();


            });
            //HOME PAGE END

            //RESERVATION HISTORY
            // Toggle button click event for Dorm Reservations Cart
            $('#gymTableHistoryToggleBtn').click(function(e) {
                e.preventDefault();

                // Toggle between Dorm Cart and Gym Cart cards
                $('#GymReservationsHistoryTableCard').toggle();
                $('#DormReservationsHistoryTableCard').toggle();

            });

            // Toggle button click event for Dorm Reservations Cart
            $('#dormTableHistoryToggleBtn').click(function(e) {
                e.preventDefault();

                // Toggle between Dorm Cart and Gym Cart cards
                $('#DormReservationsHistoryTableCard').toggle();
                $('#GymReservationsHistoryTableCard').toggle();


            });
            //RESERVATION HISTORY END


            // Add a click event handler to the "Add to Cart" button
            $(".btn-add-to-cart").click(function() {
                // Close the modal by selecting it with its ID and calling the modal('hide') method
                $("#myModal").modal('hide');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to the click event of the logout button
            document.getElementById('logout-button').addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default action of following the link

                // Display confirmation dialog
                Swal.fire({
                    title: "Are you sure you want to logout?",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    customClass: {
                        popup: 'small-modal'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the logout form after confirmation
                        document.getElementById('logout-form-navbar').submit();
                    }
                });
            });
        });
    </script>


</body>

</html>
