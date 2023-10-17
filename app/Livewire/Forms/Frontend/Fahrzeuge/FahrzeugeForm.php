<?php

namespace App\Livewire\Forms\Frontend\Fahrzeuge;

use App\Mail\BestaetigungsMail;
use App\Mail\Fahrzeuge\HinzugefuegtMail;
use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use File;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Livewire\WithFileUploads;
use Mail;
use Str;

class FahrzeugeForm extends Form
{
    use WithFileUploads;

    public ?Fahrzeuge $fahrzeuge = null;

    #[Rule('required|max:255', as: 'Fahrzeug')]
    public $fahrzeug = '';

    #[Rule('nullable', as: 'Slug')]
    public $slug = '';

    #[Rule('required', as: 'Baujahr')]
    public $baujahr = '';

    #[Rule('nullable|max:255', as: 'Besonderheiten')]
    public $besonderheiten = '';

    #[Rule('required|max:255', as: 'Motor')]
    public $motor = '';

    #[Rule('nullable|max:255', as: 'Karosserie')]
    public $karosserie = '';

    #[Rule('nullable|max:255', as: 'Felgen')]
    public $felgen = '';

    #[Rule('nullable|max:255', as: 'Fahrwerk')]
    public $fahrwerk = '';

    #[Rule('nullable|max:255', as: 'Bremsen')]
    public $bremsen = '';

    #[Rule('nullable|max:255', as: 'Innenraum')]
    public $innenraum = '';

    #[Rule('nullable|max:255', as: 'Anlage')]
    public $anlage = '';

    #[Rule('required|min:25|max:4294967295', as: 'Fahrzeugbeschreibung')]
    public $description = '';

    #[Rule('nullable', as: 'Path')]
    public $path = '';

    #[Rule('nullable', as: 'Veröffentlicht')]
    public $published = '';

    #[Rule('nullable', as: 'Veröffentlicht am')]
    public $published_at = '';

    #[Rule('nullable', as: 'Bilder')]
    public $images = [];

    public function setFahrzeug(Fahrzeuge $fahrzeuge = null): void
    {
        $this->fahrzeuge = $fahrzeuge;
        $this->fahrzeug = $fahrzeuge->fahrzeug;
        $this->slug = $fahrzeuge->slug;
        $this->baujahr = Carbon::parse($fahrzeuge->baujahr)->format('Y-m-d');
        $this->besonderheiten = $fahrzeuge->besonderheiten;
        $this->motor = $fahrzeuge->motor;
        $this->karosserie = $fahrzeuge->karosserie;
        $this->felgen = $fahrzeuge->felgen;
        $this->fahrwerk = $fahrzeuge->fahrwerk;
        $this->bremsen = $fahrzeuge->bremsen;
        $this->innenraum = $fahrzeuge->innenraum;
        $this->anlage = $fahrzeuge->anlage;
        $this->description = $fahrzeuge->description;
        $this->path = $fahrzeuge->path;
        $this->published = $fahrzeuge->published;
        $this->published_at = $fahrzeuge->published_at;
    }

    public function save()
    {
        $this->validate();
        $slug = SlugService::createSlug(Fahrzeuge::class, 'slug', $this->fahrzeug);
        if ($this->validate()['images']) {
            $kategorie = 'Fahrzeuge';
            $path = 'images/'.replaceStrToLower(auth()->user()->fullname()).'/'.$kategorie.'/'.$slug;
            $image = imageUploadWithThumbnailMultiple($this->validate()['images'], $path);
            $fileSize = allFileSize($path);
        }
        if (empty($this->fahrzeuge)) {
            $fahrzeug = [
                'user_id' => auth()->id(),
                'team_id' => auth()->user()->teamID(),
                'fahrzeug' => $this->validate()['fahrzeug'],
                'slug' => $slug,
                'baujahr' => Carbon::parse($this->validate()['baujahr'])->format('Y-m-d'),
                'besonderheiten' => $this->validate()['besonderheiten'],
                'motor' => $this->validate()['motor'],
                'karosserie' => $this->validate()['karosserie'],
                'felgen' => $this->validate()['felgen'],
                'fahrwerk' => $this->validate()['fahrwerk'],
                'bremsen' => $this->validate()['bremsen'],
                'innenraum' => $this->validate()['innenraum'],
                'anlage' => $this->validate()['anlage'],
                'description' => $this->validate()['description'],
                'path' => $this->validate()['path'],
                'published' => 0,
                'published_at' => null,
            ];
            $team = Team::where('user_id', auth()->id())->first();
            $fahrzeuge = Fahrzeuge::create($fahrzeug);
            if (! empty($this->validate()['images'])) {
                // Create Album
                $album = Album::create(albumFZ($this->noEmpty($slug), $fileSize, $this, auth()->id()));
                // Create Photos
                foreach ($this->validate()['images'] as $item => $value) {
                    Photos::create([
                        'album_id' => $album->id,
                        'user_id' => auth()->id(),
                        'fahrzeuges_id' => $fahrzeuge->id,
                        'team_id' => auth()->user()->teamID(),
                        'slug' => $slug,
                        'size' => $image['size'][$item],
                        'images' => $image['data'][$item],
                        'images_thumbnail' => $image['dataThumbnail'][$item],
                        'description' => Str::limit(strip_tags($this->description), 200),
                        'published' => 0,
                        'published_at' => null,
                    ]);
                }
                // Write ThumbnailID, TeamId, Published, AlbumID to Cars and Photos, and write Path to Cars
                $thumbnailID = Photos::where('album_id', $album->id)->inRandomOrder()->first()->id;
                Album::where('id', $album->id)->update(['thumbnail_id' => $thumbnailID]);
                Photos::where('id', $thumbnailID)->update(['thumbnail' => true, 'team_id' => $team->id, 'published' => 1, 'published_at' => now()]);
                $fahrzeuge->update(['album_id' => $album->id, 'path' => $album->path]);
            }
            if (! $team->fahrzeug_vorhanden) {
                $team->update(['fahrzeug_vorhanden' => 1, 'fahrzeuges_id' => $fahrzeuge->id]);
            } else {
                $team->update(['fahrzeuges_id' => $fahrzeuge->id]);
            }
            toastr()->warning('Dein Fahrzeug wurde angelegt und wird durch einen Admin geprüft!', ' ');
            Mail::to('info@thueringer-tuning-freunde.de')->send(new HinzugefuegtMail($this->fahrzeuge));
        } else {
            $validatedData = $this->validate();
            if ($this->fahrzeuge->fahrzeug !== $validatedData['fahrzeug']) {
                $pathOld = explode('/', $this->fahrzeuge->path);
                $pathNew = 'images/'.(replaceStrToLower($pathOld[1]).'/'.replaceBlank($pathOld[2])).'/'.$slug;
                $validatedData = array_merge($this->validate(), ['slug' => $slug, 'path' => $pathNew]);
                Album::where('id', $this->fahrzeuge->album_id)->update(['title' => $this->fahrzeug, 'slug' => $slug, 'description' => $this->description, 'path' => $pathNew]);
                File::copyDirectory($this->fahrzeuge->path, $pathNew);
                File::deleteDirectory($this->fahrzeuge->path);
            } else {
                Album::where('id', $this->fahrzeuge->album_id)->update(['description' => $this->description]);
            }
            $this->fahrzeuge->update($validatedData);
            toastr()->success('Fahrzeugdaten wurden Aktualisiert.', ' ');
            foreach (Team::all() as $item) {
                sleep(1);
                $mail = [
                    'subject' => 'Es wurden Änderungen am Fahrzeug ('.$this->fahrzeuge->fahrzeug.') gemacht.',
                    'name' => $item->vorname,
                    'description' => '<p>'.ucfirst(auth()->user()->teams->slug).' hat gerade Änderungen an seinem Fahrzeug gemacht.</p><br>
                    <a href="'.url('fahrzeuge/'.$this->fahrzeuge->slug).'">zum Fahrzeug</x-custom.links.button-link>',
                ];
                Mail::to($item->email)->send(new BestaetigungsMail($mail));
            }
        }

        return redirect(route('frontend.fahrzeuge.index'));
    }

    public function noEmpty($slug)
    {
        $teamMitglied = replaceStrToLower(auth()->user()->vorname.'-'.auth()->user()->nachname);
        $besonderheiten = ! $this->validate()['besonderheiten'] ? 'keinen' : $this->validate()['besonderheiten'];
        $karosserie = ! $this->validate()['karosserie'] ? 'Serienmäßig keine Änderungen vorgenommen.' : $this->validate()['karosserie'];
        $fahrwerk = ! $this->validate()['fahrwerk'] ? 'Serienmäßig keine Änderungen vorgenommen.' : $this->validate()['fahrwerk'];
        $felgen = ! $this->validate()['felgen'] ? 'Serienmäßig keine Änderungen vorgenommen.' : $this->validate()['felgen'];
        $bremsen = ! $this->validate()['bremsen'] ? 'Serienmäßig keine Änderungen vorgenommen.' : $this->validate()['bremsen'];
        $innenraum = ! $this->validate()['innenraum'] ? 'Serienmäßig keine Änderungen vorgenommen.' : $this->validate()['innenraum'];
        $anlage = ! $this->validate()['anlage'] ? 'Serienmäßig keine Änderungen vorgenommen.' : $this->validate()['anlage'];

        $title = $this->validate()['fahrzeug'];
        if ($this->images) {
            $kategorie = 'Fahrzeuge';
            $path = 'images/'.$teamMitglied.'/'.$kategorie.'/'.$slug;
            $fileSize = allFileSize($path);
        }

        return [
            'besonderheiten' => $besonderheiten,
            'karosserie' => $karosserie,
            'fahrwerk' => $fahrwerk,
            'felgen' => $felgen,
            'bremsen' => $bremsen,
            'innenraum' => $innenraum,
            'anlage' => $anlage,
            'slug' => $slug ?? null,
            'kategorie' => $kategorie ?? null,
            'path' => $path ?? null,
            'fileSize' => $fileSize ?? null,
            'title' => $title ?? null,
        ];
    }
}
