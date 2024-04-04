<div class="left-column">
    <div class="sidebar">
        <a href="{{ route('profile') }}" class="sidebar-link">
            <span class="ri-user-line"></span>
            <h3>Your Account</h3>
        </a>
        <a href="{{ route('passwordprofile') }}" class="sidebar-link">
            <span class="ri-key-2-line"></span>
            <h3>Change Password</h3>
        </a>
        <a href="{{ route('reservationhistoryprofile') }}" class="sidebar-link">
            <span class="ri-receipt-line"></span>
            <h3>Reservation History</h3>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a class="sidebar-link" onclick="confirmation(event)">
            <span class="ri-logout-box-r-line"></span>
            <h3>Logout</h3>
        </a>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            // Get the current URL
            var currentUrl = window.location.href;
            console.log(currentUrl);

            // Iterate over each sidebar link
            $(".sidebar-link").each(function() {
                // Get the href attribute of the link
                var href = $(this).attr("href");

                // Check if the current URL contains the href of the link
                if (currentUrl.includes(href)) {
                    // Add active class to the link if it matches the current URL
                    $(this).addClass("active");
                }
            });

            $(".sidebar-link").click(function(event) {
                // Remove active class from all links
                $(".sidebar-link").removeClass("active");

                // Add active class to the clicked link
                $(this).addClass("active");
            });
        });

        function confirmation(event) {
            event.preventDefault(); // Prevent the default action of following the link
            Swal.fire({
                title: "Are you sure you want to logout?",
                showCancelButton: true,
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit(); // Submit the logout form
                }
            });
        }
    </script>
@endsection
