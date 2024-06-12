<nav class="navbar navbar-expand-lg ">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{asset('images/COA CAR logo.png')}}" alt="">&nbsp;COA- <span style="color: var(--color-warning)">CAR</span></a>
        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <div class="centered">
            </div>
            <div class="main-login">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-itez m">
                        <a href="{{ route('login') }}" class="{{(Route::is('login')) ? 'login-active ' : '' }}">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="{{(Route::is('register')) ? 'login-active ' : '' }}">REGISTER</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>