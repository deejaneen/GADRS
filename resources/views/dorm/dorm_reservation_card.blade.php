<div class="container">
    <form action="{{ route('dorm.cart') }}" method="post">
        @csrf
        <div class="section" id="dorm_reservation_section">
            <!-- Male Card Start -->
            <div class="card" id="maleCard">

                <div class="card-body">
                    <div class="row dorm-align-container">
                        <div class="col-md-6 dorm-align-container">
                            <div class="row">
                                <h1 class="card-header"
                                    style="display: flex; justify-content: space-between; align-items: center;">
                                    <div class="card-title">
                                        MALE DORM
                                    </div>
                                    <button class="btn btn-primary btn-lg rounded-pill toogle-btn" data-mdb-ripple-init>
                                        <span class="fa-solid fa-repeat"></span>
                                        Female Dorm
                                    </button>
                                </h1>
                            </div>
                            <!-- Date input/availability -->
                            <div class="row date">
                                <div class="col-md-6 date">
                                    <div class="date-container">
                                        <h5>Check bed availability on this date:</h5>
                                        <input type="date" class="btn btn-calendar-dorm" id="availabilityDate">
                                    </div>
                                </div>
                                <div class="col-md-6 availability">
                                    <h3 class="availability">Availability: <b style="color: var(--color-orange)">8
                                            beds</b>
                                    </h3>
                                </div>
                            </div>
                            <!-- Check In, Check Out -->
                            <div class="row">
                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Check In</h5>
                                    <div class="dropdown-center">
                                        <input type="date" class="btn btn-calendar-datetime" name="reservation_start_date">
                                        <input type="time" class="btn btn-calendar-datetime time" value="14:00"
                                            autocomplete="off" readonly name="reservation_start_time">
                                    </div>
                                </div>
                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Check Out</h5>
                                    <div class="dropdown-center">
                                        <input type="date" class="btn btn-calendar-datetime" name="reservation_end_date">
                                        <input type="time" class="btn btn-calendar-datetime time" value="12:00"
                                            autocomplete="off" readonly name="reservation_end_time">
                                    </div>
                                </div>
                            </div>
                            <!-- Number of Beds, Dormer -->
                            <div class="row mt-2">
                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Number of Beds</h5>
                                    <div class="dropdown-center">
                                        <div class="number-input">
                                            <span class="ri-subtract-fill"></span>
                                            <input type="text" class="btn btn-calendar-datetime" max="8"
                                                name="quantity">
                                            <span class="ri-add-line"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Reservor</h5>
                                    <select class="form-select" id="occupant_type" name="occupant_type" required>
                                        <option value="COA">COA</option>
                                        <option value="NON COA">NON COA</option>
                                    </select>
                                    <input type="text" value="Male" hidden name="gender">
                                </div>
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="col-md-6">
                            <div id="carouselMale" class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg"
                                            class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMale"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselMale"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center footer button">
                    <a class="btn btn-info btn-lg rounded btn-block mb-3 btn-clear" data-mdb-ripple-init>Clear</a>
                    <button class="btn btn-info btn-lg rounded btn-block mb-3 btn-add" type="submit"> Add to Cart
                </div>
            </div>

            <!-- Male Card End -->

            <!-- Female Card Start -->
            <div class="card" id="femaleCard" style="display: none;">
                <div class="card-body">
                    <div class="row dorm-align-container">
                        <div class="col-md-6">
                            <div class="row">
                                <h1 class="card-header"
                                    style="display: flex; justify-content: space-between; align-items: center;">
                                    <div class="card-title">
                                        FEMALE DORM
                                    </div>
                                    <button class="btn btn-primary btn-lg rounded-pill toogle-btn"
                                        data-mdb-ripple-init>
                                        <span class="fa-solid fa-repeat"></span>
                                        Male Dorm
                                    </button>
                                </h1>
                            </div>
                            <!-- Date input -->
                            <div class="row date">
                                <div class="col-md-6 date">
                                    <div class="date-container">
                                        <h5>Check bed availability on this date:</h5>
                                        <input type="date" class="btn btn-calendar-dorm"
                                            id="availabilityDateFemale">
                                    </div>
                                </div>
                                <div class="col-md-6 availability">
                                    <h3 class="availability">Availability: <b style="color: var(--color-orange)">11
                                            beds</b>
                                    </h3>
                                </div>
                            </div>
                            <!-- Check In, Check Out -->
                            <div class="row">
                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Check In</h5>
                                    <div class="dropdown-center">
                                        <input type="date" class="btn btn-calendar-datetime"
                                            name="reservation_start_date">
                                        <input type="time" class="btn btn-calendar-datetime time" value="14:00"
                                            autocomplete="off" readonly name="reservation_start_time">
                                    </div>
                                </div>
                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Check Out</h5>
                                    <div class="dropdown-center">
                                        <input type="date" class="btn btn-calendar-datetime"
                                            name="reservation_end_date">
                                        <input type="time" class="btn btn-calendar-datetime time" value="12:00"
                                            autocomplete="off" readonly name="reservation_end_time">
                                    </div>
                                </div>
                            </div>
                            <!-- Number of Beds, Dormer -->
                            <div class="row mt-2">
                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Number of Beds</h5>
                                    <div class="dropdown-center">
                                        <div class="number-input-female">
                                            <span class="ri-subtract-fill"></span>
                                            <input type="text" class="btn btn-calendar-datetime" max="11"
                                                name="quantity">
                                            <span class="ri-add-line"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Reservor</h5>
                                    <select class="form-select" id="occupant_type" name="occupant_type" required>
                                        <option value="COA">COA</option>
                                        <option value="NON COA">NON COA</option>
                                    </select>
                                    <input type="text" value="Female" hidden name="gender">
                                </div>
                            </div>


                        </div>
                        <!-- Image -->
                        <div class="col-md-6">
                            <div id="carouselFemale" class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg"
                                            class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg"
                                            class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselFemale"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselFemale"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center footer button">
                    <a class="btn btn-info btn-lg rounded btn-block mb-3 btn-clear" data-mdb-ripple-init>Clear</a>
                    {{-- <a class="btn btn-info btn-lg rounded btn-block mb-3 btn-add" data-mdb-ripple-init
                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">Add to Cart</a> --}}
                    <button class="btn btn-info btn-lg rounded btn-block mb-3 btn-add" type="submit"> Add to Cart
                    </button>
                </div>
            </div>
            <!-- Female Card End -->
        </div>
    </form>
</div>

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> --}}

<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dorm Reservation Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dorm.cart') }}" method="post" id="dormReservationForm">
                    @csrf
                    <!-- Add other form fields -->
                    <div class="mb-3">
                        <label for="reservationStartDate" class="form-label">Check In</label>
                        <input type="date" class="form-control" id="reservation_start_date" name="reservation_start_date">
                        <input type="time" class="form-control mt-2" id="reservation_start_time" value="14:00" autocomplete="off" name="reservation_start_time">
                    </div>
                    <div class="mb-3">
                        <label for="reservationEndDate" class="form-label">Check Out</label>
                        <input type="date" class="form-control" id="reservationEndDate" name="reservation_end_date">
                        <input type="time" class="form-control mt-2" id="reservationEndTime" value="12:00" autocomplete="off" name="reservation_end_time">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Reservor</label>
                        <input type="text" class="form-control" id="reservor" name="occupant_type">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity">
                    </div>
                    <!-- Add other form fields -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to format the date to 'YYYY-MM-DD' format
        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Set default value for availabilityDate input
        const availabilityDateInput = document.getElementById('availabilityDate');
        availabilityDateInput.value = formatDate(new Date());

        // Set default value for availabilityDateFemale input
        const availabilityDateFemaleInput = document.getElementById('availabilityDateFemale');
        availabilityDateFemaleInput.value = formatDate(new Date());

        // Handling male dorm fields
        const input = document.querySelector('.number-input input');
        input.value = '0';

        const plusBtn = document.querySelector('.number-input .ri-add-line');
        const minusBtn = document.querySelector('.number-input .ri-subtract-fill');
        const availability = parseInt(document.querySelector('.availability b').textContent);

        plusBtn.addEventListener('click', function() {
            if (parseInt(input.value) < availability) {
                input.value = parseInt(input.value) + 1;
            }
        });

        minusBtn.addEventListener('click', function() {
            if (parseInt(input.value) > 0) {
                input.value = parseInt(input.value) - 1;
            }
        });

        // Set default value for dropdown toggle to empty
        const dropdownToggle = document.getElementById('dropdownToggle');
        dropdownToggle.textContent = '';

        const dropdownItems = document.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function() {
                const selectedValue = this.getAttribute('data-value');
                dropdownToggle.textContent = selectedValue;
            });
        });

        // Set default value for date inputs to empty
        const availabilityDateInputs = document.querySelectorAll('.btn-calendar-datetime[type="date"]');
        availabilityDateInputs.forEach(input => {
            input.value = '';
        });
    });

    // Handling only female dorm fields
    const input = document.querySelector('.number-input-female input');
    input.value = '0';

    const plusBtn = document.querySelector('.number-input-female .ri-add-line');
    const minusBtn = document.querySelector('.number-input-female .ri-subtract-fill');
    const availability = parseInt(document.querySelector('#femaleCard .availability b').textContent);

    plusBtn.addEventListener('click', function() {
        if (parseInt(input.value) < availability) {
            input.value = parseInt(input.value) + 1;
        }
    });

    minusBtn.addEventListener('click', function() {
        if (parseInt(input.value) > 0) {
            input.value = parseInt(input.value) - 1;
        }
    });

    // Set default value for dropdown toggle to empty
    const dropdownToggle = document.getElementById('dropdownToggleFemale');
    dropdownToggle.textContent = '';

    const dropdownItems = document.querySelectorAll('#femaleCard .dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function() {
            const selectedValue = this.getAttribute('data-value');
            dropdownToggle.textContent = selectedValue;
        });
    });

    // Set default value for date inputs to empty
    const availabilityDateInputs = document.querySelectorAll('#femaleCard .btn-calendar-datetime[type="date"]');
    availabilityDateInputs.forEach(input => {
        input.value = '';
    });
</script>
