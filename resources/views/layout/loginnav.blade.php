{{--
    
<a href="#" class="logo no-underline"><img src="{{asset('images/COA CAR logo.png')}}" alt="" class="logo"><span>COA-CAR</span></a>

<ul class="navbar">
    <li><a href="#" class="active no-underline">HOME</a></li>
    <li><a href="#" class="no-underline">GYM</a></li>
    <li><a href="#" class="no-underline">DORM</a></li>
</ul>

<div class="main">
    <a href="#" class="user active no-underline"><i class="ri-user-line"></i>LOGIN</a>
    <a href="{{ route('gym') }}" class="no-underline">Register</a>
    <div class="bx bx-menu" id="menu-icon"></div>
</div>

--}}

<nav class="navbar navbar-expand-lg ">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{asset('images/COA CAR logo.png')}}" alt="">&nbsp;COA-CAR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <div class="centered">
              
            </div>
            <div class="main-login">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="{{(Route::is('login')) ? 'login-active' : '' }}"><i class="ri-user-line"></i>LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="no-underline">SIGNUP</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

  