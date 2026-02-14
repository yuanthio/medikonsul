<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $oldData;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, array $oldData)
    {
        $this->booking = $booking;
        $this->oldData = $oldData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Perubahan Jadwal Booking - ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-updated',
            with: [
                'booking' => $this->booking,
                'oldData' => $this->oldData,
                'hasChanges' => $this->hasChanges(),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Check if there are any changes in the booking data
     */
    private function hasChanges(): bool
    {
        return $this->oldData['name'] !== $this->booking->name ||
               $this->oldData['phone'] !== $this->booking->phone ||
               $this->oldData['email'] !== $this->booking->email ||
               $this->oldData['booking_date'] !== $this->booking->booking_date ||
               $this->oldData['booking_time'] !== $this->booking->booking_time;
    }
}
