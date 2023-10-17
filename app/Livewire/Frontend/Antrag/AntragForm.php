<?php

namespace App\Livewire\Frontend\Antrag;

use Livewire\Attributes\Rule;
use Livewire\Form;

class AntragForm extends Form
{
    #[Rule('required', as: 'Anrede')]
    public $anrede = '';

    #[Rule('required', as: 'Vorname')]
    public $vorname = '';

    #[Rule('required', as: 'Nachname')]
    public $nachname = '';

    #[Rule('required', as: 'Straße')]
    public $strasse = '';

    #[Rule('required', as: 'PLZ')]
    public $plz = '';

    #[Rule('required', as: 'Wohnort')]
    public $wohnort = '';

    #[Rule('nullable', as: 'Telefon')]
    public $telefon = '';

    #[Rule('required', as: 'Mobilfunk')]
    public $mobilfunk = '';

    #[Rule('required|email', as: 'E-Mail Adresse')]
    public $email = '';

    #[Rule('nullable', as: 'Facebook')]
    public $facebook = '';

    #[Rule('nullable', as: 'TikTok')]
    public $tiktok = '';

    #[Rule('nullable', as: 'Instagram')]
    public $instagram = '';

    #[Rule('required', as: 'Geburtstag')]
    public $geburtsdatum = '';

    #[Rule('nullable', as: 'Beruf')]
    public $beruf = '';

    #[Rule('required|min:250', as: 'Beschreibung')]
    public $description = '';
}
