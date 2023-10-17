<?php

namespace App\Livewire\Frontend\Antrag;

use App\Models\Frontend\Team\Team;
use Livewire\Component;
use Livewire\WithPagination;

class Annahme extends Component
{
    use WithPagination;

    public function antrag($id)
    {
        return redirect(route('intern.annahme.show', $id));
    }

    public function render()
    {
        metaTags('Hier kannst du die eingegangenen Anträge ansehen und freigeben.', 'images/logo.svg', 'Mitgliedsantragsübersicht', 'NOINDEX,NOFOLLOW');

        $teams = Team::orderBy('id', 'DESC')->paginate(21);

        return view('livewire.frontend.antrag.annahme', [
            'teams' => $teams,
        ]);
    }
}
