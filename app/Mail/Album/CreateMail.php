<?php

namespace App\Mail\Album;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $album;

    public function __construct($album)
    {
        $this->album = $album;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Ein neues Album wurde angelegt und muss Freigegeben werden..');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.album.create');
    }

    public function attachments(): array
    {
        return [];
    }
}
