<?php

namespace App\Livewire\Frontend\Galerie\Photo;

use App\Models\Frontend\Alben\Photos;
use File;
use Livewire\Component;

class Destroy extends Component
{
    public Photos $photo;

    public function destroy($photo)
    {
        $team = Photos::where('id', $photo)->first();
        $path = $team->albums->path;
        if (File::exists(public_path($path.'/'.$team->images_thumbnail))) {
            File::delete(public_path($path.'/'.$team->images_thumbnail));
        }
        if (File::exists(public_path($path.'/'.$team->images))) {
            File::delete(public_path($path.'/'.$team->images));
        }
        $team->delete();
        toastr()->error('Bild wurde Gelöscht!', ' ');

        return redirect(route('frontend.galerie.show', $team->albums->slug));
    }

    public function render()
    {
        return view('livewire.frontend.galerie.photo.destroy');
    }
}
