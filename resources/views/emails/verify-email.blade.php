<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
</head>

<body>
    <h1>Hello, {{ $data['user'] }}</h1>
    <p>Thank you for registering! Please verify your email address by clicking the link below:</p>
    <p>
        <a href=" {{ $data['verifyLink'] }}">Verify Email Address</a>
    </p>
    <p>If you did not create an account, no further action is required.</p>
    <p>Thank you!</p>

    <!-- Footer -->
    <div class="footer" style="text-align: center; margin-top: 30px; font-size: 14px; color: #999;">
        <p style="margin: 10px 0;">Cambridge InfoTech Pvt. Ltd, New Baneshwor, Kathmandu</p>
        <p style="margin: 10px 0 color: #0867ec; text-decoration: none;"><a href="https://cambridge.com.np/"
                target="_blank">Website</a> If you have any more queries, please visit our website.</p>
    </div>
</body>

</html>
