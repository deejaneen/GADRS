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
                        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="maleFemaleToggleBtn"
                            data-mdb-ripple-init>
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
                                <div class="col-md-6 date ">
                                    <div class="date-container">
                                        <h5>Check bed availability on this date:</h5>
                                        <input type="date" class="btn btn-calendar-dorm" id="availabilityDate"
                                            min="{{ date('Y-m-d') }}">
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
                                <div class="col-md-6 time" style="text-align: center;">
                                    <h5>Check In</h5>
                                    <div class="dropdown-center">
                                        <input type="date" class="btn btn-calendar-datetime"
                                            name="reservation_start_date" min="{{ date('Y-m-d') }}" required>
                                        <input type="time" class="btn btn-calendar-datetime time" value="14:00"
                                            autocomplete="off" readonly name="reservation_start_time">
                                    </div>
                                </div>
                                <div class="col-md-6 time" style="text-align: center;">
                                    <h5>Check Out</h5>
                                    <div class="dropdown-center">
                                        <input type="date" class="btn btn-calendar-datetime"
                                            name="reservation_end_date" min="{{ date('Y-m-d') }}" required>
                                        <input type="time" class="btn btn-calendar-datetime time" value="12:00"
                                            autocomplete="off" readonly name="reservation_end_time">
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
                                        <select class="form-select" id="occupant_type_male" name="occupant_type"
                                            required>
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
                    <h1 class="card-header"
                        style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="card-title">
                            FEMALE DORM
                        </div>
                        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="femaleMaleToggleBtn"
                            data-mdb-ripple-init>
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
                                        <input type="date" class="btn btn-calendar-dorm"
                                            id="availabilityDateFemale" min="{{ date('Y-m-d') }}">
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
                                <div class="col-md-6 time" style="text-align: center;">
                                    <h5>Check In</h5>
                                    <div class="dropdown-center">
                                        <input type="date" class="btn female btn-calendar-datetime"
                                            name="reservation_start_date" min="{{ date('Y-m-d') }}" required>
                                        <input type="time" class="btn btn-calendar-datetime time" value="14:00"
                                            autocomplete="off" readonly name="reservation_start_time">
                                    </div>
                                </div>
                                <div class="col-md-6 time" style="text-align: center;">
                                    <h5>Check Out</h5>
                                    <div class="dropdown-center">
                                        <input type="date" class="btn female btn-calendar-datetime"
                                            name="reservation_end_date" min="{{ date('Y-m-d') }}" required>
                                        <input type="time" class="btn btn-calendar-datetime time" value="12:00"
                                            autocomplete="off" readonly name="reservation_end_time">
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
                    <a class="btn btn-info btn-lg rounded btn-block mb-3 btn-clear female"
                        data-mdb-ripple-init>Clear</a>
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

            // Handling male dorm fields
            const inputMale = document.querySelector('.number-input input');
            inputMale.value = '0';

            const plusBtnMale = document.querySelector('.number-input .ri-add-line');
            const minusBtnMale = document.querySelector('.number-input .ri-subtract-fill');
            const availabilityMale = parseInt(document.querySelector('.availability b').textContent);

            plusBtnMale.addEventListener('click', function() {
                if (parseInt(inputMale.value) < availabilityMale) {
                    inputMale.value = parseInt(inputMale.value) + 1;
                }
            });

            minusBtnMale.addEventListener('click', function() {
                if (parseInt(inputMale.value) > 0) {
                    inputMale.value = parseInt(inputMale.value) - 1;
                }
            });
            // Set default value for date inputs to empty
            const availabilityDateInputsMale = document.querySelectorAll('.btn-calendar-datetime[type="date"]');
            availabilityDateInputsMale.forEach(input => {
                input.value = '';
            });

            // Clear form to default values
            const clearBtns = document.querySelectorAll('.btn-clear.male');
            clearBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Reset male dorm fields
                    inputMale.value = '0';
                    availabilityDateInputsMale.forEach(input => {
                        input.value = '';
                    });
                });
            });

            // Add event listener to check-in date input for setting minimum check-out date (Male)
            const checkInDateInputMale = document.querySelector(
                '.btn-calendar-datetime[name="reservation_start_date"]');
            const checkOutDateInputMale = document.querySelector(
                '.btn-calendar-datetime[name="reservation_end_date"]');

            checkInDateInputMale.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const minCheckOutDate = new Date(selectedDate);
                minCheckOutDate.setDate(minCheckOutDate.getDate() +
                    1); // Set minimum check-out date as next day
                checkOutDateInputMale.min = formatDate(
                    minCheckOutDate); // Update minimum date in check-out date input
            });
            // Add event listener to check-in date input for setting minimum check-out date (Female)
            const checkInDateInputFemale = document.querySelector(
                '.female.btn-calendar-datetime[name="reservation_start_date"]');
            const checkOutDateInputFemale = document.querySelector(
                '.female.btn-calendar-datetime[name="reservation_end_date"]');

            checkInDateInputFemale.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const minCheckOutDate = new Date(selectedDate);
                minCheckOutDate.setDate(minCheckOutDate.getDate() +
                    1); // Set minimum check-out date as next day
                checkOutDateInputFemale.min = formatDate(
                    minCheckOutDate); // Update minimum date in check-out date input
            });

            // Handling female dorm fields
            const inputFemale = document.querySelector('.number-input-female input');
            inputFemale.value = '0';

            const plusBtnFemale = document.querySelector('.number-input-female .ri-add-line');
            const minusBtnFemale = document.querySelector('.number-input-female .ri-subtract-fill');
            const availabilityFemale = parseInt(document.querySelector('#femaleCard .availability b')
                .textContent);

            plusBtnFemale.addEventListener('click', function() {
                if (parseInt(inputFemale.value) < availabilityFemale) {
                    inputFemale.value = parseInt(inputFemale.value) + 1;
                }
            });

            minusBtnFemale.addEventListener('click', function() {
                if (parseInt(inputFemale.value) > 0) {
                    inputFemale.value = parseInt(inputFemale.value) - 1;
                }
            });

            // Set default value for availabilityDateFemale input
            const availabilityDateFemaleInput = document.getElementById('availabilityDateFemale');
            availabilityDateFemaleInput.value = formatDate(new Date());
            // Set default value for date inputs to empty
            const availabilityDateInputsFemale = document.querySelectorAll(
                '#femaleCard .btn-calendar-datetime[type="date"]');
            availabilityDateInputsFemale.forEach(input => {
                input.value = '';
            });

            // Clear form to default values
            const clearBtnsFemale = document.querySelectorAll('.btn-clear.female');
            clearBtnsFemale.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Reset female dorm fields
                    inputFemale.value = '0';
                    availabilityDateInputsFemale.forEach(input => {
                        input.value = '';
                    });
                });
            });

        });
    </script>
@endsection
