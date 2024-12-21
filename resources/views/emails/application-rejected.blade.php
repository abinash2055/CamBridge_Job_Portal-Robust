<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Application Status - Rejected</title>
</head>

<body>
    <h1>Dear {{ $data['user'] }},</h1>
    <p>We regret to inform you that your application for the job "{{ $data['jobPost'] }}" has been
        <strong>rejected</strong>.
    </p>
    <p><strong>Application Date:</strong> {{ $data['applicationDate'] }}</p>

    <p>Thank you for your interest, and we wish you all the best for your future endeavors.</p>

    <p>Best Regards,<br>Cambridge InfoTech Pvt. Ltd.</p>

    <!-- Footer -->
    <div class="footer" style="text-align: center; margin-top: 30px; font-size: 14px; color: #999;">
        <p style="margin: 10px 0;">Cambridge InfoTech Pvt. Ltd, New Baneshwor, Kathmandu</p>
        <p style="margin: 10px 0 color: #0867ec; text-decoration: none;"><a href="https://cambridge.com.np/"
                target="_blank">Website</a> If you have any more queries, please visit our website.</p>
    </div>
</body>

</html>
