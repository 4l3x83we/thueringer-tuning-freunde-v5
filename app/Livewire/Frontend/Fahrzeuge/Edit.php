<?php

namespace App\Livewire\Frontend\Fahrzeuge;

use App\Livewire\Forms\Frontend\Fahrzeuge\FahrzeugeForm;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public ?Fahrzeuge $fahrzeuge = null;

    public FahrzeugeForm $form;

    public function mount(Fahrzeuge $fahrzeuge = null): void
    {
        if ($fahrzeuge->exists) {
            $this->form->setFahrzeug($fahrzeuge);
        }
    }

    public function edit()
    {
        $this->form->save();
    }

    public function render()
    {
        metaTags('Hier kannst du dein Fahrzeug bearbeiten.', 'images/logo.svg', 'Fahrzeuge bearbeiten', 'NOINDEX,NOFOLLOW');

        return view('livewire.frontend.fahrzeuge.edit');
    }
}
