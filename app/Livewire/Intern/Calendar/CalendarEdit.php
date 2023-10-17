<?php

namespace App\Livewire\Intern\Calendar;

use App\Livewire\Forms\Intern\Calendar\CalendarForm;
use App\Mail\Calendar\CalendarDeleteMail;
use App\Models\Intern\Calendar;
use Exception;
use Livewire\Component;
use Mail;
use Spatie\GoogleCalendar\Event;

class CalendarEdit extends Component
{
    public ?Calendar $calendar = null;

    public CalendarForm $form;

    public $isAllDay = false;

    public function mount(Calendar $calendar = null)
    {
        if ($calendar->exists) {
            $this->form->setCalendar($calendar);
            $this->isAllDay = $calendar->is_all_day;
        }
    }

    public function save()
    {
        $this->form->save();
    }

    public function destroy(Calendar $calendar)
    {
        Mail::to($calendar->team->email)->cc(env('TTF_EMAIL'))->send(new CalendarDeleteMail($calendar));
        try {
            $event = Event::find($calendar->event_id);
            $event->delete();
            $calendar->delete();
            toastr()->error('Kalendereintrag wurde erfolgreich gelöscht.', ' ');

            return redirect(route('intern.calendar.index'));
        } catch (Exception $exception) {
            return redirect()->back();
        }
    }

    public function render()
    {
        metaTags('Hier kannst du deinen Termin bearbeiten.', 'images/logo.svg', 'Termin bearbeiten', 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.calendar.calendar-edit');
    }
}
