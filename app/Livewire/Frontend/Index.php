<?php

namespace App\Livewire\Frontend;

use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $veranstaltungen;

    public $teams;

    public $fahrzeuge;

    public $alben;

    public function mount()
    {
        $this->veranstaltungen = Veranstaltungen::where('datum_bis', '>=', Carbon::now()->addMinutes(30))->select('id', 'anwesend', 'datum_von', 'datum_bis', 'veranstaltung', 'veranstalter', 'eintritt', 'slug', 'veranstaltungsort', 'quelle')->orderBy('datum_von', 'ASC')->limit(6)->get();
        $this->teams = Team::where('funktion', '!=', 'Werkstattmieter')->wherePublished(true)->orderBy('vorname')->get();
        $this->fahrzeuge = Fahrzeuge::wherePublished(true)->orderByDesc('updated_at')->get();
        $this->alben = Album::wherePublished(true)->inRandomOrder()->get();
    }

    public function placeholder()
    {
        return view('layouts.partials.loading');
    }

    public function render()
    {
        return view('livewire.frontend.index');
    }
}
