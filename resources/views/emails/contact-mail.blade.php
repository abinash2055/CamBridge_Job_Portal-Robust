<!DOCTYPE html>
<html>



<head>
    <title>Contact Us</title>
    <style>
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #999;
        }

        .footer a {
            color: #0867ec;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h1>New Contact Us Message For Cambridge</h1>
    <p><strong>Inquiry Type:</strong> {{ $data['inquiry_type'] }}</p>
    <p><strong>Full Name:</strong> {{ $data['full_name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Subject:</strong> {{ $data['subject'] }}</p>
    <p><strong>Message:</strong></p>
    <p>{{ $data['message'] }}</p>

    <!-- Footer -->
    <div class="footer" style="text-align: center; margin-top: 30px; font-size: 14px; color: #999;">
        <p style="margin: 10px 0;">Cambridge InfoTech Pvt. Ltd, New Baneshwor, Kathmandu</p>
        <p style="margin: 10px 0 color: #0867ec; text-decoration: none;"><a href="https://cambridge.com.np/"
                target="_blank">Website</a> If you have any more
            queries, please visit our website.</p>
    </div>
</body>

</html>
