<div class="container centered">
    <div class="section" id="dorm_reservation_section">
        <form action="{{ route('dorm.cart') }}" method="post">
            @csrf
            <!-- Male Card Start -->

            <div class="card" id="maleCard">
                <input type="hidden" name="current_card" value="maleCard">
                <div class="card-body">
                    <h1 class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="card-title">
                            MALE DORM
                        </div>
                        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="maleFemaleToggleBtn" data-mdb-ripple-init>
                            <span class="fa-solid fa-repeat"></span>
                            Female Dorm
                        </button>
                    </h1>
                    <div class="row">
                        <div class="col-md-7 dorm-align-container">
                            <div class="row">

                            </div>
                            <!-- Date input/availability -->
                            <div class="row date">
                                <div class="col-md-6 date">
                                    <div class="date-container">
                                        <h5>Check bed availability on this date:</h5>
                                        <input type="text" id="availabilityDate" class="btn btn-calendar-dorm" min="{{ date('Y-m-d') }}" placeholder="Select a date">
                                    </div>
                                </div>
                                <div class="col-md-6 availability">
                                    <h3 class="availability" id="bedAvailabilityMale">Availability: <b style="color: var(--color-orange)">{{ $beds_male }} beds</b></h3>
                                </div>
                            </div>
                            <!-- Check In, Check Out -->
                            <div class="row">
                                <div class="col-md-6 time" style="text-align: center;">
                                    <h5>Check In</h5>
                                    <div class="dropdown-center">
                                        <!-- <input type="date" class="btn btn-calendar-datetime" name="reservation_start_date" min="{{ date('Y-m-d') }}" required> -->
                                        <input type="text" id="reservation_start_date" class="btn btn-calendar-datetime" min="{{ date('Y-m-d') }}" placeholder="Select a date" name="reservation_start_date" required>
                                        <input type="time" class="btn btn-calendar-datetime time" value="14:00" autocomplete="off" readonly name="reservation_start_time">
                                    </div>
                                </div>
                                <div class="col-md-6 time" style="text-align: center;">
                                    <h5>Check Out</h5>
                                    <div class="dropdown-center">
                                        <!-- <input type="date" class="btn btn-calendar-datetime" name="reservation_end_date" min="{{ date('Y-m-d') }}" required> -->
                                        <input type="text" id="reservation_end_date" class="btn btn-calendar-datetime" min="{{ date('Y-m-d') }}" placeholder="Select a date" name="reservation_end_date" required>
                                        <input type="time" class="btn btn-calendar-datetime time" value="12:00" autocomplete="off" readonly name="reservation_end_time">
                                    </div>
                                </div>
                            </div>
                            <!-- Number of Beds, Dormer -->
                            <div class="row mt-2">
                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Number of Beds</h5>
                                    <div class="dropdown-center beds">
                                        <div class="number-input">
                                            <div class="number-input-section">
                                                <span class="ri-subtract-fill"></span>
                                                <input type="text" class="btn btn-calendar-datetime-bednumber" max="8" name="quantity" required>
                                                <span class="ri-add-line"></span>
                                            </div>
                                            <div class="error-message">
                                                @error('quantity')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 reservor" style="text-align: center;">
                                    <h5>Reservor</h5>
                                    <div class="reservor-type">
                                        <select class="form-select" id="occupant_type_male" name="occupant_type" required>
                                            <option value="COA">COA</option>
                                            <option value="Non COAn">Non COA</option>
                                        </select>
                                        <input type="text" name="gender" value="Male" hidden>
                                    </div>

                                </div>

                            </div>
                            <div class="row discount">
                                <div class="col-md-6">
                                    <h5>Apply for Senior/PWD discount?</h5>
                                    <input type="checkbox" id="myCheckboxSeniorMale" name="is_senior_or_pwd">
                                    {{-- <input type="checkbox" id="myCheckboxSeniorMale"
                                        onchange="updateCheckboxValue(this)" name="is_senior_or_pwd"> --}}
                                </div>
                                <div class="col-md-6">
                                    <h5>Is the person staying at the reservation a child below 5 years old?</h5>
                                    <input type="checkbox" id="myCheckboxChildrenMale" name="is_child">
                                    {{-- <input type="checkbox" id="myCheckboxChildrenMale"
                                        onchange="updateCheckboxValue(this)" name="is_child"> --}}
                                </div>
                            </div>
                        </div>
                        <!-- Image -->
                        <div class="col-md-5 carousel">
                            <div id="carouselMale" class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselMale" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselMale" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center footer button">
                    <a class="btn btn-info btn-lg rounded btn-block mb-3 btn-clear male" data-mdb-ripple-init>Clear</a>
                    <button type="submit" class="btn btn-info btn-lg rounded btn-block mb-3 btn-add">Add to
                        cart</button>
                </div>
            </div>

            <!-- Male Card End -->
        </form>

        <form action="{{ route('dorm.cart') }}" method="post">
            @csrf
            <!-- Female Card Start -->
            <input type="hidden" name="current_card" value="femaleCard">
            <div class="card" id="femaleCard" style="display: none;">
                <div class="card-body">
                    <h1 class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="card-title">
                            FEMALE DORM
                        </div>
                        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="femaleMaleToggleBtn" data-mdb-ripple-init>
                            <span class="fa-solid fa-repeat"></span>
                            Male Dorm
                        </button>
                    </h1>
                    <div class="row">
                        <div class="col-md-7 dorm-align-container">
                            <div class="row">

                            </div>
                            <!-- Date input -->
                            <div class="row date">
                                <div class="col-md-6 date">
                                    <div class="date-container">
                                        <h5>Check bed availability on this date:</h5>
                                        <!-- <input type="date" class="btn btn-calendar-dorm" id="availabilityDateFemale" min="{{ date('Y-m-d') }}"> -->
                                        <input type="text" id="availabilityDateFemale" class="btn btn-calendar-dorm" min="{{ date('Y-m-d') }}" placeholder="Select a date">
                                    </div>
                                </div>
                                <div class="col-md-6 availability">
                                    <h3 class="availability" id="bedAvailabilityFemale">Availability: <b style="color: var(--color-orange)">{{ $beds_female }} beds</b></h3>
                                    </h3>
                                </div>
                            </div>
                            <!-- Check In, Check Out -->
                            <div class="row">
                                <div class="col-md-6 time" style="text-align: center;">
                                    <h5>Check In</h5>
                                    <div class="dropdown-center">
                                        <!-- <input type="date" class="btn female btn-calendar-datetime" name="reservation_start_date" min="{{ date('Y-m-d') }}" required> -->
                                        <input type="text" id="reservation_start_date_female" class="btn female btn-calendar-datetime" min="{{ date('Y-m-d') }}" placeholder="Select a date" name="reservation_start_date" required>
                                        <input type="time" class="btn btn-calendar-datetime time" value="14:00" autocomplete="off" readonly name="reservation_start_time">
                                    </div>
                                </div>
                                <div class="col-md-6 time" style="text-align: center;">
                                    <h5>Check Out</h5>
                                    <div class="dropdown-center">
                                        <!-- <input type="date" class="btn female btn-calendar-datetime" name="reservation_end_date" min="{{ date('Y-m-d') }}" required> -->
                                        <input type="text" id="reservation_end_date_female" class="btn female btn-calendar-datetime" min="{{ date('Y-m-d') }}" placeholder="Select a date" name="reservation_end_date" required>
                                        <input type="time" class="btn btn-calendar-datetime time" value="12:00" autocomplete="off" readonly name="reservation_end_time">
                                    </div>
                                </div>
                            </div>
                            <!-- Number of Beds, Dormer -->
                            <div class="row mt-2">
                                <div class="col-md-6" style="text-align: center;">
                                    <h5>Number of Beds</h5>
                                    <div class="dropdown-center beds">
                                        <div class="number-input-female">
                                            <div class="number-input-section">
                                                <span class="ri-subtract-fill"></span>
                                                <input type="text" class="btn btn-calendar-datetime-bednumber" max="11" name="quantity" value="0">
                                                <span class="ri-add-line"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="error-message">
                                        @error('quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 reservor">
                                    <h5>Reservor</h5>
                                    <div class="reservor-type">
                                        <select class="form-select" id="occupant_type_female" name="occupant_type" required>
                                            <option value="COA">COA</option>
                                            <option value="Non COAn">Non COA</option>
                                        </select>
                                        <input type="text" name="gender" value="Female" hidden>
                                    </div>
                                </div>
                            </div>

                            <div class="row discount">
                                <div class="col-md-6">
                                    <h5>Apply for Senior/PWD discount?</h5>
                                    <input type="checkbox" id="myCheckboxSeniorFemale" name="is_senior_or_pwd">
                                    {{-- <input type="checkbox" id="myCheckboxSeniorFemale"
                                        onchange="updateCheckboxValue(this)" name="is_senior_or_pwd"> --}}
                                </div>
                                <div class="col-md-6">
                                    <h5>Is the person staying at the reservation a child below 5 years old?</h5>
                                    <input type="checkbox" id="myCheckboxChildrenFemale" name="is_child">
                                    {{-- <input type="checkbox" id="myCheckboxChildrenFemale"
                                        onchange="updateCheckboxValue(this)" name="is_child"> --}}
                                </div>
                            </div>


                        </div>
                        <!-- Image -->
                        <div class="col-md-5 carousel">
                            <div id="carouselFemale" class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://justorganized.org/wp-content/uploads/2019/08/guys-dorm-room-1024x675.jpg" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselFemale" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselFemale" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-center footer button">
                    <a class="btn btn-info btn-lg rounded btn-block mb-3 btn-clear female" data-mdb-ripple-init>Clear</a>
                    <button type="submit" class="btn btn-info btn-lg rounded btn-block mb-3 btn-add">Add to
                        cart</button>
                </div>
            </div>
            <!-- Female Card End -->
        </form>
    </div>

</div>
@section('scripts')
<script>
    $(document).ready(function() {
        // Function to format the date to 'YYYY-MM-DD' format
        function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        // Initialize availability dates
        const availabilityDateInputMale = document.getElementById('availabilityDate');
        const availabilityDateInputFemale = document.getElementById('availabilityDateFemale');
        availabilityDateInputMale.value = formatDate(new Date());
        availabilityDateInputFemale.value = formatDate(new Date());

        // Initialize male dorm input and buttons
        let inputMale = document.querySelector('.number-input input');
        let availabilityMale = parseInt(document.querySelector('#bedAvailabilityMale b').textContent);
        inputMale.value = '0';
        inputMale.max = availabilityMale; // Initialize max attribute

        $('.number-input .ri-add-line').click(function() {
            if (parseInt(inputMale.value) < availabilityMale) {
                inputMale.value = parseInt(inputMale.value) + 1;
            }
        });

        $('.number-input .ri-subtract-fill').click(function() {
            if (parseInt(inputMale.value) > 0) {
                inputMale.value = parseInt(inputMale.value) - 1;
            }
        });

        // Event listener for availabilityDate change (Male)
        $('#availabilityDate').change(function() {
            const selectedDate = $(this).val();
            const gender = 'male';

            $.ajax({
                url: '/check-bed-availability',
                method: 'GET',
                data: {
                    date: selectedDate,
                    gender: gender
                },
                success: function(response) {
                    console.log("AJAX success (male):", response);
                    $('#bedAvailabilityMale b').text(response.availableBeds + ' beds');
                    availabilityMale = response.availableBeds;
                    inputMale.max = availabilityMale; // Update max attribute dynamically
                    // Reset input value if exceeds new max
                    if (parseInt(inputMale.value) > availabilityMale) {
                        inputMale.value = availabilityMale;
                    }
                },
                error: function(response) {
                    console.error('Error checking availability (male):', response);
                    alert('Error checking availability (male).');
                }
            });
        });

        // Initialize female dorm input and buttons
        let inputFemale = document.querySelector('.number-input-female input');
        let availabilityFemale = parseInt(document.querySelector('#bedAvailabilityFemale b').textContent);
        inputFemale.value = '0';
        inputFemale.max = availabilityFemale; // Initialize max attribute

        $('.number-input-female .ri-add-line').click(function() {
            if (parseInt(inputFemale.value) < availabilityFemale) {
                inputFemale.value = parseInt(inputFemale.value) + 1;
            }
        });

        $('.number-input-female .ri-subtract-fill').click(function() {
            if (parseInt(inputFemale.value) > 0) {
                inputFemale.value = parseInt(inputFemale.value) - 1;
            }
        });

        // Event listener for availabilityDate change (Female)
        $('#availabilityDateFemale').change(function() {
            const selectedDate = $(this).val();
            const gender = 'female';

            $.ajax({
                url: '/check-bed-availability',
                method: 'GET',
                data: {
                    date: selectedDate,
                    gender: gender
                },
                success: function(response) {
                    console.log("AJAX success (female):", response);
                    $('#bedAvailabilityFemale b').text(response.availableBeds + ' beds');
                    availabilityFemale = response.availableBeds;
                    inputFemale.max = availabilityFemale; // Update max attribute dynamically
                    // Reset input value if exceeds new max
                    if (parseInt(inputFemale.value) > availabilityFemale) {
                        inputFemale.value = availabilityFemale;
                    }
                },
                error: function(response) {
                    console.error('Error checking availability (female):', response);
                    alert('Error checking availability (female).');
                }
            });
        });

        // Clear buttons functionality for male dorm
        $('.btn-clear.male').click(function() {
            inputMale.value = '0';
        });

        // Clear buttons functionality for female dorm
        $('.btn-clear.female').click(function() {
            inputFemale.value = '0';
        });

    });


    $(document).ready(function() {
        const datePicker1 = $("#availabilityDate, #reservation_start_date, #reservation_end_date, #availabilityDateFemale, #reservation_start_date_female, #reservation_end_date_female");

        const disabledDates = <?= json_encode($dormDateRestrictions) ?>;

        // Initialize date pickers with disabled dates
        datePicker1.datepicker({
            dateFormat: 'yy-mm-dd',
            beforeShowDay: function(date) {
                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                return [disabledDates.indexOf(string) == -1];
            },
            minDate: 0
        });

        // Update end date picker to disable selected start date
        $("#reservation_start_date, #reservation_start_date_female").on("change", function() {
            var selectedDate = $(this).datepicker("getDate");
            if (selectedDate !== null) {
                // Add one day to selected date
                var nextDay = new Date(selectedDate);
                nextDay.setDate(selectedDate.getDate() + 1);
                $(this).closest('.card-body').find('input[name="reservation_end_date"], input[name="reservation_end_date_female"]').datepicker("option", "minDate", nextDay);
            }
        });
    });

    // $(document).ready(function() {
    //     console.log("Document is ready."); // Debugging line
    //     availabilityMale = parseInt(document.querySelector('.availability b').textContent);
    //     const inputMale = document.querySelector('.number-input input');
    //     inputMale.value = '0';
    //     $('#availabilityDate').change(function() {
    //         console.log("Date changed for male dorm."); // Debugging line
    //         var selectedDate = $(this).val();
    //         var gender = 'male'; // or 'female' based on the user selection

    //         console.log("Selected date (male):", selectedDate); // Debugging line

    //         $.ajax({
    //             url: '/check-bed-availability',
    //             method: 'GET',
    //             data: {
    //                 date: selectedDate,
    //                 gender: gender
    //             },
    //             success: function(response) {
    //                 console.log("AJAX success:", response); // Debugging line
    //                 $('#bedAvailabilityMale b').text(response.availableBeds + ' beds');
    //                 availabilityMale = response.availableBeds;
    //                 inputMale.max = availabilityMale; // Update max attribute dynamicall

    //             },
    //             error: function(response) {
    //                 console.error('Error checking availability:', response); // Debugging line
    //                 alert('Error checking availability.');
    //             }
    //         });
    //     });

    //     $('#availabilityDateFemale').change(function() {
    //         console.log("Date changed for female dorm."); // Debugging line
    //         var selectedDate = $(this).val();
    //         var gender = 'female'; // or 'male' based on the user selection

    //         console.log("Selected date (female):", selectedDate); // Debugging line

    //         $.ajax({
    //             url: '/check-bed-availability',
    //             method: 'GET',
    //             data: {
    //                 date: selectedDate,
    //                 gender: gender
    //             },
    //             success: function(response) {
    //                 console.log("AJAX success:", response); // Debugging line
    //                 $('#bedAvailabilityFemale b').text(response.availableBeds + ' beds');
    //             },
    //             error: function(response) {
    //                 console.error('Error checking availability:', response); // Debugging line
    //                 alert('Error checking availability.');
    //             }
    //         });
    //     });
    // });
</script>


@endsection