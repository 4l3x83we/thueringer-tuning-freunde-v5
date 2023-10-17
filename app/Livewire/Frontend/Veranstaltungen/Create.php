<?php

namespace App\Livewire\Frontend\Veranstaltungen;

use App\Livewire\Forms\Frontend\Veranstaltungen\VeranstaltungenForm;
use Livewire\Component;

class Create extends Component
{
    public VeranstaltungenForm $form;

    public function save()
    {
        $this->form->save();
    }

    public function render()
    {
        metaTags('Hier kannst du deine Veranstaltungen anlegen.', 'images/logo.svg', 'Veranstaltung erstellen', 'NOINDEX,NOFOLLOW');

        return view('livewire.frontend.veranstaltungen.create');
    }
}
