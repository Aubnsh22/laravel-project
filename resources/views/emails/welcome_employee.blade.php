<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome to AubCharika</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }
        .header {
            background: linear-gradient(195deg, #ffb300, #ff9305, #f8eec4);
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            color: #000;
        }
        .content {
            padding: 20px;
            background: #fff;
            border-radius: 0 0 8px 8px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #777;
        }
        .credentials {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Welcome to AubCharika!</h2>
        </div>
        <div class="content">
            <p>Dear {{ $employee['full_name'] }},</p>
            <p>We are excited to welcome you to the AubCharika team! Your account has been created successfully. Below are your login credentials:</p>
            <div class="credentials">
                <p><strong>Username:</strong> {{ $employee['username'] }}</p>
                <p><strong>Email:</strong> {{ $employee['email'] }}</p>
                <p><strong>Password:</strong> {{ $password }}</p>
            </div>
            <p>Please use these credentials to log in to our system at <a href="{{ url('/signin') }}">AubCharika Login</a>. We recommend changing your password after your first login for security purposes.</p>
            <p>If you have any questions, feel free to contact our support team.</p>
            <p>Best regards,<br>The AubCharika Team</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} AubCharika. All rights reserved.</p>
        </div>
    </div>
</body>
</html>