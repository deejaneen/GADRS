<div class="container">
    <div class="section" id="dorm_reservation_section">
        <!-- Male Card Start -->
        <div class="card" id="maleCard">
            <div>
                <h1 class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        MALE DORM
                    </div>
                    <button class="btn btn-primary btn-lg rounded-pill toogle-btn" data-mdb-ripple-init>
                        <span class="fa-solid fa-repeat"></span>
                        Female Dorm
                    </button>
                </h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Check In, Check Out -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6" style="text-align: center;">
                                <input type="date" class="btn btn-calendar-dorm">
                                </input>
                                <h5>Check In</h5>
                                <div class="dropdown-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 100%;">
                                        da dropdown
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Check Out</h5>
                                <div class="dropdown-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 100%;">
                                        Centered dropdown
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Number of Beds, Dormer -->
                        <div class="row mt-2">
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Number of Beds</h5>
                                <div class="dropdown-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 100%;">
                                        Centered dropdown
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Dormer</h5>
                                <div class="dropdown-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 100%;">
                                        Centered dropdown
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Availability -->
                        <div class="row mt-1">
                            <div class="col-md-6">
                                <p>Availability: <b style="color: #f77f00">8 beds</b></p>
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
            <div>
                <h1 class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        FEMALE DORM
                    </div>
                    <button class="btn btn-primary btn-lg rounded-pill toogle-btn" data-mdb-ripple-init>
                        <span class="fa-solid fa-repeat"></span> Male Dorm
                    </button>
                </h1>

            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Check In, Check Out -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6" style="text-align: center;">
                                <input type="date" class="btn btn-calendar-dorm">
                            </input>
                                <h5>Check In</h5>
                                <div class="dropdown-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 100%;">
                                        Centered dropdown
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Check Out</h5>
                                <div class="dropdown-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 100%;">
                                        Centered dropdown
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Number of Beds, Dormer -->
                        <div class="row mt-2">
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Number of Beds</h5>
                                <div class="dropdown-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 100%;">
                                        Centered dropdown
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6" style="text-align: center;">
                                <h5>Dormer</h5>
                                <div class="dropdown-center">
                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false" style="min-width: 100%;">
                                        Centered dropdown
                                    </button>
                                    <ul class="dropdown-menu" style="min-width: 100%;">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Action two</a></li>
                                        <li><a class="dropdown-item" href="#">Action three</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Availability -->
                        <div class="row mt-1">
                            <div class="col-md-6">
                                <p>Availability: <b style="color: #f77f00">8 beds</b></p>
                            </div>
                        </div>
                    </div>
                    <!-- Image -->
                    <div class="col-md-6">
                        <div id="carouselFemale" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://www.thetwizt.com/img/rooms/female-dorm/female-dorm.jpg"
                                        class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://www.thetwizt.com/img/rooms/female-dorm/female-dorm.jpg"
                                        class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://www.thetwizt.com/img/rooms/female-dorm/female-dorm.jpg"
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
