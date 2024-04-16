<?php

namespace App\Livewire\Frontend;

use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.frontend.ueber-uns');
    }
}
