<?php

namespace App\Livewire\Frontend\Fahrzeuge;

use App\Livewire\Forms\Frontend\Fahrzeuge\FahrzeugeForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public FahrzeugeForm $form;

    public function edit(): void
    {
        $this->form->save();
    }

    public function render()
    {
        metaTags('Hier kannst du ein neues Fahrzeug anlegen.', 'images/logo.svg', 'Fahrzeuge anlegen', 'NOINDEX,NOFOLLOW');

        return view('livewire.frontend.fahrzeuge.create');
    }
}
