<?php

namespace App\Livewire\Frontend\Team;

use App\Models\Frontend\Team\Team;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        metaTags('Hier siehst du eine Übersicht über unsere aktuellen Mitglieder.', 'images/logo.svg', 'Team', 'INDEX,FOLLOW');
        $teams = Team::where('published', true)->orderBy('slug', 'ASC')->paginate(21);

        return view('livewire.frontend.team.index', [
            'teams' => $teams,
        ]);
    }
}
