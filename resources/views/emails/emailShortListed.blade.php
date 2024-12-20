<!DOCTYPE html>
<html>

<head>
    <title>Application Status: Rejected</title>
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
    <h1>Application Status: Rejected</h1>
    <p>Dear {{ $user->name }},</p>
    <p>We regret to inform you that your application for the position of <strong>{{ $post->title }}</strong> has not
        been successful at this time. We appreciate your interest in the position and encourage you to apply for future
        opportunities with us.</p>
    <p>Thank you again for your time and effort.</p>

    <!-- Footer -->
    <div class="footer">
        <p style="margin: 10px 0;">Cambridge InfoTech Pvt. Ltd, New Baneshwor, Kathmandu</p>
        <p style="margin: 10px 0 color: #0867ec; text-decoration: none;"><a href="https://cambridge.com.np/"
                target="_blank">Website</a> If you have any more queries, please visit our website.</p>
    </div>
</body>

</html>
