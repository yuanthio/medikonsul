<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #3b82f6;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .booking-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #3b82f6;
        }
        .detail-row {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
        }
        .detail-label {
            font-weight: bold;
            color: #6b7280;
        }
        .detail-value {
            color: #1f2937;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6b7280;
            font-size: 14px;
        }
        .highlight {
            background: #fef3c7;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #f59e0b;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Booking Berhasil!</h1>
        <p>Terima kasih telah melakukan booking layanan kami</p>
    </div>

    <div class="content">
        <p>Halo <strong>{{ $booking->name }}</strong>,</p>
        
        <p>Kami senang menginformasikan bahwa booking Anda telah berhasil dikonfirmasi. Berikut adalah detail booking Anda:</p>

        <div class="booking-details">
            <div class="text-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">📋 Kode Booking Anda</h3>
                <div class="bg-linear-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border-2 border-blue-200 shadow-lg relative overflow-hidden">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-linear-to-r from-blue-500 to-indigo-500"></div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-linear-to-r from-blue-500 to-indigo-500"></div>
                    <div class="absolute top-0 left-0 w-1 h-full bg-linear-to-b from-blue-500 to-indigo-500"></div>
                    <div class="absolute top-0 right-0 w-1 h-full bg-linear-to-b from-blue-500 to-indigo-500"></div>
                    
                    <!-- QR Code placeholder -->
                    <div class="flex justify-center mb-4">
                        <div class="w-24 h-24 bg-white rounded-lg border-2 border-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 11h8V3H3v8zm2-6h4v4H5V5zm8-2v8h8V3h-8zm6 6h-4V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm13-2h-2v2h-2v2h2v2h2v-2h2v-2h-2v-2zm2 8h-2v2h2v-2zm-4 0h-2v2h2v-2zm-4-8h-2v2h2v-2z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Booking Code -->
                    <div class="bg-white rounded-lg p-4 border border-gray-200 mb-4">
                        <div class="text-3xl font-mono font-bold text-blue-600 tracking-wider">
                            {{ $booking->id }}-{{ strtoupper(substr(md5($booking->id . $booking->booking_date), 0, 6)) }}
                        </div>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mt-3">Tunjukkan kode ini saat check-in</p>
            </div>

            <div class="detail-row">
                <span class="detail-label">📅 Tanggal : </span>
                <span class="detail-value">{{ \Carbon\Carbon::parse($booking->booking_date)->locale('id')->translatedFormat('l, d F Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">🕐 Jam : </span>
                <span class="detail-value">{{ $booking->booking_time }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">👤 Nama : </span>
                <span class="detail-value">{{ $booking->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">📱 Telepon : </span>
                <span class="detail-value">{{ $booking->phone }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">📧 Email : </span>
                <span class="detail-value">{{ $booking->email }}</span>
            </div>
        </div>

        <div class="highlight">
            <strong>⏱️ Durasi Konsultasi : </strong> {{ config('booking.slot_duration', 30) }} menit<br>
            <strong>📍 Lokasi : </strong> Silakan datang 10 menit sebelum jadwal<br>
            <strong>📋 Check-in : </strong> Tunjukkan kode booking ini saat tiba
        </div>

        <p>
            Jika ada perubahan jadwal atau Anda perlu membatalkan booking, 
            silakan hubungi kami sesegera mungkin.
        </p>

        <p>Kami menantikan kedatangan Anda!</p>

        <div class="footer">
            <p>Terima kasih,<br>
            Tim Layanan Kami</p>
            
            <p style="margin-top: 20px; font-size: 12px;">
                Email ini dikirimkan secara otomatis. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>
