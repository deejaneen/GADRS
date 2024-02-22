@extends('layout.loginlayout')

@section('registerform')
    <div class="wrapper">
        <div class="form-box">
            <div class="form-content-register">
                <h1>
                    REGISTER
                </h1>
                <form action="#">
                    <div class="input-field-name">
                        <input type="text" name="" id="" placeholder="Firstname">
                    </div>
                    <div class="input-field-name">
                        <input type="text" name="" id="" placeholder="Lastname">
                        <input type="text" name="" id="" placeholder="M.I.">
                    </div>

                    <div class="input-field">
                        <input type="text" name="" id="" placeholder="Email"><i class="ri-user-line"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" id="" placeholder="Password"><i class="ri-lock-2-fill"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="" id="" placeholder="Re-enter Password"><i
                            class="ri-lock-2-fill"></i>
                    </div>
                    <button type="submit" class="btn">Register</button>
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
