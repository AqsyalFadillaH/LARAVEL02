<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verification Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .otp-code {
            font-size: 32px;
            letter-spacing: 5px;
            font-weight: bold;
            text-align: center;
            color: #1a73e8;
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Hi {{ $user->name }},</h2>
        </div>
        <p>Your verification code is:</p>
        <div class="otp-code">{{ $otp }}</div>
        <p>This code will expire in 10 minutes.</p>
        <p>If you did not request this code, please ignore this email.</p>
        <div class="footer">
            <p>Thank you,<br>The Team</p>
        </div>
    </div>
</body>
</html>
