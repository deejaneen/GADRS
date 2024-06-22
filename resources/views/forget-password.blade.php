@extends('layout.loginlayout')

@section('content')
<main>
    <div class="container" style="width: 500px;">
        <h1>We willl send a link to your email, use that link to reset password.</h1>
        <form action="{{route('forget.password.post')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email">
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>

    </div>
</main>
@endsection
