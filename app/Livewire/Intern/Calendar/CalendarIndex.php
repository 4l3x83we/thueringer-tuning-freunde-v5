<?php

namespace App\Livewire\Intern\Calendar;

use App\Mail\Calendar\CalendarUpdateMail;
use App\Models\Intern\Calendar;
use Carbon\Carbon;
use Livewire\Component;
use Mail;
use Spatie\GoogleCalendar\Event;

class CalendarIndex extends Component
{
    public $events = '';

    public $google;

    public $eventsAktuell;

    public $eventsAktuellToday;

    public function getevent()
    {
        $events = Calendar::select('id', 'title', 'description', 'start', 'end')->get();
        $this->events = json_encode($events);
    }

    public function eventDrop($event, $oldEvent)
    {
        $this->extracted($oldEvent['allDay'], $event);
    }

    public function extracted($allDay, $event): void
    {
        if ($allDay) {
            $start = Carbon::parse($event['start'])->format('Y-m-d');
            $end = Carbon::parse($event['end'])->format('Y-m-d');
        } else {
            $start = Carbon::parse($event['start'])->format('Y-m-d H:i:s');
            $end = Carbon::parse($event['end'])->format('Y-m-d H:i:s');
        }

        $googleEvent = Event::find($event['extendedProps']['event_id']);
        $googleEvent->startDateTime = Carbon::parse($start);
        $googleEvent->endDateTime = Carbon::parse($end);
        $googleEvent->save();

        $eventData = Calendar::findOrFail($event['id']);
        $eventData->team_id = auth()->user()->teamID();
        $eventData->start = $start;
        $eventData->end = $end;

        $eventData->save();

        Mail::to($eventData->team->email)->cc(env('TTF_EMAIL'))->send(new CalendarUpdateMail($eventData));

    }

    public function eventResize($event, $oldEvent)
    {
        $this->extracted($oldEvent['allDay'], $event);
    }

    public function addevent($event)
    {
        return redirect(route('intern.calendar.create', $event));
    }

    public function eventClick($event)
    {
        return redirect(route('intern.calendar.edit', $event['id']));
    }

    public function render()
    {
        $eventQuery = Calendar::query();
        $events = $eventQuery->get();
        $data = [];
        foreach ($events as $event) {
            if (! (int) $event['is_all_day']) {
                $event['allDay'] = false;
                $event['start'] = Carbon::createFromTimestamp(strtotime($event['start']))->toDateTimeString();
                $event['end'] = Carbon::createFromTimestamp(strtotime($event['end']))->toDateTimeString();
                $event['endDay'] = $event['end'];
                $event['startDay'] = $event['start'];
            } else {
                $event['allDay'] = true;
                $event['start'] = Carbon::parse($event['start'])->format('Y-m-d');
                $event['end'] = Carbon::parse($event['end'])->format('Y-m-d');
            }
            $event['color'] = $event['event_color'];
            $event['backgroundColor'] = $event['event_background_color'];
            $event['borderColor'] = $event['event_border_color'];
            $event['textColor'] = $event['event_text_color'];
            $data[] = $event;
            $this->eventsAktuellToday = $event;
        }
        //        dd($data);
        $this->events = json_encode($data);
        $this->eventsAktuell = $data;

        metaTags('Hier kannst du alle Termine sehen.', 'images/logo.svg', 'Kalender', 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.calendar.calendar-index');
    }
}
