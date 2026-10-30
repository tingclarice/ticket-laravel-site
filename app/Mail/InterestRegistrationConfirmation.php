<?php

namespace App\Mail;

use App\Models\InterestRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterestRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public InterestRegistration $registration) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Laufey Live interest is on the list',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.interest-registration',
            text: 'emails.interest-registration-text',
        );
    }
}
