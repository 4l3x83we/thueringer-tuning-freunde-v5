<?php

namespace App\Mail\Calendar;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CalenderEintragMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kalender;

    public function __construct($kalender)
    {
        $this->kalender = $kalender;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Neuer Kalendereintrag von '.$this->kalender->team->fullname());
    }

    public function content(): Content
    {
        return new Content(view: 'emails.calendar.calender-eintrag');
    }

    public function attachments(): array
    {
        return [];
    }
}
