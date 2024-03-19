@extends('layout.newloginlayout')

@section('newregisterform')
    <div class="container">
        <div class="register-container">
            <div class="color02">
            </div>

            <div class="register-section">
                <h3 class="register-title">
                    Register
                </h3>
                <form action="{{ route('register') }}"method="post">
                    @csrf
                    <div class="input-field firstname">
                        <input type="text" name="firstname" id="email" placeholder="Firstname"><i
                            class="ri-user-line"></i>
                        @error('email')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field middlename">
                        <input type="text" name="middlename" id="middlename" placeholder="Middlename"><i
                            class="ri-user-line"></i>
                        @error('email')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field lastname">
                        <input type="text" name="lastname" id="lastname" placeholder="Lastname"><i
                            class="ri-user-line"></i>
                        @error('email')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-field useremail">
                        <input type="email" name="email" id="email" placeholder="Email"><i
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
                    <div class="input-field password">
                        <input type="password" name="password" id="password" placeholder="Confirm Password"><i
                            class="ri-lock-2-fill"></i>
                        @error('password')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }}</span>
                        @enderror
                    </div>
                    <button class="btn-register btn btn-primary">Register</button>
                </form>
                <div class="bottom-link">
                    <p>
                        Already have an account? <a href="{{ route('register') }}" style="color: var(--color-orange)">
                            Login</a>
                    </p>
                </div>
            </div>


            <div class="color01">

            </div>
        </div>

    </div>
@endsection
