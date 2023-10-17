<?php

namespace App\Livewire\Frontend\Veranstaltungen;

use App\Livewire\Forms\Frontend\Veranstaltungen\VeranstaltungenForm;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Livewire\Component;

class Edit extends Component
{
    public ?Veranstaltungen $veranstaltungen = null;

    public VeranstaltungenForm $form;

    public function mount(Veranstaltungen $veranstaltungen = null)
    {
        if ($veranstaltungen->exists) {
            $this->form->setVeranstaltungen($veranstaltungen);
        }
    }

    public function save()
    {
        $this->form->save();
    }

    public function render()
    {
        metaTags('Hier kannst du deine Veranstaltungen bearbeiten.', 'images/logo.svg', 'Veranstaltung bearbeiten', 'NOINDEX,NOFOLLOW');

        return view('livewire.frontend.veranstaltungen.edit');
    }
}
