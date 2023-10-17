<?php

namespace App\Mail\Team;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WriteMeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $writeMe;

    public function __construct($writeMe)
    {
        $this->writeMe = $writeMe;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->writeMe['emailSender'], $this->writeMe['nameSender']),
            subject: $this->writeMe['subject'],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.team.write-me');
    }

    public function attachments(): array
    {
        return [];
    }
}
