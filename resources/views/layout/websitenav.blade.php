 <nav class="navbar navbar-expand-lg ">
     <div class="container">
         <a class="navbar-brand" href="#"><img src="{{asset('images/COA CAR logo.png')}}" alt="">&nbsp;COA-CAR</a>
         <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarColor01">
             <div class="centered">
                 <ul class="navbar-nav mx-auto">
                     <li class="nav-item">
                         <a class="{{(Route::is('home')) ? 'active' : '' }} nav-link" href="{{ route('home') }}">HOME
                             <span class="visually-hidden">(current)</span>
                         </a>
                     </li>
                     <li class="nav-item">
                         <a class="{{(Route::is('gym')) ? 'active' : '' }} nav-link" href="{{ route('gym') }}">GYM</a>
                     </li>
                     <li class="nav-item">
                         <a class=" {{(Route::is('dorm')) ? 'active' : '' }} nav-link" href="{{ route('dorm') }}">DORM</a>
                     </li>
                 </ul>
             </div>

             <div class="main">
                 <ul class="navbar-nav mx-auto">
                     @auth()
                     <li class="nav-item">
                         <a href="{{ route('profile') }}" class="{{(Route::is('profile')) ? 'active' : '' }}{{(Route::is('passwordprofile')) ? 'active' : '' }}{{(Route::is('reservationhistoryprofile')) ? 'active' : '' }} user no-underline"><i class="ri-user-fill"></i>{{ Auth::user()->first_name }}</a>
                     </li>
                     <li class="nav-item ">
                         <form action="{{ route('logout')}}" method="POST">
                             @csrf
                             <!-- <a href="{{ route('logout') }}" class="{{(Route::is('logout')) ? 'active' : '' }} no-underline logout">LOGOUT<i class="ri-logout-circle-r-line"></i></a> -->
                             <button class="no-underline logout btn btn-danger btn-md" type="submit">
                                 LOGOUT<i class="ri-logout-circle-r-line"></i>
                             </button>
                         </form>

                     </li>
                     @endauth
                 </ul>
             </div>
         </div>
     </div>
 </nav>