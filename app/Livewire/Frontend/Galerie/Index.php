<?php

namespace App\Livewire\Frontend\Galerie;

use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $kategorieFilter = '';

    public function render()
    {
        $alben = Album::when($this->kategorieFilter, function ($query) {
            $query->where('kategorie', $this->kategorieFilter);
        })->where('published', true)->where('kategorie', '!=', 'Fahrzeuge')->orderBy('updated_at', 'DESC')->paginate(21);
        $alben->kategorie = Album::where('published', true)->where('kategorie', '!=', 'Fahrzeuge')->select('kategorie')->groupBy('kategorie')->get(21);
        $image = null;
        $albenThumbnail = $alben[random_int(0, $alben->count() - 1)]->where('kategorie', '!=', 'Fahrzeuge')->select(['thumbnail_id', 'path'])->inRandomOrder()->first();
        if ($albenThumbnail) {
            $photoImage = Photos::where('id', $albenThumbnail->thumbnail_id)->first()->images;
            $image = $albenThumbnail->path.'/'.$photoImage;
        }
        metaTags('Hier siehst du eine übersicht über unsere Bilder.', $image ?? 'images/logo.svg', 'Galerie', 'INDEX,FOLLOW');

        return view('livewire.frontend.galerie.index', [
            'alben' => $alben,
        ]);
    }
}
