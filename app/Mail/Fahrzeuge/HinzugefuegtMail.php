<?php

namespace App\Mail\Fahrzeuge;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HinzugefuegtMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fahrzeuge;

    public function __construct($fahrzeuge)
    {
        $this->fahrzeuge = $fahrzeuge;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Neues Fahrzeug wurde angelegt von '.auth()->user()->fullname());
    }

    public function content(): Content
    {
        return new Content(view: 'emails.fahrzeuge.hinzugefuegt');
    }

    public function attachments(): array
    {
        return [];
    }
}
