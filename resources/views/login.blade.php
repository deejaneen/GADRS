@extends('layout.loginlayout')

@section('loginform')
    <div class="wrapper">
        <div class="form-box">
            <div class="form-content">
                <h1>
                    LOGIN
                </h1>
                <form action="#">
                    <div class="input-field">
                        <input type="text" name="" id="" placeholder="Username"><i class="ri-user-line"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="" id="" placeholder="Password"><i
                            class="ri-lock-2-fill"></i>
                    </div>
                    <div class="forgot">
                        <a href="#" class="forgot-password">
                            Forgot password?
                        </a>
                    </div>
                    <button type="submit" class="btn">Log In</button>
                </form>
                <div class="bottom-link">
                    <p>
                        Don't have an account? <a href="#"> Register</a>
                    </p>
                </div>
            </div>
            <div class="form-details">

            </div>
        </div>
    </div>
@endsection
