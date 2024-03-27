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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Stylesheet for icons --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    {{-- Stylesheet for font from google fonts --}}
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

</head>

<body>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    @if (session('login-success'))
        <script>
            Swal.fire({
                // position: "bottom-end",
                icon: "success",
                title: "Logged in successfully!",
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'small-modal'
                }
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


    {{-- Stylesheet for font from google fonts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript">
        window.baseUrl = "{{ URL::to('/') }}";
        @if (session('success'))
            toastr.success('{{ session('success') }}', 'Success', {
                timeOut: 5000
            });
        @endif

        @if (session('error'))
            toastr.error('{{ session('error') }}', 'Error', {
                timeOut: 5000
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            // toogle button click event
            $('.btn-primary.btn-lg.toogle-btn').click(function(e) {
                e.preventDefault();

                // Toggle between Male and Female cards
                $('#maleCard').toggle();
                $('#femaleCard').toggle();
            });
        });
    </script>
    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Add a click event handler to the "Add to Cart" button
            $(".btn-add-to-cart").click(function() {
                // Close the modal by selecting it with its ID and calling the modal('hide') method
                $("#myModal").modal('hide');
            });
        });
    </script>



</body>

</html>
