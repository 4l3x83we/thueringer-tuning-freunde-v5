<?php

namespace App\Livewire\Frontend\Galerie\Album;

use App\Livewire\Forms\Frontend\Galerie\Album\AlbumForm;
use App\Models\Frontend\Alben\Album;
use Livewire\Component;

class Edit extends Component
{
    public ?Album $galerie = null;

    public AlbumForm $form;

    public function mount(Album $galerie = null): void
    {
        if ($galerie->exists) {
            $this->form->setAlbum($galerie);
        }
    }

    public function edit(): void
    {
        $this->form->save();
    }

    public function updatedFormPublishedAt()
    {
        $this->form->published = true;
    }

    public function render()
    {
        metaTags('Hier kannst du dein Album bearbeiten.', 'images/logo.svg', 'Neues Album bearbeiten', 'NOINDEX,NOFOLLOW');

        return view('livewire.frontend.galerie.album.edit');
    }
}
