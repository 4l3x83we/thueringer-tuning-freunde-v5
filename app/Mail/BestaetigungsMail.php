<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BestaetigungsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;

    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->mail['subject']);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.bestaetigungs');
    }

    public function attachments(): array
    {
        return [];
    }
}
