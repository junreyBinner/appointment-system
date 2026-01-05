<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f9fafb; padding:20px;">
    <div style="max-width:500px; margin:auto; background:#ffffff; padding:20px; border-radius:8px;">
        <h2 style="color:#111827;">Email Verification</h2>

        <p>Hello,</p>

        <p>
            Your one-time verification code is:
        </p>

        <h1 style="letter-spacing:4px; color:#2563eb;">
            {{ $otp }}
        </h1>

        <p>
            This code will expire at <strong>{{ $expiresAt }}</strong>.
        </p>

        <p>
            If you did not request this code, please ignore this email.
        </p>

        <p style="margin-top:30px; font-size:12px; color:#6b7280;">
            This is an automated message. Please do not reply.
        </p>

        <p>
            – Appointment System
        </p>
    </div>
</body>
</html>
