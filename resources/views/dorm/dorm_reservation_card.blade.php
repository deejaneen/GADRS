<div class="container">
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
                                <h3 class="availability">Availability: <b style="color: var(--color-orange)">8 beds</b>
                                </h3>
                            </div>
                        </div>
                        <!-- Check In, Check Out -->
                        <div class="row">
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Check In</h5>
                                <div class="dropdown-center">
                                    <input type="date" class="btn btn-calendar-datetime">
                                    <input type="time" class="btn btn-calendar-datetime time" value="14:00"
                                        autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Check Out</h5>
                                <div class="dropdown-center">
                                    <input type="date" class="btn btn-calendar-datetime">
                                    <input type="time" class="btn btn-calendar-datetime time" value="12:00"
                                        autocomplete="off" readonly>
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
                                        <input type="text" class="btn btn-calendar-datetime" value="0"
                                            max="8">
                                        <span class="ri-add-line"></span>
                                    </div>
                                </div>
                            </div>                   
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Reservor</h5>
                                <div class="dropdown-center reservor">
                                    <button id="dropdownToggle" class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 100%;">
                                        COA/Non-COA
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="javascript:void(0);"
                                                data-value="COA Employee">COA Employee</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"
                                                data-value="Non - COA">Non - COA</a></li>
                                    </ul>
                                </div>
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
                <a class="btn btn-info btn-lg rounded btn-block mb-3 btn-add" data-mdb-ripple-init
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">Add to Cart</a>
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
                                <button class="btn btn-primary btn-lg rounded-pill toogle-btn" data-mdb-ripple-init>
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
                                    <input type="date" class="btn btn-calendar-dorm" id="availabilityDateFemale">
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
                                    <input type="date" class="btn btn-calendar-datetime">
                                    <input type="time" class="btn btn-calendar-datetime time" value="14:00"
                                        autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Check Out</h5>
                                <div class="dropdown-center">
                                    <input type="date" class="btn btn-calendar-datetime">
                                    <input type="time" class="btn btn-calendar-datetime time" value="12:00"
                                        autocomplete="off" readonly>
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
                                        <input type="text" class="btn btn-calendar-datetime" value="0"
                                            max="11">
                                        <span class="ri-add-line"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Reservor</h5>
                                <div class="dropdown-center reservor">
                                    <button id="dropdownToggleFemale" class="btn btn-secondary dropdown-toggle"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                        style="min-width: 100%;">
                                        COA/Non-COA
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="javascript:void(0);"
                                                data-value="COA Employee">COA Employee</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"
                                                data-value="Non - COA">Non - COA</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Availability -->
                        {{-- <div class="row mt-1">
                    <div class="col-md-6">
                        <p>Availability: <b style="color: var(--color-orange)">8 beds</b></p>
                    </div>
                </div> --}}
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
                <a class="btn btn-info btn-lg rounded btn-block mb-3 btn-add" data-mdb-ripple-init
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">Add to Cart</a>
            </div>
        </div>

        <!-- Female Card End -->
    </div>
</div>
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

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
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
</script> --}}
