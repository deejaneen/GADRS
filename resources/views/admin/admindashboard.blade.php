<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">

</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    <h2 class="primary-light">COA <span class="danger">CAR</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="ri-close-fill"></span>
                </div>

                <div class="sidebar">
                    <a href="#" class="active">
                        <span class="ri-dashboard-line ">
                            <h3>Dashboard</h3>
                        </span>
                    </a>
                    <a href="#">
                        <span class="ri-user-line">
                            <h3>Customers</h3>
                        </span>
                    </a>
                    <a href="#">
                        <span class="ri-receipt-line">
                            <h3>Orders</h3>
                        </span>
                    </a>
                    <a href="#">
                        <span class="ri-line-chart-line">
                            <h3>Analytics</h3>
                        </span>
                    </a>
                    <a href="#">
                        <span class="ri-chat-1-fill">
                            <h3>Messages</h3>
                        </span>
                        <span class="message-count">26</span>
                    </a>
                    <a href="#">
                        <span class="ri-error-warning-line">
                            <h3>Reports</h3>
                        </span>
                    </a>
                    <a href="#">
                        <span class="ri-settings-3-fill">
                            <h3>Settings</h3>
                        </span>
                    </a>
                    <a href="#">
                        <span class="ri-add-line">
                            <h3>Add Product</h3>
                        </span>
                    </a>
                    <a href="#">

                        <form action="{{ route('logout') }}" method="POST" id="logout-form-navbar">
                            @csrf
                            <span class="ri-logout-box-r-line">
                                <button class="no-underline logout btn btn-danger btn-md" type="submit"  id="logout-button">
                                    <span class="logout-text">LOGOUT</span>
                                    <i class="ri-logout-box-r-line" style="color: var(--color-danger);"></i>
                                 </button>
                            </span>

                        </form>
                    </a>
                </div>
            </div>
        </aside>
        {{-- -------------------------------END-OF-ASIDE-------------------- --}}
        <main>
            <h1>Dashboard</h1>
            <div class="date">
                <input type="date" name="" id="">
            </div>

            <div class="insights">
                {{-- -------------------------------END-OF-SALES-------------------- --}}
                <div class="totalreservation">
                    <span class="ri-key-2-line"></span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Reservations</h3>
                            <h1>
                                Php25,024
                            </h1>
                        </div>
                        <div class="progress">
                            <svg viewBox="0 0 100 100">
                                <circle class="sales-circle" cx="50" cy="50" r="40"></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
                <div class="gymreservation">
                    <span class="ri-basketball-fill"></span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Gym Reservations</h3>
                            <h1>
                                Php25,024
                            </h1>
                        </div>
                        <div class="progress">
                            <svg viewBox="0 0 100 100">
                                <circle class="sales-circle" cx="50" cy="50" r="40"></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
                <div class="dormreservations">
                    <span class="ri-hotel-bed-fill"></span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Dorm Reservations</h3>
                            <h1>
                                Php25,024
                            </h1>
                        </div>
                        <div class="progress">
                            <svg viewBox="0 0 100 100">
                                <circle class="sales-circle" cx="50" cy="50" r="40"></circle>
                            </svg>
                            <div class="number">
                                <p>81%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ------------------END OF INSIGHTS------------------ --}}
            <div class="recent-orders">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Number</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Fdhsajkdakdh</td>
                            <td>Adska</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="warning-orange">Details</td>
                        </tr>
                        <tr>
                            <td>Fdhsajkdakdh</td>
                            <td>Adska</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="warning-orange">Details</td>
                        </tr>
                        <tr>
                            <td>Fdhsajkdakdh</td>
                            <td>Adska</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="warning-orange">Details</td>
                        </tr>
                        <tr>
                            <td>Fdhsajkdakdh</td>
                            <td>Adska</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="warning-orange">Details</td>
                        </tr>
                        <tr>
                            <td>Fdhsajkdakdh</td>
                            <td>Adska</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="warning-orange">Details</td>
                        </tr>
                        <tr>
                            <td>Fdhsajkdakdh</td>
                            <td>Adska</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="warning-orange">Details</td>
                        </tr>
                    </tbody>
                </table>
                <a href="#">Show All</a>
            </div>
        </main>

        {{-- ------------------END OF MAIN------------------ --}}
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="ri-menu-line"></span>
                </button>
                <div class="theme-toggler">
                    <span class="ri-sun-fill active"></span>
                    <span class="ri-moon-fill"></span>
                </div>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Name</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                </div>
            </div>
            {{-- ------------------END OF TOP------------------ --}}
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson </b>Loreendis, cupiditate ipsam, saepe orro tempora.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque
                                aspernatur nostrum, </p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                        </div>
                        <div class="message">
                            <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adae illo, nulla voluptates
                                porro tempora.</p>
                            <small class="text-muted">2 Minutes Ago</small>
                        </div>
                    </div>
                </div>
            </div>
             {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
            <div class="sales-analytics">
                <h2>Sales Analytics</h2>
                <div class="item online">
                    <div class="icon">
                        <span class="ri-shopping-cart-2-line"></span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>ONLINE ORDERS</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="success">+39%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item offline">
                    <div class="icon">
                        <span class="ri-shopping-bag-line"></span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>OFFLINE ORDERS</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="danger">-17%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item customers">
                    <div class="icon">
                        <span class="ri-user-fill"></span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>NEW CUSTOMERS</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="success">+225%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
                <div class="item add-product">
                    <div class="icon">
                        <span class="ri-add-line"></span>
                    </div>
                    <div class="right">
                        <div class="info">
                            <h3>ADD PRODUCT</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="success">+225%</h5>
                        <h3>3849</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

</body>

</html>
