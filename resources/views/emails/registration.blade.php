<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
<table style="max-width: 600px; margin: 0 auto; background-color: #fff; border: 1px solid #ddd; border-radius: 5px;">
    <tr>
        <td style="text-align: center; padding: 20px;">
            <img src="https://timely-record.s3.eu-central-1.amazonaws.com/public/timely_record_logo_hor2.png" alt="Timely Record" style="max-width: 244px">
        </td>
    </tr>
    <tr>
        <td style="text-align: center; padding: 20px;">
            <h2 style="color: #333;">Welcome {{ $user }}</h2>
            <p style="font-size: 16px; color: #666;">Please click the link below to finalize user registration process.</p>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; padding: 20px;">
            <a href="{{ $url }}" style="
               display: inline-flex;
                padding: 0.5rem 1rem;
                align-items: center;
                border-radius: 0.375rem;
                border-width: 1px;
                border-color: transparent;
                font-size: 0.75rem;
                line-height: 1rem;
                font-weight: 600;
                letter-spacing: 0.1em;
                color: #ffffff;
                text-transform: uppercase;
                background-color: #1F2937;
                text-decoration: none
 "
            >Register User</a>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; padding: 20px; background-color: #0891b2; color: #fff;">
            &copy; {{ date('Y') }} <a href="timelyrecord.com" style=" color: #fff; text-decoration: none">Timely Record</a>. All rights reserved.
        </td>
    </tr>
</table>
</body>
</html>
