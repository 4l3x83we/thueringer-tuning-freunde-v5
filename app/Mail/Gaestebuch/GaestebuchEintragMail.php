<?php

namespace App\Mail\Gaestebuch;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GaestebuchEintragMail extends Mailable
{
    use Queueable, SerializesModels;

    public $gaestebuch;

    public function __construct($gaestebuch)
    {
        $this->gaestebuch = $gaestebuch;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Neuer Gästebucheintrag ist eingegangen!');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.gaestebuch.gaestebuch-eintrag');
    }

    public function attachments(): array
    {
        return [];
    }
}
