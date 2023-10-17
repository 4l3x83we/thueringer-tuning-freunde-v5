<?php

namespace App\Livewire\Frontend\Antrag;

use Livewire\Attributes\Rule;
use Livewire\Form;

class AntragFahrzeuge extends Form
{
    #[Rule('required', as: 'Fahrzeuge')]
    public $fahrzeug = '';

    #[Rule('required|numeric', as: 'Baujahr')]
    public $baujahr = '';

    #[Rule('nullable', as: 'Besonderheiten')]
    public $besonderheiten = '';

    #[Rule('required', as: 'Motor')]
    public $motor = '';

    #[Rule('nullable', as: 'Karosserie')]
    public $karosserie = '';

    #[Rule('nullable', as: 'Felgen')]
    public $felgen = '';

    #[Rule('nullable', as: 'Fahrwerk')]
    public $fahrwerk = '';

    #[Rule('nullable', as: 'Bremsen')]
    public $bremsen = '';

    #[Rule('nullable', as: 'Innenraum')]
    public $innenraum = '';

    #[Rule('nullable', as: 'Anlage')]
    public $anlage = '';
}
