<?php

namespace App\Livewire\Intern\Mitglieder;

use App\Models\Frontend\Team\Team;
use Livewire\Component;

class Index extends Component
{
    public $teams;

    public $alben;

    public function mount()
    {
        $this->teams = Team::with('users')->get();
    }

    public function show($slug)
    {
        return redirect(route('intern.mitglieder.show', $slug));
    }

    public function render()
    {
        metaTags('Hier kannst du alle Mitglieder sehen.', 'images/logo.svg', 'Mitglieder', 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.mitglieder.index');
    }
}
