<?php

namespace App\Livewire\Intern\Calendar;

use App\Livewire\Forms\Intern\Calendar\CalendarForm;
use Carbon\Carbon;
use Livewire\Component;

class CalendarCreate extends Component
{
    public $isAllDay = false;

    public CalendarForm $form;

    public $beginn;

    public function mount($start)
    {
        $this->form->start = Carbon::parse($start)->format('Y-m-d H:i');
        $this->form->end = Carbon::parse($start)->addHour()->format('Y-m-d H:i');
        $this->form->beginn = $start;
        $this->beginn = $start;
        $this->form->is_all_day = $this->isAllDay;
    }

    public function updatedFormColor($value)
    {
        if ($value === 'Hebebühne') {
            $this->form->event_color = '#FFFFFF';
            $this->form->event_background_color = '#039BE5';
            $this->form->event_border_color = '#0068A9';
            $this->form->event_text_color = '#FFFFFF';
            $this->form->title = 'Hebebühne Reservieren: '.auth()->user()->teams->fullname();
            $this->form->colorID = 7;
            $this->updatedFormIsAllDay(false);
        } elseif ($value === 'Stellplatz') {
            $this->form->event_color = '#FFFFFF';
            $this->form->event_background_color = '#F5511D';
            $this->form->event_border_color = '#BF240F';
            $this->form->event_text_color = '#FFFFFF';
            $this->form->title = 'Stellplatz Reservieren: '.auth()->user()->teams->fullname();
            $this->form->colorID = 6;
            $this->updatedFormIsAllDay(1);
        } elseif ($value === 'Reifen') {
            $this->form->event_color = '#FFFFFF';
            $this->form->event_background_color = '#33B679';
            $this->form->event_border_color = '#0B714A';
            $this->form->event_text_color = '#FFFFFF';
            $this->form->title = 'Reifenservice: '.auth()->user()->teams->fullname();
            $this->form->colorID = 2;
            $this->updatedFormIsAllDay(false);
        } elseif ($value === 'Versammlung') {
            $this->form->event_color = '#FFFFFF';
            $this->form->event_background_color = '#06b6d4';
            $this->form->event_border_color = '#0e7490';
            $this->form->event_text_color = '#FFFFFF';
            $this->form->title = 'Versammlung: ';
            $this->form->colorID = 2;
            $this->updatedFormIsAllDay(false);
        } elseif ($value === 'Andere') {
            $this->form->event_color = '#FFFFFF';
            $this->form->event_background_color = '#616161';
            $this->form->event_border_color = '#434343';
            $this->form->event_text_color = '#FFFFFF';
            $this->form->title = 'Andere: '.auth()->user()->teams->fullname();
            $this->form->colorID = 8;
            $this->updatedFormIsAllDay(false);
        } else {
            $this->form->event_color = '#FFFFFF';
            $this->form->event_background_color = '#FF1F1F';
            $this->form->event_border_color = '#DB0000';
            $this->form->event_text_color = '#FFFFFF';
            $this->form->title = '';
            $this->form->colorID = 11;
            $this->updatedFormIsAllDay(false);
        }
    }

    public function updatedFormIsAllDay($value)
    {
        if ($value) {
            $this->form->start = Carbon::parse($this->beginn)->format('Y-m-d');
            $this->form->end = Carbon::parse($this->beginn)->format('Y-m-d');
            $this->form->is_all_day = true;
            $this->isAllDay = true;
        } else {
            $this->form->start = Carbon::parse($this->beginn)->format('Y-m-d H:i');
            $this->form->end = Carbon::parse($this->beginn)->addHour()->format('Y-m-d H:i');
            $this->form->is_all_day = false;
            $this->isAllDay = false;
        }

        return $this->isAllDay;
    }

    public function save()
    {
        $this->form->save();
    }

    public function render()
    {
        metaTags('Hier kannst du ein Termin anlegen.', 'images/logo.svg', 'Termin anlegen', 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.calendar.calendar-create');
    }
}
