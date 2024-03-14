@extends('layout.newloginlayout')

@section('newloginform')
    <div class="container">
        <div class="login-container">
            <div class="color01">
            </div>
            {{-- <form action="{{ route('login') }}"method="post"> --}}
            {{-- @csrf --}}
            <div class="login-section">
                <h3 class="login-title">
                    Login
                </h3>
                <div class="input-field useremail">
                    <input type="email" name="email" id="email" placeholder="Username/Email"><i
                        class="ri-user-line"></i>
                    @error('email')
                        <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field password">
                    <input type="password" name="password" id="password" placeholder="Password"><i
                        class="ri-lock-2-fill"></i>
                    @error('password')
                        <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                    @enderror
                </div>
                <p class="forgot-password">
                    <a href="" style="color: var(--color-orange)">Forgot Password?</a>
                </p>
                <button class="btn-login btn btn-primary">Login</button>
                {{-- </form> --}}
                <div class="bottom-link">
                    <p>
                        Don't have an account? <a href="{{ route('register') }}" style="color: var(--color-orange)">
                            Register</a>
                    </p>
                </div>
            </div>


            <div class="color02">

            </div>
        </div>

    </div>
@endsection
