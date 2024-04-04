 <nav class="navbar navbar-expand-lg ">
     <div class="container centered">
         <a class="navbar-brand" href="#"><img src="{{ asset('images/COA CAR logo.png') }}" alt="">&nbsp;COA-
             <span style="color: var(--color-warning)">CAR</span></a>
         <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
             data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
             aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarColor01">
             <div class="centered">
                 <ul class="navbar-nav mx-auto">
                     <li class="nav-item">
                         <a class="{{ Route::is('home') ? 'active' : '' }} nav-link" href="{{ route('home') }}">HOME
                             <span class="visually-hidden">(current)</span>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="{{ Route::is('gym') ? 'active' : '' }} nav-link" href="{{ route('gym') }}">GYM</a>
                     </li>
                     <li class="nav-item">
                         <a class=" {{ Route::is('dorm') ? 'active' : '' }} nav-link"
                             href="{{ route('dorm') }}">DORM</a>
                     </li>
                 </ul>
             </div>

             <div class="main">
                 <ul class="navbar-nav mx-auto">
                     @auth()
                         <li class="nav-item cart">
                             <a href="{{ route('cart_check') }}" class=""><i class="ri-shopping-cart-2-line"></i></a>
                         </li>
                         <li class="nav-item profile">
                             <a href="{{ route('profile') }}"
                                 class="{{ Route::is('profile') ? 'active' : '' }}{{ Route::is('passwordprofile') ? 'active' : '' }}{{ Route::is('reservationhistoryprofile') ? 'active' : '' }}{{ Route::is('users.edit') ? 'active' : '' }} user no-underline"><i
                                     class="ri-user-fill"></i> <span
                                     class="first-name">{{ Auth::user()->first_name }}</span></a>
                         </li>
                     @endauth
                     <li class="nav-item logout">
                         <form action="{{ route('logout') }}" method="POST">
                             @csrf

                             <button class="no-underline logout btn btn-danger btn-md" type="submit">
                                <span class="logout-text">LOGOUT</span>
                                <i class="ri-logout-box-r-line" style="color: var(--color-danger);"></i>
                             </button>
                         </form>

                     </li>

                 </ul>
             </div>
         </div>
     </div>
 </nav>
