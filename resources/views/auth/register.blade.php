@extends('layout.loginlayout')

@section('registerform')
<div class="wrapper">
    <div class="form-box">
        <div class="form-content-register">

            <h1 style="color: var(--color-orange)">
                REGISTER
            </h1>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-field">
                    <input type="text" name="first_name" id="first_name" placeholder="Firstname">
                    @error('first_name')
                    <span class="d-block text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field">
                    <input type="text" name="middle_name" id="middle_name" placeholder="Middlename">
                    @error('middle_name')
                    <span class="d-block text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field">
                    <input type="text" name="last_name" id="last_name" placeholder="Lastname">
                    @error('last_name')
                    <span class="d-block text-danger"> {{ $message }}</span>
                    @enderror

                </div>

                <div class="input-field">
                    <input type="text" name="email" id="email" placeholder="Email"><i class="fa-solid fa-envelope"></i>
                    @error('email')
                    <span class="d-block text-danger"> {{ $message }}</span>
                    @enderror
                </div>

                <div class="input-field">
                    <input type="text" name="contact_number" id="contact_number" placeholder="(e.g., 09123456789)" maxlength="11"><i class="fas fa-mobile-alt"></i>
                    @error('email')
                    <span class="d-block text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" placeholder="Password"><i class="ri-lock-2-fill"></i>
                    @error('password')
                    <span class="d-block text-danger"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-field">
                    <input type="password" name="password_confirmation" id="confirm-password" placeholder="Confirm Password"><i class="ri-lock-2-fill"></i>
                    @error('confirm-password')
                    <span class="d-block text-danger"> {{ $message }}</span>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
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