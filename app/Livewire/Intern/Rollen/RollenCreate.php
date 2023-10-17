<?php

namespace App\Livewire\Intern\Rollen;

use Livewire\Component;

class RollenCreate extends Component
{
    public function render()
    {
        metaTags('Hier kannst du neue Rollen anlegen.', 'images/logo.svg', 'Rolle erstellen', 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.rollen.rollen-create');
    }
}
