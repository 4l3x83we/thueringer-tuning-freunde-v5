<?php

namespace App\Mail\Antrag;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AntragGenehmigtClubMail extends Mailable
{
    use Queueable, SerializesModels;

    public $team;

    public function __construct($team)
    {
        $this->team = $team;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Mitgliedsantrag von '.$this->team['vorname'].' wurde genehmigt.');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.antrag.antrag-genehmigt-club');
    }

    public function attachments(): array
    {
        return [];
    }
}
