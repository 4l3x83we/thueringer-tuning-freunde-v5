<?php

namespace App\Livewire\Frontend;

use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Carbon\Carbon;
use Livewire\Component;

class UeberUns extends Component
{
    public $count;

    public function mount()
    {
        $this->count = [
            //'team' => Team::where('published', true)->count(),
            'team' => Team::where('funktion', '!=', 'Werkstattmieter')->wherePublished('true')->count(),
            'fahrzeuge' => Fahrzeuge::where('published', true)->count(),
            'treffen' => Veranstaltungen::where('datum_von', '>=', Carbon::parse(now())->format('Y-m-d H:i:s'))->where('anwesend', true)->count(),
            'projekte' => Album::where('kategorie', 'Projekte')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.frontend.ueber-uns');
    }
}
