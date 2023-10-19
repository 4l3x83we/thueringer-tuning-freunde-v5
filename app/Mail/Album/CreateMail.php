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

    public $alben;

    public function __construct($alben)
    {
        $this->alben = $alben;
    }

    public function envelope(): Envelope
    {
        return new Envelope(to: env('TTF_EMAIL'), subject: 'Ein neues Album wurde angelegt und muss Freigegeben werden.');
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
