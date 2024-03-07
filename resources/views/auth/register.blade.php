@extends('layout.loginlayout')

@section('registerform')
<div class="wrapper">
    <div class="form-box">
        <div class="form-content-register">

            <h1>
                REGISTER
            </h1>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-field-name">
                    <input type="text" name="first_name" id="first_name" placeholder="Firstname">
                    @error('first_name')
                    <span class="d-block fs-6 text-danger mt-2"> {{$message}}</span>
                    @enderror
                </div>
                <div class="input-field-name">
                    <input type="text" name="last_name" id="last_name" placeholder="Lastname">
                    @error('last_name')
                    <span class="d-block fs-6 text-danger mt-2"> {{$message}}</span>
                    @enderror
                    <input type="text" name="middle_name" id="middle_name" placeholder="Middlename">
                    @error('middle_name')
                    <span class="d-block fs-6 text-danger mt-2"> {{$message}}</span>
                    @enderror
                </div>


                <div class="input-field">
                    <input type="text" name="email" id="email" placeholder="Email"><i class="ri-user-line"></i>
                    @error('email')
                    <span class="d-block fs-6 text-danger mt-2"> {{$message}}</span>
                    @enderror
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" placeholder="Password"><i class="ri-lock-2-fill"></i>
                    @error('password')
                    <span class="d-block fs-6 text-danger mt-2"> {{$message}}</span>
                    @enderror
                </div>
                <div class="input-field">
                    <input type="password" name="password_confirmation" id="confirm-password" placeholder="Confirm Password"><i class="ri-lock-2-fill"></i>
                    @error('confirm-password')
                    <span class="d-block fs-6 text-danger mt-2"> {{$message}}</span>
                    @enderror
                </div>
                <button type="submit" name="submit" class="btn" value="submit">Register</button>
            </form>
            <div class="bottom-link">
                <p>
                    Already have an account? <a href="{{ route('login') }}"> Login now</a>
                </p>
            </div>
        </div>
        <div class="form-details-register">

        </div>
    </div>
</div>
@endsection