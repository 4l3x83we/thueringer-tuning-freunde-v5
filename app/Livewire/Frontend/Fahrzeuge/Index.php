<?php

namespace App\Livewire\Frontend\Fahrzeuge;

use App\Mail\BestaetigungsMail;
use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use Carbon\Carbon;
use File;
use Livewire\Component;
use Livewire\WithPagination;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class Index extends Component
{
    use WithPagination;

    public function published(Fahrzeuge $fahrzeuge)
    {
        $data = [
            'published' => 1,
            'published_at' => Carbon::parse(now())->toDateTimeLocalString(),
        ];
        if ($fahrzeuge->album_id) {
            $album = Album::where('id', $fahrzeuge->album_id)->first();
            $album->update($data);
            $photos = Photos::where('fahrzeuges_id', $fahrzeuge->id)->get();
            foreach ($photos as $photo) {
                $photo->update($data);
            }
        }
        $fahrzeuge->update($data);

        toastr()->success('Das Fahrzeug wurde freigegeben.', ' ');

        return redirect(route('frontend.fahrzeuge.index'));
    }

    public function unpublished(Fahrzeuge $fahrzeuge)
    {
        $data = [
            'published' => 0,
            'published_at' => null,
        ];
        if ($fahrzeuge->album_id) {
            $album = Album::where('id', $fahrzeuge->album_id)->first();
            $album->update($data);
            $photos = Photos::where('fahrzeuges_id', $fahrzeuge->id)->get();
            foreach ($photos as $photo) {
                $photo->update($data);
            }
            Photos::where('album_id', $fahrzeuge->album_id)->where('thumbnail', 1)->update(['published' => 1, 'published_at' => Carbon::parse(now())->toDateTimeLocalString()]);
        }
        $fahrzeuge->update($data);

        toastr()->success('Das Fahrzeug wurde ausgeblendet.', ' ');

        return redirect(route('frontend.fahrzeuge.index'));
    }

    public function destroy(Fahrzeuge $fahrzeuge)
    {
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

        $fahrzeuges = Fahrzeuge::where('user_id', $fahrzeuge->user_id)->count() - 1;
        if ($fahrzeuges > 0) {
            Team::where('fahrzeuges_id', $fahrzeuge->id)->update(['fahrzeuges_id' => null]);
        } else {
            Team::where('fahrzeuges_id', $fahrzeuge->id)->update(['fahrzeuges_id' => null, 'fahrzeug_vorhanden' => 0]);
        }
        $fahrzeuge->delete();
        Toastr::error('Das Fahrzeug wurde gelöscht!', 'Gelöscht!');
        $mail = [
            'subject' => 'Das Fahrzeug wurde '.$fahrzeuge->fahrzeug.' gelöscht.',
            'name' => 'Webmaster',
            'description' => '<p>'.ucfirst(auth()->user()->teams->slug).' hat gerade das Fahrzeug gelöscht.</p>',
        ];
        Mail::to('info@thueringer-tuning-freunde.de')->send(new BestaetigungsMail($mail));

        return redirect()->route('frontend.fahrzeuge.index');
    }

    public function render()
    {
        metaTags('Hier siehst du eine Übersicht über unsere aktuellen Fahrzeuge.', 'images/logo.svg', 'Fahrzeuge', 'INDEX,FOLLOW');

        $fahrzeuges = Fahrzeuge::orderBy('updated_at', 'DESC')->paginate(21);

        return view('livewire.frontend.fahrzeuge.index', [
            'fahrzeuges' => $fahrzeuges,
        ]);
    }
}
