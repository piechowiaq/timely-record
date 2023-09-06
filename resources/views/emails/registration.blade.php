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
{{--            <img src="{{ $logo }}" alt="Company Logo" style="max-width: 150px;">--}}
            TIMELY RECORD
        </td>
    </tr>
    <tr>
        <td style="text-align: center; padding: 20px;">
            <h1 style="color: #333;">Welcome {{ $user }}</h1>
            <p style="font-size: 16px; color: #666;">Thank you for joining us. We're excited to have you as a member of our community.</p>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; padding: 20px;">
            <a href="{{ $url }}" style="
               display: inline-flex;
padding-top: 0.5rem;
padding-bottom: 0.5rem;
padding-left: 1rem;
padding-right: 1rem;
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
transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
transition-duration: 300ms;
transition-duration: 150ms;
transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); "
            >Register</a>
        </td>
    </tr>
</table>
</body>
</html>
