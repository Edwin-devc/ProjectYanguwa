<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Yanguwa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-header h1 {
            color: #007bff;
        }
        .email-content {
            margin: 20px 0;
        }
        .email-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Welcome to Yanguwa, {{ $userName }}!</h1>
        </div>
        <div class="email-content">
            <p>Hello {{ $userName }},</p>
            <p>Thank you for joining Yanguwa as a service provider! We are excited to have you on board. Below are your account login details:</p>
            <ul>
                <li><strong>Email:</strong> {{ $userEmail }}</li>
                <li><strong>Password:</strong> {{ $password }}</li>
            </ul>
            <p>For security reasons, we strongly recommend you log in to your account and change your password immediately.</p>
            <p>If you have any questions or need assistance, feel free to reach out to our support team.</p>
        </div>
        <div class="email-footer">
            <p>Best Regards,</p>
            <p>The Yanguwa Team</p>
        </div>
    </div>
</body>
</html>
