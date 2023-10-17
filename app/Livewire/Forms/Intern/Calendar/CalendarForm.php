<?php

namespace App\Livewire\Forms\Intern\Calendar;

use App\Mail\Calendar\CalendarUpdateMail;
use App\Mail\Calendar\CalenderEintragMail;
use App\Models\Intern\Calendar;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Mail;
use Spatie\GoogleCalendar\Event;

class CalendarForm extends Form
{
    public ?Calendar $calendar = null;

    #[Rule('required')]
    public $start = '';

    #[Rule('required')]
    public $end = '';

    #[Rule('required')]
    public $title = '';

    #[Rule('required')]
    public $description = '';

    #[Rule('nullable')]
    public $is_all_day = '';

    #[Rule('nullable')]
    public $color = '';

    #[Rule('nullable')]
    public $event_text_color = '';

    #[Rule('nullable')]
    public $event_color = '';

    #[Rule('nullable')]
    public $event_background_color = '';

    #[Rule('nullable')]
    public $event_border_color = '';

    #[Rule('nullable')]
    public $colorID = '';

    public $beginn = '';

    #[Rule('nullable')]
    public $event_id = '';

    #[Rule('nullable')]
    public $team_id = '';

    public function setCalendar(Calendar $calendar = null)
    {
        $this->calendar = $calendar;
        if ($calendar->is_all_day) {
            $this->start = Carbon::parse($calendar->start)->format('Y-m-d');
            $this->end = Carbon::parse($calendar->end)->format('Y-m-d');
        } else {
            $this->start = Carbon::parse($calendar->start)->format('Y-m-d H:i:s');
            $this->end = Carbon::parse($calendar->end)->format('Y-m-d H:i:s');
        }
        $this->title = $calendar->title;
        $this->description = $calendar->description;
        $this->is_all_day = (bool) $calendar->is_all_day;
        $this->color = $calendar->color;
        $this->event_text_color = $calendar->event_text_color;
        $this->event_color = $calendar->event_color;
        $this->event_background_color = $calendar->event_background_color;
        $this->event_border_color = $calendar->event_border_color;
        $this->colorID = $calendar->colorID;
        $this->event_id = $calendar->event_id;
        $this->team_id = $calendar->team_id;
    }

    public function save()
    {
        $this->team_id = auth()->user()->teamID();
        $this->validate();
        if ($this->calendar) {
            if ($this->is_all_day) {
                $start = Carbon::parse($this->validate()['start'])->format('Y-m-d');
                $end = Carbon::parse($this->validate()['end'])->format('Y-m-d');
            } else {
                $start = Carbon::parse($this->validate()['start'])->format('Y-m-d H:i:s');
                $end = Carbon::parse($this->validate()['end'])->format('Y-m-d H:i:s');
            }
            $event = Event::find($this->event_id);
            $event->name = $this->title;
            $event->startDateTime = Carbon::parse($start);
            $event->endDateTime = Carbon::parse($end);
            $event->description = $this->description;
            $event->setColorId($this->colorID);

            $newEvent = $event->save();
            $this->event_id = $newEvent->id;
            $this->calendar->update($this->validate());

            toastr()->success('Kalendereintrag wurde angepasst.', ' ');
            Mail::to($this->calendar->team->email)->cc(env('TTF_EMAIL'))->send(new CalendarUpdateMail($this->calendar));

            return redirect(route('intern.calendar.index'));
        } else {
            if ($this->is_all_day) {
                $start = Carbon::parse($this->validate()['start'])->format('Y-m-d');
                $end = Carbon::parse($this->validate()['end'])->addDay()->format('Y-m-d');
            } else {
                $start = Carbon::parse($this->validate()['start'])->format('Y-m-d H:i:s');
                $end = Carbon::parse($this->validate()['end'])->format('Y-m-d H:i:s');
            }
            $event = new Event;
            $event->name = $this->title;
            $event->startDateTime = Carbon::parse($start);
            $event->endDateTime = Carbon::parse($end);
            $event->description = $this->description;
            $event->setColorId($this->colorID);

            $newEvent = $event->save();
            $this->event_id = $newEvent->id;
            $kalender = Calendar::create($this->validate());

            toastr()->success('Kalendereintrag wurde erfolgreich angelegt.', ' ');
            Mail::to(env('TTF_EMAIL'))->send(new CalenderEintragMail($kalender));

            return redirect(route('intern.calendar.index'));
        }
    }
}
