<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perubahan Booking</title>
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
            background: #f59e0b;
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
        .changes-section {
            background: #fef2f2;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ef4444;
        }
        .changes-title {
            font-weight: bold;
            color: #dc2626;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .change-item {
            margin: 10px 0;
            padding: 10px;
            background: white;
            border-radius: 6px;
            border-left: 3px solid #ef4444;
        }
        .old-value {
            color: #dc2626;
            text-decoration: line-through;
            font-size: 14px;
        }
        .new-value {
            color: #059669;
            font-weight: bold;
        }
        .no-changes {
            background: #f0fdf4;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #22c55e;
            margin: 20px 0;
            text-align: center;
            color: #16a34a;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔄 Booking Diperbarui</h1>
        <p>Data booking Anda telah diubah oleh admin</p>
    </div>

    <div class="content">
        <p>Halo <strong>{{ $booking->name }}</strong>,</p>
        
        <p>Kami ingin menginformasikan bahwa data booking Anda telah diperbarui. Berikut adalah detail booking terbaru Anda:</p>

        <div class="booking-details">
            <div class="text-center mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">📋 Kode Booking Anda</h3>
                <div class="bg-blue-50 rounded-lg p-4 border-2 border-dashed border-blue-300">
                    <div class="text-2xl font-mono font-bold text-blue-600">
                        {{ $booking->id }}-{{ strtoupper(substr(md5($booking->id . $booking->booking_date), 0, 6)) }}
                    </div>
                </div>
                <p class="text-sm text-gray-600 mt-2">Simpan kode booking ini untuk check-in</p>
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

        @if($hasChanges)
        <div class="changes-section">
            <div class="changes-title">📝 Detail Perubahan:</div>
            
            @if($oldData['name'] !== $booking->name)
            <div class="change-item">
                <strong>Nama:</strong><br>
                <span class="old-value">{{ $oldData['name'] }}</span><br>
                <span class="new-value">{{ $booking->name }}</span>
            </div>
            @endif
            
            @if($oldData['phone'] !== $booking->phone)
            <div class="change-item">
                <strong>Telepon:</strong><br>
                <span class="old-value">{{ $oldData['phone'] }}</span><br>
                <span class="new-value">{{ $booking->phone }}</span>
            </div>
            @endif
            
            @if($oldData['email'] !== $booking->email)
            <div class="change-item">
                <strong>Email:</strong><br>
                <span class="old-value">{{ $oldData['email'] }}</span><br>
                <span class="new-value">{{ $booking->email }}</span>
            </div>
            @endif
            
            @if($oldData['booking_date'] !== $booking->booking_date)
            <div class="change-item">
                <strong>Tanggal:</strong><br>
                <span class="old-value">{{ \Carbon\Carbon::parse($oldData['booking_date'])->locale('id')->translatedFormat('l, d F Y') }}</span><br>
                <span class="new-value">{{ \Carbon\Carbon::parse($booking->booking_date)->locale('id')->translatedFormat('l, d F Y') }}</span>
            </div>
            @endif
            
            @if($oldData['booking_time'] !== $booking->booking_time)
            <div class="change-item">
                <strong>Jam:</strong><br>
                <span class="old-value">{{ $oldData['booking_time'] }}</span><br>
                <span class="new-value">{{ $booking->booking_time }}</span>
            </div>
            @endif
        </div>
        @else
        <div class="no-changes">
            <strong>✅ Tidak ada perubahan data</strong><br>
            <small>Data booking Anda tetap sama</small>
        </div>
        @endif

        <div class="highlight">
            <strong>⏱️ Durasi Konsultasi : </strong> {{ config('booking.slot_duration', 30) }} menit<br>
            <strong>📍 Lokasi : </strong> Silakan datang 10 menit sebelum jadwal<br>
            <strong>📋 Check-in : </strong> Tunjukkan kode booking ini saat tiba
        </div>

        <p>
            Jika Anda memiliki pertanyaan tentang perubahan ini, 
            silakan hubungi kami sesegera mungkin.
        </p>

        <p>Kami menantikan kedatangan Anda sesuai jadwal terbaru!</p>

        <div class="footer">
            <p>Terima kasih,<br>
            Tim Layanan Kami</p>
            
            <p style="margin-top: 20px; font-size: 12px;">
                Email ini dikirimkan secara otomatis pada {{ now()->locale('id')->translatedFormat('l, d F Y H:i') }}. Mohon tidak membalas email ini.
            </p>
        </div>
    </div>
</body>
</html>
