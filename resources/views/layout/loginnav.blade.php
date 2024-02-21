{{--
    
<a href="#" class="logo no-underline"><img src="{{asset('images/COA CAR logo.png')}}" alt="" class="logo"><span>COA-CAR</span></a>

<ul class="navbar">
    <li><a href="#" class="active no-underline">HOME</a></li>
    <li><a href="#" class="no-underline">GYM</a></li>
    <li><a href="#" class="no-underline">DORM</a></li>
</ul>

<div class="main">
    <a href="#" class="user active no-underline"><i class="ri-user-line"></i>LOGIN</a>
    <a href="{{ route('gym') }}" class="no-underline">SIGNUP</a>
    <div class="bx bx-menu" id="menu-icon"></div>
</div>

--}}

<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="{{asset('images/COA CAR logo.png')}}" alt="">&nbsp;COA-CAR</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav centered">
            <li class="nav-item">
                <a class="nav-link active" href="#">HOME
                <span class="visually-hidden">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('gym') }}">GYM</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dorm') }}">DORM</a>
            </li>
            </ul>
        </div>
        <div class="main">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="#" class="user active no-underline"><i class="ri-user-line"></i>LOGIN</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="no-underline">SIGNUP</a>
                </li>
            </ul>
        </div>
    </div>
  </nav>