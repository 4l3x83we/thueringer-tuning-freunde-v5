<?php

namespace App\Mail\Kontakt;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KontaktMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function envelope(): Envelope
    {
        return new Envelope(from: $this->email['email'], subject: 'Neue Kontaktanfrage!');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.kontakt.kontakt');
    }

    public function attachments(): array
    {
        return [];
    }
}
