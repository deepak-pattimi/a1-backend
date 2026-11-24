<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Appointment Notification</title>
</head>
<body style="margin: 0; padding: 20px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f4f7f9; color: #333333;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 650px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 1px solid #e1e8ed;">
        <!-- Header -->
        <tr>
            <td style="background: linear-gradient(135deg, #1A365D 0%, #007791 100%); padding: 25px 30px; text-align: center;">
                <h1 style="margin: 0; color: #ffffff; font-size: 22px; font-weight: 700; letter-spacing: 0.5px;">A1 LAPAROSCOPY HOSPITAL</h1>
                <p style="margin: 6px 0 0 0; color: #d0f0fd; font-size: 14px;">Center of Excellence in Laparoscopic & Laser Surgery</p>
            </td>
        </tr>

        <!-- Alert Banner -->
        <tr>
            <td style="background-color: #e6f7f5; padding: 14px 30px; border-bottom: 2px solid #00A896;">
                <p style="margin: 0; color: #00766c; font-size: 15px; font-weight: 600;">
                    🔔 New Appointment Booked {{ $appointment->payment_method === 'online' ? '(Razorpay Paid)' : '(Pay at Clinic)' }}
                </p>
            </td>
        </tr>

        <!-- Main Body -->
        <tr>
            <td style="padding: 25px 30px;">
                <p style="margin: 0 0 18px 0; font-size: 14px; color: #555555; line-height: 1.5;">
                    A new appointment has been booked on the website. Below are the complete patient and payment details:
                </p>

                <!-- Patient & Appointment Details Table -->
                <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin-bottom: 25px; border: 1px solid #e5e9ec; border-radius: 6px; overflow: hidden;">
                    <thead>
                        <tr style="background-color: #f8fafc;">
                            <th colspan="2" style="padding: 12px 16px; text-align: left; font-size: 14px; font-weight: 700; color: #1A365D; border-bottom: 2px solid #e2e8f0;">
                                👤 Patient & Appointment Information
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 10px 16px; width: 38%; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Appointment ID</td>
                            <td style="padding: 10px 16px; color: #1a202c; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: 700;">#{{ $appointment->id }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Patient Full Name</td>
                            <td style="padding: 10px 16px; color: #1a202c; border-bottom: 1px solid #edf2f7; font-size: 14px; font-weight: 700;">{{ $appointment->fullname }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Mobile Number</td>
                            <td style="padding: 10px 16px; color: #007791; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: 600;">
                                <a href="tel:{{ $appointment->mobile }}" style="color: #007791; text-decoration: none;">📞 {{ $appointment->mobile }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Email Address</td>
                            <td style="padding: 10px 16px; color: #1a202c; border-bottom: 1px solid #edf2f7; font-size: 13px;">
                                @if(!empty($appointment->email) && $appointment->email !== 'usernotselected@gmail.com')
                                    <a href="mailto:{{ $appointment->email }}" style="color: #007791; text-decoration: none;">✉️ {{ $appointment->email }}</a>
                                @else
                                    <span style="color: #a0aec0; font-style: italic;">Not provided</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Appointment Date</td>
                            <td style="padding: 10px 16px; color: #1a202c; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: 600;">
                                📅 {{ \Carbon\Carbon::parse($appointment->selected_date)->format('D, d M Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Appointment Time</td>
                            <td style="padding: 10px 16px; color: #1a202c; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: 600;">
                                ⏰ {{ $appointment->selected_time }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Selected Problem / Disease</td>
                            <td style="padding: 10px 16px; color: #1a202c; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: 600;">
                                🩺 {{ $appointment->reason }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; font-size: 13px; vertical-align: top;">Notes / Doctor Preference</td>
                            <td style="padding: 10px 16px; color: #2d3748; font-size: 13px; line-height: 1.5; white-space: pre-line;">
                                {{ $appointment->message ?: 'No additional notes' }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Payment Details Table -->
                <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse; margin-bottom: 25px; border: 1px solid #e5e9ec; border-radius: 6px; overflow: hidden;">
                    <thead>
                        <tr style="background-color: #f8fafc;">
                            <th colspan="2" style="padding: 12px 16px; text-align: left; font-size: 14px; font-weight: 700; color: #1A365D; border-bottom: 2px solid #e2e8f0;">
                                💳 Payment Details
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 10px 16px; width: 38%; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Payment Method</td>
                            <td style="padding: 10px 16px; border-bottom: 1px solid #edf2f7; font-size: 13px; font-weight: 700; color: #1a202c;">
                                @if($appointment->payment_method === 'online')
                                    <span style="color: #2b6cb0;">Razorpay (Online Payment)</span>
                                @else
                                    <span style="color: #4a5568;">Offline (Pay at Clinic)</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Amount</td>
                            <td style="padding: 10px 16px; border-bottom: 1px solid #edf2f7; font-size: 15px; font-weight: 700; color: #1a202c;">
                                ₹{{ number_format((float)$appointment->amount, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Payment Status</td>
                            <td style="padding: 10px 16px; border-bottom: 1px solid #edf2f7; font-size: 13px;">
                                @if($appointment->payment_status === 'completed')
                                    <span style="background-color: #def7ec; color: #03543f; padding: 3px 10px; border-radius: 12px; font-weight: 700; font-size: 12px; display: inline-block;">
                                        ✅ COMPLETED
                                    </span>
                                @elseif($appointment->payment_status === 'pending')
                                    <span style="background-color: #fef08a; color: #854d0e; padding: 3px 10px; border-radius: 12px; font-weight: 700; font-size: 12px; display: inline-block;">
                                        ⏳ PENDING (PAY AT CLINIC)
                                    </span>
                                @else
                                    <span style="background-color: #fed7d7; color: #9b1c1c; padding: 3px 10px; border-radius: 12px; font-weight: 700; font-size: 12px; display: inline-block;">
                                        {{ strtoupper($appointment->payment_status) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @if(!empty($appointment->transaction_id))
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; border-bottom: 1px solid #edf2f7; font-size: 13px;">Transaction / Order ID</td>
                            <td style="padding: 10px 16px; border-bottom: 1px solid #edf2f7; font-size: 12px; font-family: monospace; color: #4a5568;">
                                {{ $appointment->transaction_id }}
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600; color: #4a5568; background-color: #fcfdfe; font-size: 13px;">Booking Time</td>
                            <td style="padding: 10px 16px; color: #718096; font-size: 12px;">
                                {{ $appointment->created_at ? $appointment->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : now()->timezone('Asia/Kolkata')->format('d M Y, h:i A') }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Admin Button -->
                <div style="text-align: center; margin-top: 30px; margin-bottom: 10px;">
                    <a href="https://admin.a1laparoscopyhospital.com/admin/appointments" style="background-color: #00A896; color: #ffffff; padding: 12px 28px; text-decoration: none; font-size: 14px; font-weight: 700; border-radius: 6px; display: inline-block; box-shadow: 0 2px 4px rgba(0,168,150,0.3);">
                        View Appointments in Admin Panel &rarr;
                    </a>
                </div>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background-color: #f8fafc; padding: 18px 30px; text-align: center; border-top: 1px solid #e2e8f0; font-size: 12px; color: #718096;">
                <p style="margin: 0 0 4px 0;">This is an automated notification from <strong>A1 Laparoscopy Hospital</strong> booking system.</p>
                <p style="margin: 0;">Address: 14-38-1, Gokhale Road, Opp. American Hospital, Maharani Peta, Visakhapatnam, AP 530002</p>
            </td>
        </tr>
    </table>
</body>
</html>
