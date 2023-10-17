<?php

namespace App\Livewire\Frontend\Team;

use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use Livewire\Component;

class Show extends Component
{
    public Team $team;

    public $fahrzeuge;

    public $alben;

    public $photo;

    public function mount()
    {
        $this->fahrzeuge = Fahrzeuge::where('user_id', $this->team->user_id)->get();
        $this->alben = Album::where('user_id', $this->team->user_id)->where('kategorie', '!=', 'Fahrzeuge')->get();
        $this->photo = Photos::where('user_id', $this->team->user_id)->count();
    }

    public function fahrzeugBild()
    {
        if ($this->team->fahrzeuges_id) {
            foreach ($this->alben as $album) {
                foreach ($album->photos as $photo) {
                    if ($album->thumbnail_id === $photo->id and $photo->published === 1) {
                        return asset($album->path.'/'.$photo->images_thumbnail);
                    }
                }
            }
        }
    }

    public function edit($id)
    {
        return redirect(route('frontend.team.edit', $id));
    }

    public function render()
    {
        metaTags($this->team->description, $this->team->profilBildMeta(), $this->team->slug, 'INDEX,FOLLOW');

        return view('livewire.frontend.team.show');
    }
}
