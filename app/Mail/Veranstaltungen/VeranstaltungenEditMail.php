<?php

namespace App\Mail\Veranstaltungen;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VeranstaltungenEditMail extends Mailable
{
    use Queueable, SerializesModels;

    public $veranstaltungen;

    public function __construct($veranstaltungen)
    {
        $this->veranstaltungen = $veranstaltungen;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Veranstaltung wurde bearbeitet! ('.$this->veranstaltungen['veranstaltung'].')');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.veranstaltungen.veranstaltungen-edit');
    }

    public function attachments(): array
    {
        return [];
    }
}
