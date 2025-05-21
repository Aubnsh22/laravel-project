<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Password Reset Code</title>
</head>
<body style="font-family: 'Poppins', sans-serif; background: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 20px; border-radius: 10px; text-align: center;">
        <h2 style="color: #dc9016;">Password Reset Code</h2>
        <p style="color: #333; font-size: 16px;">You requested a password reset. Use the code below to proceed:</p>
        <h3 style="color: #dc9016; font-size: 24px; letter-spacing: 2px;">
            {{ isset($code) ? $code : 'Code not provided' }}
        </h3>
        <p style="color: #333; font-size: 14px;">This code is valid for 60 minutes.</p>
        <p style="color: #333; font-size: 14px;">If you did not request this, please ignore this email.</p>
    </div>
</body>
</html>