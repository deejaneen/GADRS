@extends('layout.loginlayout')

@section('loginform')
<div class="content-container login-container {{ old('formType') === 'signup' ? 'active' : '' }}">
    <div class="form-container sign-in">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h4>Sign In</h4>
            <div class="login">
                <input type="email" placeholder="Email" name="login_email" id="email-login">
                @error('login_email')
                <span class="d-block text-danger"> {{ $message }}</span>
                @enderror
                <div class="password-container">
                    <input type="password" placeholder="Password" class="password-field" name="login_password" id="password-login">
                    @error('login_password')
                    <span class="d-block text-danger"> {{ $message }}</span>
                    @enderror
                    <i class="fa-solid fa-eye show-password signinshowpassword"></i>
                </div>
                <a href="{{ route('forget.password') }}">Forgot Password?</a>
                <button type="submit" name="submit" value="submit">Sign In</button>
                <input type="hidden" name="formType" value="login">
            </div>
        </form>
    </div>
    <div class="form-container sign-up">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <h4>Create Account</h4>
            <div class="registration">
                <input type="text" placeholder="First Name" name="first_name" id="first_name">
                @error('first_name')
                <span class="d-block text-danger"> {{ $message }}</span>
                @enderror
                <input type="text" placeholder="Middle Name" name="middle_name" id="middle_name">
                @error('middle_name')
                <span class="d-block text-danger"> {{ $message }}</span>
                @enderror
                <input type="text" placeholder="Last Name" name="last_name" id="last_name">
                @error('last_name')
                <span class="d-block text-danger"> {{ $message }}</span>
                @enderror
                <input type="email" placeholder="Email" name="email" id="email">
                @error('email')
                <span class="d-block text-danger"> {{ $message }}</span>
                @enderror
                <input type="text" name="contact_number" id="contact_number" placeholder="Contact No: (e.g., 09123456789)" maxlength="11">
                @error('contact_number')
                <span class="d-block text-danger"> {{ $message }}</span>
                @enderror
                <div class="password-container">
                    <input type="password" placeholder="Password" class="password-field" name="password" id="password">
                    @error('signup_password')
                    <span class="d-block text-danger"> {{ $message }}</span>
                    @enderror
                    <i class="fa-solid fa-eye show-password signupshowpassword"></i>
                </div>
                <div class="confirm-password-container">
                    <input type="password" placeholder="Confirm Password" class="password-field" name="password_confirmation" id="confirm-password">
                    @error('password_confirmation')
                    <span class="d-block text-danger"> {{ $message }}</span>
                    @enderror
                    <i class="fa-solid fa-eye show-password signupconfirmpassword"></i>
                </div>
                <button type="submit" name="submit" value="submit">Sign Up</button>
                <input type="hidden" name="formType" value="signup">
            </div>
        </form>
    </div>
    <div class="toggle-container">
        <div class="toggle">
            <div class="toggle-panel toggle-left">
                <h1>Welcome Guest!</h1>
                <p>Register with your personal details to use all of site features</p>
                <button class="hidden" id="login">Sign In</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Enter your personal details to use all of site features</p>

                <button class="hidden" id="register">Sign Up</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.login-container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');
        const showPasswordIcons = document.querySelectorAll('.show-password');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
            document.querySelector('input[name="formType"]').value = 'signup';
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
            document.querySelector('input[name="formType"]').value = 'login';
        });

        showPasswordIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                const passwordField = this.previousElementSibling;
                this.classList.toggle('fa-eye-slash');
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
            });
        });

        const contactNumberInput = document.getElementById('contact_number');

        // Restrict input to numbers only
        contactNumberInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters

            // Ensure it starts with '09' and is at most 11 digits long
            if (this.value.length > 0 && !this.value.startsWith('09')) {
                this.value = '09';
            }

            if (this.value.length > 11) {
                this.value = this.value.slice(0, 11); // Truncate to 11 characters
            }
        });

        // Optionally prevent pasting non-numeric characters
        contactNumberInput.addEventListener('paste', function(e) {
            let pasteData = (e.clipboardData || window.clipboardData).getData('text');
            if (!/^\d*$/.test(pasteData)) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
