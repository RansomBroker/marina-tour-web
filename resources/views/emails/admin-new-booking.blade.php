<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Tour Booking Notification</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 24px;
            color: #1e293b;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        .header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #ffffff;
            padding: 28px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            letter-spacing: -0.5px;
        }
        .header p {
            margin: 6px 0 0 0;
            font-size: 13px;
            color: #94a3b8;
        }
        .content {
            padding: 28px;
        }
        .badge {
            display: inline-block;
            background-color: #e0f2fe;
            color: #0284c7;
            font-weight: 700;
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .summary-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px;
            margin: 20px 0;
        }
        .row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 14px;
        }
        .row:last-child {
            border-bottom: none;
        }
        .label {
            color: #64748b;
            font-weight: 500;
        }
        .value {
            color: #0f172a;
            font-weight: 600;
            text-align: right;
        }
        .highlight {
            color: #0284c7;
            font-size: 16px;
            font-weight: 700;
        }
        .btn-container {
            margin-top: 24px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #0284c7;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            margin: 4px;
        }
        .btn-wa {
            background-color: #10b981;
        }
        .footer {
            background-color: #f8fafc;
            padding: 18px 28px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌴 New Tour Booking Received!</h1>
            <p>Smith Travel Bali — Reservation Alert</p>
        </div>

        <div class="content">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <span class="badge">Status: {{ ucfirst($booking->status) }}</span>
                <span style="font-size: 13px; color: #64748b;">Code: <strong>#{{ $booking->booking_code }}</strong></span>
            </div>

            <p style="font-size: 15px; line-height: 1.5; margin: 0 0 16px 0;">
                A new tour booking has been placed online. Please review the customer details and schedule follow-up via WhatsApp promptly.
            </p>

            <div class="summary-box">
                <div class="row">
                    <span class="label">Tour Package</span>
                    <span class="value">{{ $booking->package->name ?? '-' }}</span>
                </div>
                <div class="row">
                    <span class="label">Customer Name</span>
                    <span class="value">{{ $booking->full_name }}</span>
                </div>
                <div class="row">
                    <span class="label">WhatsApp Number</span>
                    <span class="value">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->whatsapp_number) }}" style="color: #0284c7; text-decoration: none;">
                            {{ $booking->whatsapp_number }}
                        </a>
                    </span>
                </div>
                <div class="row">
                    <span class="label">Email Address</span>
                    <span class="value">{{ $booking->email }}</span>
                </div>
                <div class="row">
                    <span class="label">Travel Date</span>
                    <span class="value">{{ $booking->travel_date ? $booking->travel_date->format('l, d F Y') : '-' }}</span>
                </div>
                <div class="row">
                    <span class="label">Participants (Pax)</span>
                    <span class="value">{{ $booking->number_of_pax }} Person(s)</span>
                </div>
                <div class="row">
                    <span class="label">Pickup Location</span>
                    <span class="value">{{ $booking->pickup_location }}</span>
                </div>
                @if($booking->special_request)
                <div class="row">
                    <span class="label">Special Request</span>
                    <span class="value" style="max-width: 60%; word-break: break-word;">{{ $booking->special_request }}</span>
                </div>
                @endif
                <div class="row" style="margin-top: 6px; padding-top: 12px; border-top: 2px solid #cbd5e1;">
                    <span class="label" style="font-size: 15px; color: #0f172a; font-weight: 700;">Total Price</span>
                    <span class="value highlight">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="btn-container">
                <a href="{{ url('/admin/bookings') }}" class="btn">View in Admin Panel</a>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->whatsapp_number) }}?text={{ urlencode('Hi ' . $booking->full_name . ', thank you for booking with Smith Travel Bali! Regarding your reservation #' . $booking->booking_code . ' for ' . ($booking->package->name ?? 'tour') . '...') }}" class="btn btn-wa" target="_blank">Chat Customer on WhatsApp</a>
            </div>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Smith Travel Bali. Automated system notification.
        </div>
    </div>
</body>
</html>
