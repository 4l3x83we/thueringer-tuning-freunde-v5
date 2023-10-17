<?php

namespace App\Livewire\Frontend\Galerie;

use App\Mail\BestaetigungsMail;
use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Team\Team;
use File;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mail;

class Show extends Component
{
    use WithFileUploads;

    public $galerie;

    public $team;

    public $photo;

    //    public $photos;

    public $album;

    #[Rule('nullable', as: 'Weitere Bilder hinzufügen')]
    public $images = [];

    public function mount($galerie)
    {
        $this->album = Album::where('slug', $galerie)->with('photos')->first();
        //        $this->photos = Photos::where('album_id', $this->album->id)->get();
        $this->team = Team::where('user_id', $this->album->user_id)->first();
    }

    public function updatedImages()
    {
        $galerie = Album::where('id', $this->album->id)->first();
        $photo = imageUploadWithThumbnailMultiple($this->images, $galerie->path);
        $fileSize = allFileSize($galerie->path);

        foreach (Team::where('published', true)->get() as $value) {
            sleep(1);
            $mail = [
                'subject' => 'Neue Bilder zum Album ('.$galerie->title.') hinzugefügt.',
                'name' => ucfirst($value->slug),
                'description' => '<p>'.ucfirst(auth()->user()->teams->slug).' hat gerade neue Bilder bereitgestellt.</p>
                <p class="mt-4"><x-custom.links.button-link href="'.route('frontend.galerie.show', $value->slug).'">zur Galerie</x-custom.links.button-link></p>',
            ];
            Mail::to($value->email)->send(new BestaetigungsMail($mail));
        }

        if ($this->images && count($this->images) > 0) {
            foreach ($this->images as $item => $value) {
                Photos::create([
                    'user_id' => auth()->user()->id,
                    'album_id' => $galerie->id,
                    'team_id' => auth()->user()->teamID(),
                    'slug' => $galerie->slug,
                    'size' => $photo['size'][$item],
                    'images' => $photo['data'][$item],
                    'images_thumbnail' => $photo['dataThumbnail'][$item],
                    'published' => true,
                    'published_at' => now(),
                ]);
            }
            toastr()->info('Die Foto(s) wurden dem Album '.$galerie->title.' erfolgreich hinzugefügt', ' ');
        }
        Album::where('id', $galerie->id)->update(['size' => $fileSize]);

        return redirect()->route('frontend.galerie.show', $galerie->slug);
    }

    public function preview($photoID)
    {
        // Changing the preview image
        Photos::where('album_id', $this->album->id)->where('thumbnail', true)->first()->update(['thumbnail' => null]);
        $this->album->update(['thumbnail_id' => $photoID]);
        Photos::where('id', $photoID)->update(['thumbnail' => true]);
        toastr()->info('Vorschaubild wurde geändert!', ' ');

        return redirect()->route('frontend.galerie.show', $this->album->slug);
    }

    public function destroy()
    {
        // Delete from the album including all images
        $galerie = Album::where('id', $this->album->id)->first();
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

        return redirect()->route('frontend.galerie.index');
    }

    public function render()
    {
        metaTags($this->album->description, $this->album->thumbnail(), $this->album->slug, 'INDEX,FOLLOW');

        return view('livewire.frontend.galerie.show');
    }
}
