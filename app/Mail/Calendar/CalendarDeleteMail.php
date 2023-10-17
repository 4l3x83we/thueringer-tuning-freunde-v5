<?php

namespace App\Mail\Calendar;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CalendarDeleteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $kalender;

    public function __construct($kalender)
    {
        $this->kalender = $kalender;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Kalendereintrag am: '.Carbon::parse($this->kalender->start)->format('d.m.Y H:i').' wurde gelöscht.');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.calendar.calendar-delete');
    }

    public function attachments(): array
    {
        return [];
    }
}
