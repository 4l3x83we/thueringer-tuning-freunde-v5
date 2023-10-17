<?php

namespace App\Livewire\Intern\Calendar;

use Livewire\Component;

class CalendarShow extends Component
{
    public function render()
    {
        metaTags('Hier kannst du alle Termine sehen.', 'images/logo.svg', 'Kalender', 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.calendar.calendar-show');
    }
}
