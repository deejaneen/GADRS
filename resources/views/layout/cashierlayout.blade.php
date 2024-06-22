<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">

</head>

<body>
    @include('pagepreloader')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        const loaderContainer = document.querySelector('.loader-container')
        const pageContent = document.querySelector('#contentcontainer')

        window.addEventListener('load', () => {
            loaderContainer.classList.add('hidden')
            pageContent.classList.add('visible')
        })
    </script>
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
    <div class="main-container">
        @include('cashier.cashier-sidebar')
        @yield('cashierdashboard')

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#GymReservationTable').DataTable();
            $('#DormReservationTable').DataTable();
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

        $(document).ready(function() {
            var path = window.location.pathname;
            $('.sidebar-link').each(function() {
                var href = $(this).attr('href');
                var hrefPath = new URL(href, window.location.origin).pathname; // Extract pathname from href
                if (path === hrefPath) { // Compare path with hrefPath
                    $(this).addClass('active');
                }
            });
        });
    </script>
</body>

</html>