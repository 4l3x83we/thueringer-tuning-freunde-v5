<?php

namespace App\Livewire\Frontend\Antrag;

use App\Mail\Antrag\AntragEntferntMail;
use App\Mail\Antrag\AntragGenehmigtClubMail;
use App\Mail\Antrag\AntragGenehmigtMail;
use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use File;
use Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class AnnahmeShow extends Component
{
    public $teams;

    public $albumID;

    public $fahrzeugID;

    public $fahrzeug;

    public $alben;

    #[Rule('required')]
    public $slug;

    #[Rule('nullable')]
    public $published_at;

    #[Rule('nullable')]
    public $function;

    #[Rule('nullable')]
    public $zahlung;

    #[Rule('nullable')]
    public $zahlungsArt;

    #[Rule('nullable')]
    public $is_checked;

    public function updatedZahlungsArt()
    {
        if ($this->zahlungsArt === 'Mitgliedsbeitrag') {
            $this->zahlungsArt = 'Mitgliedsbeitrag';
            $this->zahlung = number_format(20, 2);
            if ($this->teams->zahlungs_art) {
                Team::where('id', $this->teams->id)->update(['zahlungs_art' => $this->zahlungsArt, 'zahlung' => $this->zahlung]);

                return redirect(route('intern.annahme.index'));
            }
        }

        if ($this->zahlungsArt === 'Werkstatt') {
            $this->zahlungsArt = 'Werkstatt';
            $this->zahlung = number_format(25, 2);
            if ($this->teams->zahlungs_art) {
                Team::where('id', $this->teams->id)->update(['zahlungs_art' => $this->zahlungsArt, 'zahlung' => $this->zahlung]);
            }
        } elseif ($this->zahlungsArt === 'Miete') {
            $this->zahlungsArt = 'Miete';
            $this->zahlung = number_format(80, 2);
            if ($this->teams->zahlungs_art) {
                Team::where('id', $this->teams->id)->update(['zahlungs_art' => $this->zahlungsArt, 'zahlung' => $this->zahlung]);
            }
        } else {
            if ($this->teams->zahlungs_art) {
                Team::where('id', $this->teams->id)->update(['zahlungs_art' => null, 'zahlung' => null]);

                return redirect(route('intern.annahme.index'));
            }
        }

        return null;
    }

    public function mount($team)
    {
        $this->teams = Team::with('fahrzeuges')->find($team);
        if ($this->teams->fahrzeug_vorhanden) {
            foreach ($this->teams->fahrzeuges as $fahrzeuge) {
                if ($fahrzeuge->album_id) {
                    $this->teams['albums'] = Album::where('id', $fahrzeuge->album_id)->with('photos')->first();
                    $this->albumID = $this->teams['albums']->id;
                } else {
                    $this->teams['albums'] = null;
                }
                $this->fahrzeugID = $fahrzeuge->id;
                $this->fahrzeug = $fahrzeuge->fahrzeug;
            }
        }
        $this->slug = $this->teams->vorname;
        $this->zahlung = number_format($this->teams->zahlung, 2);
        $this->zahlungsArt = $this->teams->zahlungs_art;
        $this->function = 'Clubmitglied';
        $this->published_at = Carbon::parse(now())->format('Y-m-d');
        if ($this->teams->user_id) {
            $this->alben = Album::where('user_id', $this->teams->user_id)->with('photos')->where('kategorie', '!=', 'Fahrzeuge')->get();
        } else {
            $this->alben = [];
        }
    }

    public function updatedZahlung()
    {
        if ($this->zahlungsArt === 'Werkstatt') {
            $this->zahlungsArt = 'Werkstatt';
        } elseif ($this->zahlungsArt === 'Miete') {
            $this->zahlungsArt = 'Miete';
        }
        Team::where('id', $this->teams->id)->update(['zahlungs_art' => $this->zahlungsArt, 'zahlung' => $this->zahlung]);

        return redirect(route('intern.annahme.index'));
    }

    public function checked()
    {
        $teamID = $this->teams->id;
        $team = $this->teams;
        $published_at = Carbon::parse($this->published_at)->toDateString();
        $slug = SlugService::createSlug(Team::class, 'slug', $this->slug);
        $password = passwort_generate(10);
        $user = User::create([
            'vorname' => $this->teams['vorname'],
            'nachname' => $this->teams['nachname'],
            'email' => $this->teams['email'],
            'password' => Hash::make($password),
        ]);

        $user->assignRole([2]);

        Team::where('id', $teamID)->update([
            'published' => 1,
            'slug' => $slug,
            'funktion' => $this->function,
            'zahlungs_art' => $this->zahlungsArt,
            'zahlung' => $this->zahlung,
            'user_id' => $user->id,
            'published_at' => $published_at,
        ]);

        if ($this->teams->fahrzeug_vorhanden) {
            $data = [
                'user_id' => $user->id,
                'published' => 1,
                'published_at' => $published_at,
            ];
            Fahrzeuge::where('id', $this->fahrzeugID)->update($data);
            Album::where('id', $this->albumID)->update($data);
            Photos::where('album_id', $this->albumID)->update($data);
            $team->fahrzeuge = Fahrzeuge::where('id', $this->fahrzeugID)->first();
            $team->album = Album::where('id', $this->albumID)->with('photos');
            //            $team->photos = Photos::where('album_id', $this->albumID)->get();
        }
        if ($this->teams->photo_id) {
            $photo_id = $this->teams->photo_id;
            Photos::where('id', $photo_id)->first()->update([
                'user_id' => $user->id,
                'published' => 1,
                'published_at' => $published_at,
            ]);
        }
        $team->password = $password;
        $team->slug = $slug;
        Mail::to($this->teams['email'])->send(new AntragGenehmigtMail($team));
        foreach (Team::all() as $item) {
            sleep(1);
            Mail::to($item->email)->send(new AntragGenehmigtClubMail($team));
        }

        $expiresAt = now()->addDays(7);
        $user->sendWelcomeNotification($expiresAt);

        Toastr::success('Antrag wurde genehmigt', 'Erfolgreich');

        return redirect()->route('intern.annahme.index');
    }

    public function revoke()
    {
        $teamID = $this->teams->id;
        $team = $this->teams;
        $team->fahrzeuge = Fahrzeuge::find($team->fahrzeuges_id);
        if ($team->fahrzeug_vorhanden) {
            $team->album = Album::find($team->fahrzeuge->album_id);
        }
        if ($team->photo_id) {
            $team->profilBild = Photos::find($team->photo_id);
        }

        if ($this->teams->fahrzeug_vorhanden) {
            $data = [
                'user_id' => null,
                'published' => 0,
                'published_at' => null,
            ];
            Fahrzeuge::where('user_id', $team->user_id)->update($data);
            Photos::where('user_id', $team->user_id)->update($data);
            Album::where('user_id', $team->user_id)->update($data);
        }

        Team::where('id', $teamID)->update([
            'published' => 0,
            'slug' => null,
            'funktion' => null,
            'zahlungs_art' => null,
            'zahlung' => null,
            'user_id' => null,
            'published_at' => null,
        ]);

        User::find($team->user_id)->delete();
        foreach (Team::all() as $item) {
            sleep(1);
            Mail::to($item->email)->send(new AntragEntferntMail($team));
        }
        Toastr::success('Antrag wurde zurückgezogen', 'Erfolgreich');

        return redirect()->route('intern.annahme.index');
    }

    public function destroy($id)
    {
        $team = Team::where('id', $id)->with('fahrzeuges')->first();
        foreach (Team::all() as $item) {
            sleep(1);
            Mail::to($item->email)->send(new AntragEntferntMail($team));
        }
        $team->fullname = replaceStrToLower($team->vorname.' '.$team->nachname);
        $team->path = 'images/'.$team->fullname;

        if ($team->photo_id) {
            Photos::where('id', $team->photo_id)->delete();
        }
        if ($team->fahrzeug_vorhanden) {
            if ($team->user_id) {
                $albums = Album::where('user_id', $team->user_id)->get();
                foreach ($albums as $album) {
                    $album->delete();
                }
                foreach ($team->fahrzeuges as $fahrzeuge) {
                    $fahrzeuge->delete();
                }
                User::where('id', $team->user_id)->delete();
            } else {
                foreach ($team->fahrzeuges as $fahrzeuge) {
                    $albums = Album::where('id', $fahrzeuge->album_id)->get();
                    foreach ($albums as $album) {
                        $album->delete();
                    }
                    $fahrzeuge->delete();
                }
            }
        }
        if (File::exists(public_path($team->path))) {
            File::deleteDirectory(public_path($team->path));
        }
        $team->delete();
        Toastr::error('Das Mitglied wurde gelöscht!', 'Gelöscht!');

        return redirect()->route('intern.annahme.index');

    }

    public function render()
    {
        if ($this->teams->album_id) {
            $photo = $this->teams['albums']->path.'/'.Photos::find($this->teams['albums']->thumbnail_id)->images;
        } else {
            $photo = 'images/logo.svg';
        }
        metaTags('Mitgliedsantrag von: '.$this->teams->fullname().' bearbeiten.', $photo, 'Mitgliedsantrag von: '.$this->teams->fullname(), 'INDEX,FOLLOW');

        return view('livewire.frontend.antrag.annahme-show');
    }
}
