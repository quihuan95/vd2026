<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Registration $registration) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác nhận đăng ký tham dự — '.$this->registration->delegate_id,
            cc: $this->copyAddresses(),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.registration-confirmed',
        );
    }

    /**
     * @return list<string>
     */
    private function copyAddresses(): array
    {
        return array_values(array_filter(array_map(
            'trim',
            explode(',', (string) config('mail.always_cc'))
        )));
    }
}
