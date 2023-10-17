<?php

namespace App\Livewire\Intern\Mitglieder;

use App\Livewire\Forms\Frontend\Team\TeamForm;
use App\Mail\BestaetigungsMail;
use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use App\Models\Intern\Payment;
use File;
use Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mail;
use Spatie\Permission\Models\Role;
use Yoeunes\Toastr\Facades\Toastr;

class Show extends Component
{
    use WithFileUploads;

    public Team $team;

    public TeamForm $form;

    #[Rule('nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120')]
    public $image;

    public array $password = [];

    public $roles;

    public $anrede = [
        'Herr',
        'Frau',
        'Divers',
        'keine Angabe',
    ];

    #[Rule([
        'roleCheck.id' => 'nullable',
        'roleCheck.name' => 'nullable',
    ])]
    public $roleCheck = [];

    public $payments;

    public function mount()
    {
        $this->roles = Role::all();
        $this->roleCheck = $this->team->users->roles->pluck('name')->toArray();
        if ($this->team->exists) {
            $this->form->setTeam($this->team);
        }
        $this->payments = Payment::where('team_id', $this->team->id)->orderByDesc('payment_for_month')->limit(3)->get();
        $this->payments->gesamt = number_format($this->payments->where('bezahlt', true)->sum('betrag'), 2, ',', '.').' €';
        $this->payments->gesamtOpen = number_format($this->payments->where('bezahlt', false)->sum('betrag'), 2, ',', '.').' €';
        $this->payments->gesamtOverdue = null;
        foreach ($this->payments as $payment) {
            $this->payments->gesamtOverdue = number_format($this->payments->where('payment_for_month', '<', now())->where('bezahlt', false)->sum('betrag'), 2, ',', '.').' €';
        }
    }

    public function edit()
    {
        $this->form->save();
    }

    public function updatedImage()
    {
        if ($this->image) {
            $path = 'images/'.replaceStrToLower($this->team->fullname()).'/profil';
            if (empty($this->team->photo_id)) {
                $photo = Photos::create(teamPhotoUpdate($this, $path));
                Team::where('user_id', $this->team->user_id)->update([
                    'photo_id' => $photo->id,
                    'path' => $path,
                ]);
                Toastr::success('Dein Profilbild wurde angelegt.', ' ');
            } else {
                if (File::exists(public_path($path))) {
                    File::deleteDirectory(public_path($path));
                }
                Photos::where('id', $this->team->photo_id)->update(teamPhotoUpdate($this, $path));
                Toastr::success('Dein Profilbild wurde aktualisierst.', ' ');
            }
        }

        return redirect()->route('intern.mitglieder.show', $this->team->slug);
    }

    public function changePassword()
    {
        $validatedData = $this->validate([
            'password.current_password' => 'required|string|current_password:web',
            'password.password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
        ], [
            'password.password' => 'Password muss ausgefüllt werden.',
            'password.current_password' => 'Das angegebene Passwort stimmt nicht mit Ihrem aktuellen Passwort überein.',
        ]);
        $this->team->users->forceFill([
            'password' => Hash::make($validatedData['password']['password']),
        ]);

        toastr()->success('Dein Passwort wurde geändert.', ' ');

        return redirect(route('intern.mitglieder.show', $this->team->slug));
    }

    public function userRoles()
    {
        $this->team->users->syncRoles([$this->roleCheck]);
        toastr()->success('Die Rolle des Benutzers: '.$this->team->users->fullname().' wurde angepasst.', ' ');

        return redirect(route('intern.mitglieder.show', $this->team->slug));
    }

    public function destroy(Team $team)
    {
        if ($team->photo_id) {
            $photo = Photos::where('id', $team->photo_id)->first();
            if (File::exists(public_path($team->path))) {
                File::deleteDirectory(public_path($team->path));
            }
            $photo->delete();
            $team->update(['photo_id' => null, 'path' => null]);
        }
        Toastr::error('Dein Profilbild wurde gelöscht.', ' ');

        return redirect(route('intern.mitglieder.show', $this->team->slug));
    }

    public function showFahrzeug(Fahrzeuge $fahrzeuge)
    {
        return redirect(route('frontend.fahrzeuge.show', $fahrzeuge));
    }

    public function showGalerie(Album $galerie)
    {
        return redirect(route('frontend.galerie.show', $galerie));
    }

    public function destroyFahrzeug(Fahrzeuge $fahrzeuge)
    {
        $userID = $fahrzeuge->user_id;
        $team = Team::where('id', $fahrzeuge->team_id)->first()->slug;
        if ($fahrzeuge->album_id) {
            $pathEmpty = explode('/', $fahrzeuge->path);
            if (File::exists(public_path($fahrzeuge->albums->path))) {
                File::deleteDirectory(public_path($fahrzeuge->albums->path));
            }
            if (File::isEmptyDirectory(public_path($pathEmpty[0].'/'.$pathEmpty[1].'/'.$pathEmpty[2]))) {
                File::deleteDirectory(public_path($pathEmpty[0].'/'.$pathEmpty[1].'/'.$pathEmpty[2]));
            }
            $fahrzeuge->albums->delete();
        }

        $fahrzeuges = Fahrzeuge::where('user_id', $userID)->count() - 1;
        if ($fahrzeuges > 0) {
            Team::where('fahrzeuges_id', $fahrzeuge->id)->update(['fahrzeuges_id' => null]);
        } else {
            Team::where('fahrzeuges_id', $fahrzeuge->id)->update(['fahrzeuges_id' => null, 'fahrzeug_vorhanden' => 0]);
        }
        $fahrzeuge->delete();
        Toastr::error('Dein Fahrzeug wurde gelöscht!', 'Gelöscht!');
        $mail = [
            'subject' => 'Das Fahrzeug wurde '.$fahrzeuge->fahrzeug.' gelöscht.',
            'name' => 'Webmaster',
            'description' => '<p>'.ucfirst(auth()->user()->teams->slug).' hat gerade das Fahrzeug gelöscht.</p>',
        ];
        Mail::to('info@thueringer-tuning-freunde.de')->send(new BestaetigungsMail($mail));

        return redirect()->route('intern.mitglieder.show', $team);
    }

    public function destroyGalerie(Album $galerie)
    {
        $team = Team::where('user_id', $galerie->user_id)->first();
        $pathEmpty = explode('/', $galerie->path);
        if (File::exists($galerie->path)) {
            File::deleteDirectory($galerie->path);
        }
        if (File::isEmptyDirectory(public_path($pathEmpty[0].'/'.$pathEmpty[1].'/'.$pathEmpty[2]))) {
            File::deleteDirectory(public_path($pathEmpty[0].'/'.$pathEmpty[1].'/'.$pathEmpty[2]));
        }
        $mail = [
            'subject' => 'Das Album '.$galerie->title.'  wurde gerade gelöscht.',
            'name' => 'Webmaster',
            'description' => '<p>'.ucfirst(auth()->user()->teams->slug).' hat gerade das Album gelöscht.</p>',
        ];
        Mail::to('info@thueringer-tuning-freunde.de')->send(new BestaetigungsMail($mail));
        $galerie->delete();
        toastr()->error('Die Galerie wurde endgültig gelöscht!', ' ');

        return redirect()->route('intern.mitglieder.show', $team->slug);
    }

    public function payment($paymentID, $status)
    {
        $payment = $this->payments->where('id', $paymentID)->first();
        $team = $this->team->where('id', $payment->team_id)->first();
        $payment->update(['bezahlt' => $status, 'date_of_payment' => now()]);

        if ($status) {
            toastr()->success('Die Zahlung ist eingegangen', ' ');
        } else {
            toastr()->error('Die Zahlung wurde zurückgezogen', ' ');
        }

        return redirect()->route('intern.mitglieder.show', $team->slug);
    }

    public function render()
    {
        metaTags('Hier kannst du deine Profil angaben ändern.', 'images/logo.svg', 'Profil von '.$this->team->fullname(), 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.mitglieder.show');
    }
}
