<?php

namespace App\Mail\Antrag;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AntragEingangAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Neuer Mitgliedsantrag ist eingegangen.');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.antrag.antrag-eingang-admin');
    }

    public function attachments(): array
    {
        return [];
    }
}
