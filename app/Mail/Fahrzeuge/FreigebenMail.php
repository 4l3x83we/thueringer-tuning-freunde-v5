<?php

namespace App\Mail\Fahrzeuge;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FreigebenMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Freigeben');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.fahrzeuge.freigeben');
    }

    public function attachments(): array
    {
        return [];
    }
}
