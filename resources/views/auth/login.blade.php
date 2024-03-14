@extends('layout.loginlayout')

@section('loginform')
<div class="wrapper">
    <div class="form-box">
        <div class="form-content">
            <h1>
                LOGIN
            </h1>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-field ">
                    <input type="email" name="email" id="email" placeholder="Username/Email"><i class="ri-user-line"></i>
                    @error('email')
                    <span class="d-block fs-6 text-danger mt-2"> {{$message}}</span>
                    @enderror
                </div>
                <div class="input-field ">
                    <input type="password" name="password" id="password" placeholder="Password"><i class="ri-lock-2-fill"></i>
                    @error('password')
                    <span class="d-block fs-6 text-danger mt-2"> {{$message}}</span>
                    @enderror
                </div>
                <div class="forgot">
                    <a href="#" class="forgot-password">
                        Forgot password?
                    </a>
                </div>
                <button type="submit" name="submit" value="submit" class="btn">Log In</button>
            </form>
            <div class="bottom-link">
                <p>
                    Don't have an account? <a href="{{route('register')}}"> Register</a>
                </p>
            </div>
        </div>
        <div class="form-details">

        </div>
    </div>
</div>
@endsection