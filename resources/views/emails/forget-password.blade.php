<div class="container">
    <div class="header">
        <h2>Password Reset</h2>
    </div>
    <div class="content">
        <p>Hello User,</p>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <p>Please click the button below to reset your password:</p>
        <p><a href="{{ route('reset.password', $token) }}" class="button">Reset Password</a></p>
        <p>If you did not request a password reset, no further action is required.</p>
        <p>Thank you!</p>
    </div>
</div>