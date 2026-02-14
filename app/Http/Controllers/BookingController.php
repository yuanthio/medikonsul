<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Mail\BookingConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    // Generate time slots berdasarkan konfigurasi
    private function generateTimeSlots(): array
    {
        $slots = [];
        $openingTime = Config::get('booking.opening_time', '09:00');
        $closingTime = Config::get('booking.closing_time', '17:00');
        $slotDuration = Config::get('booking.slot_duration', 30);
        
        // Debug log
        \Log::info("Config - Opening: {$openingTime}, Closing: {$closingTime}, Duration: {$slotDuration}");
        
        $start = strtotime($openingTime);
        $end   = strtotime($closingTime);
        
        // Debug log
        \Log::info("Timestamp - Start: {$start}, End: {$end}");
        \Log::info("Time diff in minutes: " . (($end - $start) / 60));

        $counter = 0;
        while ($start < $end) {
            $timeSlot = date('H:i', $start);
            
            // Cek apakah slot ini valid (tidak melewati jam berakhir)
            $slotEnd = strtotime('+' . $slotDuration . ' minutes', $start);
            if ($slotEnd > $end) {
                \Log::info("Slot {$timeSlot} would exceed closing time (ends at " . date('H:i', $slotEnd) . "). Skipping.");
                break;
            }
            
            $slots[] = $timeSlot;
            \Log::info("Slot " . (++$counter) . ": {$timeSlot} (ends at " . date('H:i', $slotEnd) . ")");
            
            $start = $slotEnd;
        }

        \Log::info("Final slots count: " . count($slots));
        return $slots;
    }

    public function index()
    {
        return view('booking.index');
    }

    // 🕒 Generate slots berdasarkan konfigurasi dari admin settings
    public function slots(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $allSlots = $this->generateTimeSlots();
        
        // Debug: Log untuk melihat hasil generateTimeSlots
        \Log::info('Generated slots: ' . json_encode($allSlots));
        \Log::info('Total slots count: ' . count($allSlots));
        
        $bookedSlots = Booking::where('booking_date', $request->date)
            ->pluck('booking_time')
            ->map(fn ($t) => substr($t, 0, 5))
            ->toArray();

        // Get current time for frontend validation
        $currentTime = now()->format('H:i');
        $today = now()->format('Y-m-d');

        return response()->json([
            'slots' => $allSlots,
            'booked' => $bookedSlots,
            'current_time' => $currentTime,
            'today' => $today
        ]);
    }

    // 📝 US-02: booking 30 menit
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required'
        ]);

        try {
            $booking = Booking::create($validated);
            
            // Kirim email konfirmasi
            Mail::to($booking->email)->send(new BookingConfirmationMail($booking));
            
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'booking_time' => 'Slot sudah dibooking'
            ]);
        }

        return redirect()->route('booking.success', ['booking' => $booking->id])->with(
            'success',
            'Booking berhasil! Durasi konsultasi 30 menit.'
        );
    }

    public function success(Booking $booking)
    {
        return view('booking.success', compact('booking'));
    }

    // Proses pengecekan booking
    public function check(Request $request)
    {
        $validated = $request->validate([
            'booking_code' => 'required|string',
            'email' => 'required|email'
        ]);

        // Parse booking code untuk mendapatkan ID
        $parts = explode('-', $validated['booking_code']);
        if (count($parts) !== 2) {
            return back()->withErrors([
                'booking_code' => 'Format kode booking tidak valid. Gunakan format: ID-KODE (contoh: 123-ABCDEF)'
            ])->withInput();
        }

        $bookingId = $parts[0];
        $hash = strtoupper($parts[1]);

        // Cari booking berdasarkan ID dan email
        $booking = Booking::where('id', $bookingId)
            ->where('email', $validated['email'])
            ->first();

        if (!$booking) {
            return back()->withErrors([
                'booking_code' => 'Kode booking atau email tidak ditemukan'
            ])->withInput();
        }

        // Verifikasi hash
        $expectedHash = strtoupper(substr(md5($booking->id . $booking->booking_date), 0, 6));
        if ($hash !== $expectedHash) {
            return back()->withErrors([
                'booking_code' => 'Kode booking tidak valid'
            ])->withInput();
        }

        return redirect()->route('booking.result', $booking);
    }

    // Tampilkan hasil pencarian booking
    public function result(Booking $booking)
    {
        return view('booking.result', compact('booking'));
    }
}
