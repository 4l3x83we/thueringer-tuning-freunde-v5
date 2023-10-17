<?php

namespace App\Livewire\Frontend\Galerie\Album;

use App\Livewire\Forms\Frontend\Galerie\Album\AlbumForm;
use App\Models\Frontend\Alben\Album;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public ?Album $galerie = null;

    public AlbumForm $form;

    public function mount(): void
    {
        if ($this->galerie) {
            $this->form->setAlbum($this->galerie);
            //            $this->description = $fahrzeuge->description;
        }
        $this->form->published_at = Carbon::parse(now())->format('Y-m-d H:i');
        $this->form->user_id = auth()->user()->id;
    }

    public function save()
    {
        $this->form->save();
    }

    public function render()
    {
        metaTags('Hier kannst du ein neues Album erstellen.', 'images/logo.svg', 'Neues Album anlegen', 'NOINDEX,NOFOLLOW');

        return view('livewire.frontend.galerie.album.create');
    }
}
