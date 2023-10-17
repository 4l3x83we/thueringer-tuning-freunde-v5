<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailInactiveUsersMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $team;

    public function __construct($user, $team)
    {
        $this->user = $user;
        $this->team = $team;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Du warst lange nicht mehr auf Thüringer Tuning Freunde!');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.email-inactive-users');
    }

    public function attachments(): array
    {
        return [];
    }
}
