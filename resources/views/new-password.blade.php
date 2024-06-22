@extends('layout.loginlayout')

@section('content')
    <main>
        <div class="container" style="width: 500px;">
            <h1>We willl send a link to your email, use that link to reset password.</h1>
            <form action="{{ route('reset.password.post') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <div>
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <button type="submit">Reset Password</button>
            </form>
        </div>
    </main>
@endsection
