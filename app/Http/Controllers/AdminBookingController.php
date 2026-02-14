<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Mail\BookingConfirmationMail;
use App\Mail\BookingUpdatedMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;

class AdminBookingController extends Controller
{
    // Generate time slots berdasarkan konfigurasi
    private function generateTimeSlots(): array
    {
        $slots = [];
        $openingTime = Config::get('booking.opening_time', '09:00');
        $closingTime = Config::get('booking.closing_time', '17:00');
        $slotDuration = Config::get('booking.slot_duration', 30);
        
        $start = strtotime($openingTime);
        $end   = strtotime($closingTime);

        while ($start < $end) {
            $timeSlot = date('H:i', $start);
            
            // Cek apakah slot ini valid (tidak melewati jam berakhir)
            $slotEnd = strtotime('+' . $slotDuration . ' minutes', $start);
            if ($slotEnd > $end) {
                break;
            }
            
            $slots[] = $timeSlot;
            $start = $slotEnd;
        }

        return $slots;
    }

    public function dashboard(Request $request)
    {
        $date = $request->get('date', Carbon::today()->toDateString());

        $bookings = Booking::where('booking_date', $date)
            ->orderBy('booking_time')
            ->get();

        return view('admin.dashboard', [
            'bookings' => $bookings,
            'selectedDate' => $date,
            'today' => Carbon::today()->toDateString()
        ]);
    }

    public function create(Request $request)
    {
        $date = $request->get('date', Carbon::today()->toDateString());
        $allSlots = $this->generateTimeSlots();
        
        $bookedSlots = Booking::where('booking_date', $date)
            ->pluck('booking_time')
            ->map(fn ($t) => substr($t, 0, 5))
            ->toArray();

        $currentTime = Carbon::now()->format('H:i');
        $isToday = $date === Carbon::today()->toDateString();
        $isPastDate = $date < Carbon::today()->toDateString();

        $slots = [];
        foreach ($allSlots as $slot) {
            $isBooked = in_array($slot, $bookedSlots);
            
            // If date is in the past, all slots are past
            if ($isPastDate) {
                $isPast = true;
            } else {
                // If date is today, check if slot time is past
                $isPast = $isToday && $slot < $currentTime;
            }
            
            $slots[] = [
                'time' => $slot,
                'status' => $isBooked ? 'booked' : ($isPast ? 'past' : 'available'),
                'disabled' => $isBooked || $isPast
            ];
        }

        return response()->json([
            'slots' => $slots,
            'selected_date' => $date
        ]);
    }

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
            
            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat!',
                'booking' => $booking
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Slot sudah dibooking atau terjadi kesalahan.'
            ], 422);
        }
    }

    public function edit($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan.'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required'
        ]);

        try {
            $booking = Booking::findOrFail($id);
            
            // Store old data for comparison
            $oldData = [
                'name' => $booking->name,
                'phone' => $booking->phone,
                'email' => $booking->email,
                'booking_date' => $booking->booking_date,
                'booking_time' => $booking->booking_time,
            ];
            
            // Check if the new slot is available (excluding current booking)
            $existingBooking = Booking::where('booking_date', $validated['booking_date'])
                ->where('booking_time', $validated['booking_time'])
                ->where('id', '!=', $id)
                ->first();
                
            if ($existingBooking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Slot waktu sudah dibooking oleh pasien lain.'
                ], 422);
            }
            
            $booking->update($validated);
            
            // Send email notification about the update
            Mail::to($booking->email)->send(new BookingUpdatedMail($booking, $oldData));
            
            return response()->json([
                'success' => true,
                'message' => 'Data booking berhasil diperbarui! Notifikasi telah dikirim ke email pasien.',
                'booking' => $booking
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui booking.'
            ], 500);
        }
    }

    public function cancel($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibatalkan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membatalkan booking.'
            ], 500);
        }
    }
}