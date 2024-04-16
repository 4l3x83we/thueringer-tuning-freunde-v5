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
            'team' => (new Team)->where('funktion', '!=', 'Werkstattmieter')->where('teams.published', true)->count(),
            'fahrzeuge' => (new Fahrzeuge)->where('published', true)->count(),
            'treffen' => (new Veranstaltungen)->where('datum_von', '>=', Carbon::parse(now())->format('Y-m-d H:i:s'))->where('anwesend', true)->count(),
            'projekte' => (new Album)->where('kategorie', 'Projekte')->count(),
        ];
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.frontend.ueber-uns');
    }
}
