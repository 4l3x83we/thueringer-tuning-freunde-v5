<?php

namespace App\Livewire\Frontend\Veranstaltungen;

use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use App\Models\Intern\Calendar;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Emoji\Emoji;
use Spatie\GoogleCalendar\Event;
use Yoeunes\Toastr\Facades\Toastr;

class Index extends Component
{
    use WithPagination;

    public function anwesend(Veranstaltungen $veranstaltungen, int $status)
    {
        $veranstaltungen->update(['anwesend' => $status]);
        if ($veranstaltungen->anwesend) {
            Toastr::info('Ihr habt wirklich vor dahin zu fahren '.Emoji::rollingOnTheFloorLaughing(), ' ');
            $event = new Event;
            $event->name = $veranstaltungen->veranstaltung;
            $event->startDateTime = Carbon::parse($veranstaltungen->datum_von);
            $event->endDateTime = Carbon::parse($veranstaltungen->datum_bis);
            $event->description = $veranstaltungen->description;
            $event->setColorId(3);

            $newEvent = $event->save();
            $event_id = $newEvent->id;
            $calendar = Calendar::create([
                'start' => $veranstaltungen->datum_von,
                'end' => $veranstaltungen->datum_bis,
                'title' => $veranstaltungen->veranstaltung,
                'description' => $veranstaltungen->description,
                'color' => 'Veranstaltung',
                'event_id' => $event_id,
            ]);
            $veranstaltungen->update(['calendar_id' => $calendar->id]);
        } else {
            if ($veranstaltungen->calendar_id) {
                $calendar = Calendar::where('id', $veranstaltungen->calendar_id)->first();
                $event = Event::find($calendar->event_id);
                $event->delete();
                $calendar->delete();
                $veranstaltungen->update(['calendar_id' => null]);
            }
            Toastr::error('Schade das ihr nun doch absagt '.Emoji::loudlyCryingFace(), ' ');
        }

        return redirect(route('frontend.veranstaltungen.index'));
    }

    public function download()
    {
        $veranstaltungen = Veranstaltungen::where('datum_bis', '>=', Carbon::now()->addMinutes(30))->orderBy('datum_von')->get();
        $pdf = PDF::loadView('frontend.veranstaltungen.pdf', ['veranstaltungen' => $veranstaltungen])->setOption('isPhpEnabled', true)->setPaper('A4');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'veranstaltungen.pdf');
    }

    public function render()
    {
        metaTags('Hier kannst du Tuning Treffen sehen.', 'images/logo.svg', 'Veranstaltungen', 'INDEX,FOLLOW');
        $veranstaltungen = Veranstaltungen::where('datum_bis', '>=', Carbon::now()->addMinutes(30))->select('id', 'anwesend', 'datum_von', 'datum_bis', 'veranstaltung', 'veranstalter', 'eintritt', 'slug', 'veranstaltungsort', 'quelle')->orderBy('datum_von')->paginate(10);

        return view('livewire.frontend.veranstaltungen.index', ['veranstaltungen' => $veranstaltungen]);
    }
}
