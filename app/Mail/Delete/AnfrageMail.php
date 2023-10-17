<?php

namespace App\Mail\Delete;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AnfrageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $team;

    public function __construct($team)
    {
        $this->team = $team;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->team['email'], $this->team['vorname'].' '.$this->team['nachname']),
            subject: 'Austrittsanfrage von: '.$this->team['vorname'].' '.$this->team['nachname']
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.delete.anfrage');
    }

    public function attachments(): array
    {
        return [];
    }
}
