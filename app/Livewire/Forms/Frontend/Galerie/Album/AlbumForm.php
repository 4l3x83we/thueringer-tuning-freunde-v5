<?php

namespace App\Livewire\Forms\Frontend\Galerie\Album;

use App\Mail\Album\CreateMail;
use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use File;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Livewire\WithFileUploads;
use Mail;
use Str;

class AlbumForm extends Form
{
    use WithFileUploads;

    public ?Album $galerie = null;

    #[Rule('required|max:255', as: 'Titel')]
    public string $title = '';

    #[Rule('required|max:255', as: 'Kategorie')]
    public string $kategorie = '';

    #[Rule('required|max:255', as: 'Veröffentlichen am')]
    public string $published_at = '';

    #[Rule('nullable|max:255', as: 'Veröffentlichen')]
    public bool $published = false;

    #[Rule('nullable|max:4294967295', as: 'Beschreibung')]
    public $description = '';

    #[Rule('nullable', as: 'Bilder')]
    public array $images = [];

    #[Rule('nullable', as: 'Bilder')]
    public $image = '';

    #[Rule('nullable', as: 'User ID')]
    public $user_id = '';

    #[Rule('nullable', as: 'Thumbnail ID')]
    public $thumbnail_id = '';

    #[Rule('nullable', as: 'Größe')]
    public $size = '';

    #[Rule('nullable', as: 'Slug')]
    public $slug = '';

    #[Rule('nullable', as: 'Path')]
    public $path = '';

    public function save()
    {
        $this->validate();
        $slug = (empty($this->galerie->title) === $this->title) ? $this->galerie->slug : SlugService::createSlug(Album::class, 'slug', $this->title);
        $path = empty($this->galerie->path) ? 'images/'.replaceStrToLower(auth()->user()->fullname()).'/'.replaceBlank($this->kategorie).'/'.$slug : $this->galerie->path;
        $photo = imageUploadWithThumbnailMultiple($this->images, $path);
        $fileSize = allFileSize($path);
        $kategorie = replaceBlank($this->kategorie);

        if (empty($this->galerie)) {
            $album = Album::create([
                'user_id' => $this->validate()['user_id'],
                'title' => $this->validate()['title'],
                'slug' => $slug,
                'size' => $fileSize,
                'description' => Str::limit($this->validate()['description'], 255, ''),
                'kategorie' => $kategorie,
                'path' => $path,
                'published' => $this->validate()['published'],
                'published_at' => $this->validate()['published_at'],
            ]);

            if ($this->validate()['images'] && count($this->validate()['images']) > 0) {
                foreach ($this->validate()['images'] as $item => $value) {
                    Photos::create([
                        'user_id' => $this->validate()['user_id'],
                        'album_id' => $album->id,
                        'team_id' => auth()->user()->teamID(),
                        'slug' => $slug,
                        'size' => $photo['size'][$item],
                        'images' => $photo['data'][$item],
                        'images_thumbnail' => $photo['dataThumbnail'][$item],
                        'published' => $this->validate()['published'],
                        'published_at' => $this->validate()['published_at'],
                    ]);
                }
                toastr()->info('Die Foto(s) wurden dem Album '.$this->validate()['title'].' erfolgreich hinzugefügt', ' ');
            }

            $thumbnailID = Photos::where('album_id', $album->id)->inRandomOrder()->first()->id;
            Album::where('id', $album->id)->update(['thumbnail_id' => $thumbnailID]);
            Photos::where('id', $thumbnailID)->update(['thumbnail' => true]);
            if ($album->published === false) {
                Mail::send(new CreateMail($album));
            }
            toastr()->success('Das Album mit dem Title '.$this->validate()['title'].' wurde angelegt', ' ');
        } else {
            $pathTitle = explode('/', $this->galerie->path)[0];
            $pathName = explode('/', $this->galerie->path)[1];
            $pathKategorie = explode('/', $this->galerie->path)[2];
            $pathSlug = explode('/', $this->galerie->path)[3];
            if ($this->galerie->title !== $this->title) {
                $this->galerie->update(['title' => $this->title, 'slug' => $slug]);
                $this->galerie->photos()->update(['slug' => $slug]);
            }
            if ($this->galerie->kategorie !== $this->kategorie) {
                $this->galerie->update(['kategorie' => $this->kategorie]);

            }
            if ($this->title === $this->galerie->title or $this->kategorie !== $this->galerie->kategorie) {
                if ($this->title === $this->galerie->title and $this->kategorie !== $this->galerie->kategorie) {
                    $pathNew = $pathTitle.'/'.$pathName.'/'.$this->kategorie.'/'.$pathSlug;
                } else {
                    $pathNew = $pathTitle.'/'.$pathName.'/'.$this->kategorie.'/'.$slug;
                }
            } else {
                $pathNew = $pathTitle.'/'.$pathName.'/'.$pathKategorie.'/'.$slug;
            }
            if ($path !== $pathNew) {
                $this->galerie->update(['path' => $pathNew]);
                File::copyDirectory($path, $pathNew);
                File::deleteDirectory($path);
                $pathEmpty = explode('/', $path);
                if (File::isEmptyDirectory(public_path($pathEmpty[0].'/'.$pathEmpty[1].'/'.$pathEmpty[2]))) {
                    File::deleteDirectory(public_path($pathEmpty[0].'/'.$pathEmpty[1].'/'.$pathEmpty[2]));
                }
            }
            if ((bool) $this->published === false) {
                $this->galerie->update(['published' => false, 'published_at' => null]);
                $this->galerie->photos()->update(['published' => false, 'published_at' => null]);
            } elseif ((bool) $this->published === true) {
                $this->galerie->update(['published' => true, 'published_at' => $this->published_at]);
                $this->galerie->photos()->update(['published' => true, 'published_at' => $this->published_at]);
            }
            if ($this->description !== $this->galerie->description) {
                $this->galerie->update(['description' => $this->description]);
            }

            toastr()->success('Das Album mit dem Title '.$this->galerie->title.' wurde geändert', ' ');
        }

        return redirect()->route('frontend.galerie.show', empty($this->galerie->slug) ? $this->slug : $this->galerie->slug);
    }

    public function setAlbum(Album $galerie = null): void
    {
        $this->galerie = $galerie;
        $this->image = $galerie->photos;
        $this->user_id = $galerie->user_id;
        $this->thumbnail_id = $galerie->thumbnail_id;
        $this->title = $galerie->title;
        $this->slug = $galerie->slug;
        $this->size = $galerie->size;
        $this->description = $galerie->description;
        $this->kategorie = $galerie->kategorie;
        $this->path = $galerie->path;
        $this->published_at = Carbon::parse($galerie->published_at)->format('Y-m-d H:i');
        $this->published = $galerie->published;
    }
}
