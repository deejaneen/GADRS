@extends('layout.loginlayout')

@section('content')
    <main>
        <div class="container " style="margin-left:auto; margin-right:auto;">
            <div class="reset-password-container" style="">
                <h2>Please enter your Email and New Password.</h2>
                <form action="{{ route('reset.password.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div>
                        <label for="password">New Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div>
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" required>
                    </div>
                    <button class="btn btn-submit" type="submit">Reset Password</button>
                </form>
            </div>
        </div>

    </main>
@endsection
