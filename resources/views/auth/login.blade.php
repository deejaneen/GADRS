@extends('layout.loginlayout')

@section('loginform')
    <div class="content-container login-container">
        <div class="form-container sign-in">
            <form>
                <h4>Sign In</h4>
                <div class="login">
                    <input type="email" placeholder="Email">
                    <div class="password-container">
                        <input type="password" placeholder="Password" class="password-field">
                        <i class="fa-solid fa-eye show-password signinshowpassword"></i>
                    </div>
                    <a href="{{ route('forget.password') }}">Forgot Password?</a>
                    <button>Sign In</button>
                </div>
            </form>
        </div>
        <div class="form-container sign-up">
            <form>
                <h4>Create Account</h4>
                <div class="registration">
                    <input type="text" placeholder="First Name">
                    <input type="text" placeholder="Middle Name">
                    <input type="text" placeholder="Last Name">
                    <input type="email" placeholder="Email">
                    <input type="text" placeholder="Contact Number">
                    <div class="password-container">
                        <input type="password" placeholder="Password" class="password-field">
                        <i class="fa-solid fa-eye show-password signupshowpassword"></i>
                    </div>
                    <div class="confirm-password-container">
                        <input type="password" placeholder="Confirm Password" class="password-field">
                        <i class="fa-solid fa-eye show-password signupconfirmpassword"></i>
                    </div>                    
                    <button>Sign Up</button>
                    
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
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.querySelector('.login-container');
        const registerBtn = document.getElementById('register');
        const loginBtn = document.getElementById('login');
        const showPasswordIcons = document.querySelectorAll('.show-password');

        registerBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });

        showPasswordIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                const passwordField = this.previousElementSibling;
                this.classList.toggle('fa-eye-slash');
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
            });
        });
    });
</script>

