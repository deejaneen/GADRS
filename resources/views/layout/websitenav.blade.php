 <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{asset('images/COA CAR logo.png')}}" alt="">&nbsp;COA-CAR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <div class="centered">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">HOME
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
                            <a href="{{ route('profile') }}" class="user no-underline"><i class="ri-user-fill"></i>NAME</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="no-underline">LOGOUT<i class="ri-logout-circle-r-line"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

  