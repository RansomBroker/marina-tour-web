<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Smith Travel Bali</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 24px;
            color: #334155;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            border: 1px solid #e2e8f0;
        }
        .hero {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            padding: 36px 28px;
            text-align: center;
        }
        .hero-tag {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 4px 14px;
            border-radius: 9999px;
            margin-bottom: 12px;
        }
        .hero h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .hero p {
            margin: 8px 0 0 0;
            font-size: 14px;
            color: #e0f2fe;
        }
        .content {
            padding: 32px 28px;
        }
        .greeting {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #1e293b;
        }
        .booking-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }
        .booking-code {
            font-size: 13px;
            color: #64748b;
        }
        .code-val {
            font-weight: 800;
            color: #0284c7;
            font-size: 15px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #e2e8f0;
            font-size: 14px;
        }
        .detail-row:last-child {
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
        .total-box {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 2px solid #cbd5e1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-label {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
        }
        .total-price {
            font-size: 18px;
            font-weight: 800;
            color: #0284c7;
        }
        .notice-box {
            background-color: #ecfdf5;
            border: 1px solid #a7f3d0;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 24px;
        }
        .notice-title {
            color: #065f46;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .notice-desc {
            color: #047857;
            font-size: 13px;
            line-height: 1.5;
            margin: 0;
        }
        .cta-container {
            text-align: center;
            margin: 28px 0 10px 0;
        }
        .btn-wa {
            display: inline-block;
            background-color: #10b981;
            color: #ffffff !important;
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
        }
        .footer {
            background-color: #f1f5f9;
            padding: 24px 28px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            line-height: 1.6;
        }
        .footer a {
            color: #0284c7;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Hero Header -->
        <div class="hero">
            <span class="hero-tag">Reservation Received</span>
            <h1>Thank You for Your Booking!</h1>
            <p>Your Bali adventure is just around the corner.</p>
        </div>

        <!-- Body Content -->
        <div class="content">
            <div class="greeting">
                Dear <strong>{{ $booking->full_name }}</strong>,<br><br>
                Thank you for choosing <strong>Smith Travel Bali</strong>! We have received your tour reservation request and our team is now preparing the best itinerary experience for you.
            </div>

            <!-- Booking Summary -->
            <div class="booking-card">
                <div class="booking-header">
                    <span class="booking-code">Booking Reference: <strong class="code-val">#{{ $booking->booking_code }}</strong></span>
                    <span style="font-size: 12px; color: #10b981; font-weight: 700; background: #d1fae5; padding: 3px 10px; border-radius: 999px;">Received</span>
                </div>

                <div class="detail-row">
                    <span class="label">Tour Package</span>
                    <span class="value">{{ $booking->package->name ?? '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Travel Date</span>
                    <span class="value">{{ $booking->travel_date ? $booking->travel_date->format('l, d F Y') : '-' }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Number of Guests</span>
                    <span class="value">{{ $booking->number_of_pax }} Person(s)</span>
                </div>
                <div class="detail-row">
                    <span class="label">Pickup Location</span>
                    <span class="value">{{ $booking->pickup_location }}</span>
                </div>
                @if($booking->special_request)
                <div class="detail-row">
                    <span class="label">Special Request</span>
                    <span class="value" style="max-width: 60%; word-break: break-word;">{{ $booking->special_request }}</span>
                </div>
                @endif
                <div class="total-box">
                    <span class="total-label">Total Tour Price</span>
                    <span class="total-price">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Important Next Steps Notice -->
            <div class="notice-box">
                <div class="notice-title">
                    💬 What Happens Next?
                </div>
                <p class="notice-desc">
                    Our Customer Service team will contact you shortly via <strong>WhatsApp</strong> at <strong>{{ $booking->whatsapp_number }}</strong> to confirm schedule availability and guide you through the reservation deposit payment.
                </p>
            </div>

            @php
                $targetWa = preg_replace('/[^0-9]/', '', \App\Models\Setting::get('whatsapp_number', '6281234567890'));
                $waText = urlencode("Hi Smith Travel Bali! I have submitted a booking with code #" . $booking->booking_code . " for " . ($booking->package->name ?? 'tour') . ". Could you please confirm my reservation?");
            @endphp

            <!-- Direct Contact Button -->
            <div class="cta-container">
                <a href="https://wa.me/{{ $targetWa }}?text={{ $waText }}" class="btn-wa" target="_blank">
                    Chat with Us on WhatsApp
                </a>
                <p style="font-size: 12px; color: #94a3b8; margin-top: 10px;">
                    Have questions? We are always ready to assist you.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <strong>Smith Travel Bali</strong><br>
            Jl. Raya Ubud, Gianyar, Bali — Indonesia<br>
            Email: <a href="mailto:{{ \App\Models\Setting::get('admin_email', 'Kadekekahospitality@gmail.com') }}">{{ \App\Models\Setting::get('admin_email', 'Kadekekahospitality@gmail.com') }}</a><br>
            <span style="font-size: 11px; color: #94a3b8; display: inline-block; margin-top: 8px;">
                &copy; {{ date('Y') }} Smith Travel Bali. All rights reserved.
            </span>
        </div>
    </div>
</body>
</html>
