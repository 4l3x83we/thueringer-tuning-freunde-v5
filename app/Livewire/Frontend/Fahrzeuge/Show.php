<?php

namespace App\Livewire\Frontend\Fahrzeuge;

use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use File;
use Livewire\Component;
use Yoeunes\Toastr\Facades\Toastr;

class Show extends Component
{
    public Fahrzeuge $fahrzeuge;

    public $team;

    public $photos;

    public $previous;

    public $next;

    public $userID;

    public function mount()
    {
        $this->team = Team::where('user_id', $this->fahrzeuge->user_id)->first();
        $this->photos = Photos::where('fahrzeuges_id', $this->fahrzeuge->id)->with('albums')->get();
        $this->previous = previousPage('fahrzeuges', $this->fahrzeuge->id);
        $this->next = nextPage('fahrzeuges', $this->fahrzeuge->id);
    }

    public function destroy(Fahrzeuge $fahrzeuge)
    {
        $fahrzeuges = $fahrzeuge->count() - 1;
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

        if ($fahrzeuges > 0) {
            Team::where('fahrzeuges_id', $fahrzeuge->id)->update(['fahrzeuges_id' => null]);
        } else {
            Team::where('fahrzeuges_id', $fahrzeuge->id)->update(['fahrzeuges_id' => null, 'fahrzeug_vorhanden' => 0]);
        }
        $fahrzeuge->delete();
        Toastr::error('Dein Fahrzeug wurde gelöscht!', 'Gelöscht!');

        return redirect()->route('frontend.fahrzeuge.index');
    }

    public function render()
    {
        metaTags($this->fahrzeuge->description, $this->fahrzeuge->fahrzeugBildMeta(), $this->fahrzeuge->slug, 'INDEX,FOLLOW');

        return view('livewire.frontend.fahrzeuge.show');
    }
}
