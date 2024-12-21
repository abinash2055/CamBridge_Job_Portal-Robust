<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congratulations! You've been Shortlisted</title>
</head>

<body>
    <h1>Congratulations, {{ $data['user'] }}!</h1>
    <p>We are pleased to inform you that your application for the job "{{ $data['jobPost'] }}" has been
        <strong>shortlisted</strong>.
    </p>
    <p><strong>Application Date:</strong> {{ $data['applicationDate'] }}</p>

    <p>We will contact you soon regarding the next steps.</p>

    <p>Thank you for your interest in our company.</p>

    <p>Best Regards,<br>Cambridge InfoTech Pvt. Ltd.</p>

    <!-- Footer -->
    <div class="footer" style="text-align: center; margin-top: 30px; font-size: 14px; color: #999;">
        <p style="margin: 10px 0;">Cambridge InfoTech Pvt. Ltd, New Baneshwor, Kathmandu</p>
        <p style="margin: 10px 0 color: #0867ec; text-decoration: none;"><a href="https://cambridge.com.np/"
                target="_blank">Website</a> If you have any more queries, please visit our website.</p>
    </div>
</body>

</html>
