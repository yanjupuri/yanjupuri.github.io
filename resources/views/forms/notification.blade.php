<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Reply Notification</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
        }
        h2 {
            color: #333333;
            margin: 0;
            text-align: center;
        }
        hr {
            border-top: 2px solid #5e9ad6;
            width: 50px;
            margin: 20px auto;
        }
        p {
            color: #666666;
        }
        .button {
            display: inline-block;
            background-color: #2d3748;
            color: #ffffff !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Review Reply Notification</h2>
    <hr>
    <p>Dear {{ $full_name }},</p>
    <p>Your review has been replied to by an admin. Click the button below to view the reply:</p>
    <center>
        <a href="{{ $replyUrl }}" class="button">View Reply</a>
    </center>
    <p>We appreciate your participation.</p>
    <p>Best regards,</p>
    <p>{{ env('APP_NAME') }}</p>
</div>

</body>
</html>
