@extends('layout.weblayout')

@section('verify-email')
<div class="container">
    <div class="verify-email-card">
        <h1>Verify Your Email Address</h1>
        @if (session('message'))
            <p>{{ session('message') }}</p>
        @endif
        <p>A fresh verification link has been sent to your email address.</p>
        <p>Before proceeding, please check your email for a verification link.</p>
        <p>If you did not receive the email, <a href="{{ route('verification.send') }}"
                onclick="event.preventDefault(); document.getElementById('resend-form').submit();">click here to request
                another</a>.</p>
        <form id="resend-form" method="POST" action="{{ route('verification.send') }}" style="display: none;">
            @csrf
        </form>
    </div>
</div>
    
@endsection
