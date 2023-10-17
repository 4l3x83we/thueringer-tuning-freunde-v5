<?php

namespace App\Livewire\Forms\Frontend\Veranstaltungen;

use App\Mail\Veranstaltungen\VeranstaltungenEditMail;
use App\Mail\Veranstaltungen\VeranstaltungenMail;
use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class VeranstaltungenForm extends Form
{
    public ?Veranstaltungen $veranstaltungen = null;

    #[Rule(['required', 'max:16'], as: 'Datum von')]
    public $datum_von = '';

    #[Rule(['required', 'max:16'], as: 'Datum bis')]
    public $datum_bis = '';

    #[Rule(['required', 'max:255'], as: 'Veranstaltung')]
    public $veranstaltung = '';

    #[Rule(['nullable', 'max:255'], as: 'Veranstaltungsort')]
    public $veranstaltungsort = '';

    #[Rule(['nullable', 'max:255'], as: 'Veranstalter')]
    public $veranstalter = '';

    #[Rule(['required', 'min:25', 'max:100000'], as: 'Beschreibung')]
    public $description = '';

    #[Rule(['required', 'max:255'], as: 'Quelleangabe')]
    public $quelle = '';

    #[Rule(['nullable', 'max:255'], as: 'Slug')]
    public $slug = '';

    #[Rule(['nullable', 'max:255'], as: 'Eintritt')]
    public $eintritt = '';

    #[Rule(['nullable'], as: 'Veröffentlicht')]
    public $published = '';

    #[Rule(['nullable'], as: 'Veröffentlicht am')]
    public $published_at = '';

    #[Rule(['nullable'], as: 'Anwesend')]
    public $anwesend = '';

    public function setVeranstaltungen(Veranstaltungen $veranstaltungen = null): void
    {
        $this->veranstaltungen = $veranstaltungen;
        $this->datum_von = Carbon::parse($veranstaltungen->datum_von)->format('Y-m-d H:i');
        $this->datum_bis = Carbon::parse($veranstaltungen->datum_bis)->format('Y-m-d H:i');
        $this->veranstaltung = $veranstaltungen->veranstaltung;
        $this->veranstaltungsort = $veranstaltungen->veranstaltungsort;
        $this->veranstalter = $veranstaltungen->veranstalter;
        $this->description = $veranstaltungen->description;
        $this->quelle = $veranstaltungen->quelle;
        $this->slug = $veranstaltungen->slug;
        $this->eintritt = $veranstaltungen->eintritt;
        $this->published = $veranstaltungen->published;
        $this->published_at = $veranstaltungen->published_at;
        $this->anwesend = $veranstaltungen->anwesend;
    }

    public function save()
    {
        $this->validate();
        $admin = auth()->user()->hasAnyRole('super_admin', 'admin');
        if (empty($this->veranstaltungen)) {
            $this->slug = SlugService::createSlug(Veranstaltungen::class, 'slug', $this->veranstaltung);
            $this->datum_von = Carbon::parse($this->datum_von)->format('Y-m-d H:i');
            $this->datum_bis = Carbon::parse($this->datum_bis)->format('Y-m-d H:i');
            $this->published = (bool) $admin;
            $this->published_at = $admin ? now() : null;
            $this->anwesend = false;
            $veranstaltungen = Veranstaltungen::create($this->validate());

            if ($admin) {
                Toastr::success('Deine Veranstaltung wurde freigegeben.', ' ');

                return redirect(route('frontend.veranstaltungen.show', $veranstaltungen->slug));
            }

            Mail::to(env('TTF_EMAIL'))->send(new VeranstaltungenMail($veranstaltungen));
            Toastr::info('Deine Veranstaltung wurde gespeichert und wird nun von einem Admin geprüft und freigeschaltet.', ' ');

            return redirect(route('frontend.veranstaltungen.index'));
        }

        $this->slug = $this->veranstaltung === $this->veranstaltungen->veranstaltung ? $this->veranstaltungen->slug : SlugService::createSlug(Veranstaltungen::class, 'slug', $this->veranstaltung);
        $this->veranstaltungen->update($this->validate());
        if ($admin) {
            Toastr::info('Deine Veranstaltung wurde geändert!', ' ');
        } else {
            Mail::to(env('TTF_EMAIL'))->send(new VeranstaltungenEditMail($this->veranstaltungen));
            Toastr::info('Deine Veranstaltung wurde geändert und durch eine Admin erneut geprüft!', ' ');
        }

        return redirect(request()->header('Referer'));
    }
}
