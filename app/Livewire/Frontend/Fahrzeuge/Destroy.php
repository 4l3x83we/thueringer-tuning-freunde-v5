<?php

namespace App\Livewire\Frontend\Fahrzeuge;

use App\Mail\BestaetigungsMail;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use File;
use Livewire\Component;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class Destroy extends Component
{
    public Fahrzeuge $fahrzeuge;

    public $userID;

    public $isLink;

    public function destroy(Fahrzeuge $fahrzeuge, $userID)
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

        $fahrzeuges = Fahrzeuge::where('user_id', $userID)->count() - 1;
        if ($fahrzeuges > 0) {
            Team::where('fahrzeuges_id', $fahrzeuge->id)->update(['fahrzeuges_id' => null]);
        } else {
            Team::where('fahrzeuges_id', $fahrzeuge->id)->update(['fahrzeuges_id' => null, 'fahrzeug_vorhanden' => 0]);
        }
        $fahrzeuge->delete();
        Toastr::error('Dein Fahrzeug wurde gelöscht!', 'Gelöscht!');
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
        return view('livewire.frontend.fahrzeuge.destroy');
    }
}
