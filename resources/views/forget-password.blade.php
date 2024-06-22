@extends('layout.loginlayout')

@section('content')
    <main>
        <div class="container" style="width: 500px;display: flex;
    align-items: center;
    justify-content: center;">
            <div class="reset-password-container">
                <h3>We willl send a link to your email, use that link to reset password.</h3>
                <form action="{{ route('forget.password.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label" style="color: var(--color-orange);">Enter Your Email address</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <button class="btn btn-submit">Submit</button>
                </form>
            </div>


        </div>
    </main>
@endsection
