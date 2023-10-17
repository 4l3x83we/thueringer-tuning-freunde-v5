<?php

namespace App\Livewire\Frontend\Antrag;

use App\Mail\Antrag\AntragEingangAdminMail;
use App\Mail\Antrag\AntragEingangMail;
use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Str;
use Yoeunes\Toastr\Facades\Toastr;

class Index extends Component
{
    use UsesSpamProtection, WithFileUploads;

    public HoneypotData $extraFields;

    public AntragForm $team;

    public $fahrzeuge = [];

    public $anrede = [
        'Herr',
        'Frau',
        'Divers',
        'keine Angabe',
    ];

    #[Rule('nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120')]
    public $image;

    public $fahrzeugvorhanden = true;

    #[Rule('nullable', as: 'Fahrzeugbilder')]
    public array $images = [];

    public function messages()
    {
        return [
            'fahrzeuge.fahrzeug.required' => 'Fahrzeug muss ausgefüllt werden.',
            'fahrzeuge.baujahr.required' => 'Baujahr muss ausgefüllt werden.',
            'fahrzeuge.motor.required' => 'Motor muss ausgefüllt werden.',
            'fahrzeuge.description.required' => 'Beschreibung Fahrzeug muss ausgefüllt werden.',
            'fahrzeuge.description.min' => 'Beschreibung Fahrzeug muss mindestens 25 Zeichen lang sein.',
        ];
    }

    public function rules()
    {
        return [
            'fahrzeuge.fahrzeug' => $this->fahrzeugvorhanden ? 'required' : 'nullable',
            'fahrzeuge.baujahr' => $this->fahrzeugvorhanden ? 'required' : 'nullable',
            'fahrzeuge.besonderheiten' => 'nullable',
            'fahrzeuge.motor' => $this->fahrzeugvorhanden ? 'required' : 'nullable',
            'fahrzeuge.karosserie' => 'nullable',
            'fahrzeuge.felgen' => 'nullable',
            'fahrzeuge.fahrwerk' => 'nullable',
            'fahrzeuge.bremsen' => 'nullable',
            'fahrzeuge.innenraum' => 'nullable',
            'fahrzeuge.anlage' => 'nullable',
            'fahrzeuge.description' => $this->fahrzeugvorhanden ? 'required|min:25' : 'nullable',
        ];
    }

    public function mount()
    {
        $this->extraFields = new HoneypotData();
    }

    public function imagesReset()
    {
        $this->reset('images');
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        $this->protectAgainstSpam();
        $this->validate();
        $stopSpam = stopForumSpamEmail($this->validate()['team']['email']);
        $slug = SlugService::createSlug(Team::class, 'slug', $this->team->vorname.' '.$this->team->nachname);
        $path = 'images/'.replaceStrToLower($this->team->vorname.' '.$this->team->nachname).'/profil';
        $teamArray = array_merge($this->validate()['team'], [
            'fahrzeug_vorhanden' => $this->fahrzeugvorhanden,
            'ip_adresse' => request()->getClientIp(),
            'path' => $path,
            'slug' => $slug,
        ]);
        if ($this->image) {
            $profilImage = imageUpload($this->image, $path);
        }
        if ($this->images) {
            $kategorie = 'Fahrzeuge';
            $slugFahrzeug = SlugService::createSlug(Fahrzeuge::class, 'slug', $this->validate()['fahrzeuge']['fahrzeug']);
            $pathFahrzeuge = 'images/'.replaceStrToLower($this->team->vorname.' '.$this->team->nachname).'/'.$kategorie.'/'.$slugFahrzeug;
            $image = imageUploadWithThumbnailMultiple($this->images, $pathFahrzeuge);
            $fileSize = allFileSize($pathFahrzeuge);
        }
        if ($stopSpam->appears == 'no' and $stopSpam->appears == 'no') {
            $team['album'] = [];
            $team['fahrzeuge'] = null;
            $team['profilBild'] = null;
            $teamPhoto = null;
            if ($this->fahrzeugvorhanden) {
                if ($this->images) {
                    $album = Album::create($this->album($slugFahrzeug, $fileSize, $kategorie, $pathFahrzeuge));
                    foreach ($this->images as $item => $value) {
                        Photos::create($this->photos($slugFahrzeug, $image, $item, $album->id ?? null, $fahrzeug->id ?? null));
                    }

                    $thumbnailID = Photos::where('album_id', $album->id)->inRandomOrder()->first()->id;
                }
                $team = Team::create($teamArray);
                if ($this->image) {
                    $teamPhoto = Photos::create($this->teamPhoto($slug, $this->image, $profilImage, $team->id));
                }
                $fahrzeug = Fahrzeuge::create($this->fahrzeug($slugFahrzeug ?? null, $pathFahrzeuge ?? null, $album->id ?? null, $team->id ?? null));

                if (! empty($this->images)) {
                    Album::where('id', $album->id)->update(['thumbnail_id' => $thumbnailID]);
                    Photos::where('id', $thumbnailID)->update(['thumbnail' => true]);
                    $team['album'] = Album::with('photos')->find($album->id);
                    $album = Album::find($album->id)->id;
                    $photos = Photos::where('album_id', $album)->get();
                    foreach ($photos as $photo) {
                        $photo->update(['fahrzeuges_id' => $fahrzeug->id, 'team_id' => $team->id]);
                    }
                } else {
                    $team['album'] = null;
                }

                $team['fahrzeuge'] = Fahrzeuge::where('team_id', $team->id)->first();
            } else {
                $team = Team::create($teamArray);

                if ($this->image) {
                    $teamPhoto = Photos::create($this->teamPhoto($slug, $this->image, $profilImage, $team->id));
                }
            }
            if ($this->image) {
                Team::where('id', $team->id)->update(['photo_id' => $teamPhoto->id]);
                $team['profilBild'] = Photos::where('team_id', $team->id)->first()->images;
            } else {
                $team['profilBild'] = null;
            }
            $data = $team;
            Mail::to($team->email)->send(new AntragEingangMail($data));
            Mail::to(env('TTF_EMAIL'))->send(new AntragEingangAdminMail($data));
            Toastr::success('Dein Antrag wurde erfolgreich versendet.', 'Erfolgreich!');

            return redirect(route('frontend.index'));
        } else {
            stopForumSpamEntry($this->team->vorname.' '.$this->team->nachname, urlencode(request()->getClientIp()), htmlentities(urlencode($this->validate()['team']['description']), ENT_COMPAT, 'UTF-8'), urlencode($this->validate()['team']['email']));

            return redirect(route('frontend.index'));
        }
    }

    private function album($slugFahrzeug, $fileSize, $kategorie, $pathFahrzeuge)
    {
        return [
            'user_id' => null,
            'thumbnail_id' => null,
            'title' => $this->fahrzeuge['fahrzeug'],
            'slug' => $slugFahrzeug,
            'size' => $fileSize,
            'description' => Str::limit(strip_tags($this->fahrzeuge['description']), 200),
            'kategorie' => $kategorie,
            'path' => $pathFahrzeuge ?? null,
        ];
    }

    private function photos($slugFahrzeug, $images, $item, $albumID = null, $fahrzeugID = null)
    {
        return [
            'album_id' => $albumID,
            'fahrzeuges_id' => $fahrzeugID,
            'slug' => $slugFahrzeug,
            'size' => $images['size'][$item],
            'images' => $images['data'][$item],
            'images_thumbnail' => $images['dataThumbnail'][$item],
        ];
    }

    private function teamPhoto($slug, $image, $profilImage, $teamID = null)
    {
        return [
            'team_id' => $teamID,
            'slug' => $slug,
            'size' => bytesToHuman($image->getSize()),
            'images' => $profilImage,
        ];
    }

    private function fahrzeug($slugFahrzeug, $pathFahrzeug, $albumID = null, $teamID = null)
    {
        return [
            'album_id' => $albumID,
            'team_id' => $teamID,
            'fahrzeug' => $this->fahrzeuge['fahrzeug'],
            'slug' => $slugFahrzeug,
            'baujahr' => Carbon::parse($this->fahrzeuge['baujahr'])->format('Y-m-d'),
            'besonderheiten' => $this->fahrzeuge['besonderheiten'] !== '' ? $this->fahrzeuge['besonderheiten'] : null,
            'motor' => $this->fahrzeuge['motor'],
            'karosserie' => $this->fahrzeuge['karosserie'] !== '' ? $this->fahrzeuge['karosserie'] : null,
            'felgen' => $this->fahrzeuge['felgen'] !== '' ? $this->fahrzeuge['felgen'] : null,
            'fahrwerk' => $this->fahrzeuge['fahrwerk'] !== '' ? $this->fahrzeuge['fahrwerk'] : null,
            'bremsen' => $this->fahrzeuge['bremsen'] !== '' ? $this->fahrzeuge['bremsen'] : null,
            'innenraum' => $this->fahrzeuge['innenraum'] !== '' ? $this->fahrzeuge['innenraum'] : null,
            'anlage' => $this->fahrzeuge['anlage'] !== '' ? $this->fahrzeuge['anlage'] : null,
            'description' => $this->fahrzeuge['description'],
            'path' => $pathFahrzeug ?? null,
        ];
    }

    public function render()
    {
        $description = 'Hier kannst du deinen Mitgliedsantrag einreichen.';
        $title = 'Antrag';
        $robots = 'INDEX,FOLLOW';
        $image = 'images/logo.svg';
        metaTags($description, $image, $title, $robots);

        return view('livewire.frontend.antrag.index');
    }

    public function updatedFahrzeugvorhanden()
    {
        if ($this->fahrzeugvorhanden) {
            $this->fahrzeugvorhanden = true;
        }
    }
}
