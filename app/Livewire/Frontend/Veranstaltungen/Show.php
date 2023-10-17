<?php

namespace App\Livewire\Frontend\Veranstaltungen;

use App\Models\Frontend\Veranstaltungen\Veranstaltungen;
use Livewire\Component;
use Yoeunes\Toastr\Facades\Toastr;

class Show extends Component
{
    public Veranstaltungen $veranstaltungen;

    public function published(Veranstaltungen $veranstaltungen, int $status)
    {
        $veranstaltungen->update(['published' => $status, 'published_at' => $status ? now() : null]);

        if ($veranstaltungen->published) {
            Toastr::success('Veranstaltung wurde freigegeben!', ' ');
        } else {
            Toastr::error('Veranstaltung wird verborgen!', ' ');
        }

        return redirect(request()->header('Referer'));
    }

    public function destroy(Veranstaltungen $veranstaltungen)
    {
        $veranstaltungen->delete();
        Toastr::error('Veranstaltung wurde gelöscht!', ' ');

        return redirect(route('frontend.veranstaltungen.index'));
    }

    public function render()
    {
        metaTags(strip_tags($this->veranstaltungen->description), 'images/logo.svg', $this->veranstaltungen->veranstaltung, 'INDEX,FOLLOW');

        return view('livewire.frontend.veranstaltungen.show');
    }
}
