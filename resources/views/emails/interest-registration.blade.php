<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <title>Your Laufey Live interest is on the list</title>
</head>
<body style="margin:0; padding:0; background-color:#f5efe7; color:#382b35; font-family:Georgia,'Times New Roman',serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#f5efe7; padding:36px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width:580px; background-color:#fffdf9; border:1px solid #d8c29e;">
                    <tr>
                        <td style="padding:8px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border:1px solid #eadfd2;">
                                <tr>
                                    <td align="center" style="padding:40px 28px 36px;">
                                        <p style="margin:0 0 16px; color:#a45e70; font-family:Arial,sans-serif; font-size:10px; font-weight:bold; letter-spacing:3px; text-transform:uppercase;">A night for the romantics</p>
                                        <h1 style="margin:0; color:#382b35; font-size:48px; font-weight:normal; letter-spacing:-2px; line-height:1.1;">Laufey <span style="color:#a45e70; font-style:italic;">Live</span></h1>
                                        <p style="margin:20px 0 0; color:#756973; font-family:Arial,sans-serif; font-size:14px; line-height:1.8;">Dear {{ $registration->full_name }},<br>your interest has found its way to us. Thank you for being part of the daydream.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 32px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-top:1px solid #eadfd2; border-bottom:1px solid #eadfd2;">
                                            <tr>
                                                <td style="padding:20px 8px; color:#8a747d; font-family:Arial,sans-serif; font-size:10px; letter-spacing:1.5px; text-transform:uppercase;">Your selection</td>
                                                <td align="right" style="padding:20px 8px; color:#382b35; font-family:Arial,sans-serif; font-size:13px; font-weight:bold;">{{ $registration->ticket_type }} · {{ $registration->ticket_count }} {{ $registration->ticket_count === 1 ? 'ticket' : 'tickets' }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding:28px 32px 38px;">
                                        <p style="margin:0; color:#756973; font-family:Arial,sans-serif; font-size:13px; line-height:1.8;">This is an expression of interest only. It is not a ticket, booking, or confirmation of a concert date.</p>
                                        <p style="margin:24px 0 0; color:#a45e70; font-size:19px; font-style:italic;">Until then, keep a song in your heart. ♡</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <p style="margin:18px 0 0; color:#897e83; font-family:Arial,sans-serif; font-size:10px; line-height:1.6;">A fan-made registration page · Not an official ticketing site</p>
            </td>
        </tr>
    </table>
</body>
</html>
