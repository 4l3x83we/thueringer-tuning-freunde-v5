<?php

namespace App\Livewire\Forms\Frontend\Team;

use App\Mail\BestaetigungsMail;
use App\Models\Frontend\Team\Team;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class TeamForm extends Form
{
    public ?Team $team = null;

    #[Rule('required', as: 'Anrede')]
    public $anrede = '';

    #[Rule('required|max:255', as: 'Vorname')]
    public $vorname = '';

    #[Rule('required|max:255', as: 'Nachname')]
    public $nachname = '';

    #[Rule('required|max:255', as: 'Straße')]
    public $strasse = '';

    #[Rule('required|max:5', as: 'PLZ')]
    public $plz = '';

    #[Rule('required|max:255', as: 'Wohnort')]
    public $wohnort = '';

    #[Rule('nullable|max:15', as: 'Telefon')]
    public $telefon = '';

    #[Rule('required|max:15', as: 'Mobilfunk')]
    public $mobil = '';

    #[Rule('required|max:255|email', as: 'E-Mail Adresse')]
    public $email = '';

    #[Rule('required|max:255', as: 'Geburtstag')]
    public $geburtstag = '';

    #[Rule('nullable|max:255', as: 'Beruf')]
    public $beruf = '';

    #[Rule('required|max:4294967295|min:200', as: 'Description')]
    public $description = '';

    #[Rule('nullable|max:255', as: 'Facebook')]
    public $facebook = '';

    #[Rule('nullable|max:255', as: 'TikTok')]
    public $tiktok = '';

    #[Rule('nullable|max:255', as: 'Instagram')]
    public $instagram = '';

    #[Rule('nullable|max:255', as: 'Funktion')]
    public $funktion = '';

    #[Rule('nullable|max:255', as: 'IP Adresse')]
    public $ip_adresse = '';

    #[Rule('bool', as: 'Fahrzeugvorhanden')]
    public $fahrzeug_vorhanden = '';

    #[Rule('nullable|max:255', as: 'Path')]
    public $path = '';

    #[Rule('bool', as: 'Veröffentlicht')]
    public $published = '';

    #[Rule('nullable|max:255', as: 'Veröffentlicht am')]
    public $published_at = '';

    public function setTeam(Team $team = null): void
    {
        $this->team = $team;
        $this->anrede = $team->anrede;
        $this->vorname = $team->vorname;
        $this->nachname = $team->nachname;
        $this->strasse = $team->strasse;
        $this->plz = $team->plz;
        $this->wohnort = $team->wohnort;
        $this->telefon = $team->telefon;
        $this->mobil = $team->mobil;
        $this->email = $team->email;
        $this->geburtstag = Carbon::parse($team->geburtsdatum)->format('Y-m-d');
        $this->beruf = $team->beruf;
        $this->description = $team->description;
        $this->tiktok = $team->tiktok;
        $this->instagram = $team->instagram;
        $this->facebook = $team->facebook;
        $this->funktion = $team->funktion;
        $this->ip_adresse = $team->ip_adresse;
        $this->fahrzeug_vorhanden = $team->fahrzeug_vorhanden;
        $this->path = $team->path;
        $this->published = $team->published;
        $this->published_at = $team->published_at;
    }

    public function save()
    {
        $this->validate();
        $this->team->update($this->only(['anrede', 'vorname', 'nachname', 'strasse', 'plz', 'wohnort', 'telefon', 'mobil', 'email', 'geburtstag', 'beruf', 'description', 'tiktok', 'instagram', 'facebook']));
        $this->team->update(['ip_adresse' => request()->getClientIp()]);
        Toastr::success('Dein Profil wurde angepasst.', ' ');
        if ($this->team->funktion !== 'Werkstattmieter') {
            foreach (Team::all() as $team) {
                sleep(1);
                $mail = [
                    'subject' => 'Das Profil von '.$this->team->vorname.' wurde geändert.',
                    'name' => $team->vorname,
                    'description' => '<p>'.ucfirst(auth()->user()->teams->slug).' hat gerade sein Profil geändert.</p>',
                ];
                if ($team->funktion !== 'Werkstattmieter') {
                    Mail::to($team->email)->send(new BestaetigungsMail($mail));
                }
            }
        }

        return redirect()->route('frontend.team.show', $this->team->slug);
    }
}
