<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 20px; background-color: #ffffff; border-radius: 10px;">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td style="text-align: center;">
                            <h2 style="color: #333333; margin: 0;">New Contact Form Submission</h2>
                            <hr style="border-top: 2px solid #5e9ad6; width: 50px; margin: 20px auto;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="color: #666666;">Hello Admin,</p>
                            <p style="color: #666666;">A new contact form submission has been received. Here are the details:</p>
                            <table cellpadding="5" cellspacing="0" width="100%" style="background-color: #f9f9f9; border-radius: 5px;">
                                <tr>
                                    <td style="font-weight: bold; color: #5e9ad6; width: 30%;">Name:</td>
                                    <td style="color: #333333;">{{ $formData['name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; color: #5e9ad6;">Email:</td>
                                    <td style="color: #333333;">{{ $formData['email'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; color: #5e9ad6;">Subject:</td>
                                    <td style="color: #333333;">{{ $formData['subject'] }}</td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold; color: #5e9ad6;">Message:</td>
                                    <td style="color: #333333;">{{ $formData['message'] }}</td>
                                </tr>
                            </table>
                            <br>
                            <p style="color: #666666;">Please take necessary action as soon as possible.</p><br>
                            <p style="color: #666666;">Best regards,</p>
                            <p style="color: #5e9ad6;">{{ env('APP_NAME') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
