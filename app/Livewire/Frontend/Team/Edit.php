<?php

namespace App\Livewire\Frontend\Team;

use App\Livewire\Forms\Frontend\Team\TeamForm;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Team\Team;
use File;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Yoeunes\Toastr\Facades\Toastr;

class Edit extends Component
{
    use WithFileUploads;

    public ?Team $team = null;

    public TeamForm $form;

    public $anrede = [
        'Herr',
        'Frau',
        'Divers',
        'keine Angabe',
    ];

    #[Rule('nullable|image|mimes:jpg,jpeg,png,gif,webp|max:5120')]
    public $image;

    public $oldImage;

    #[Rule('required|min:200', as: 'Description')]
    public $description = '';

    public function mount(Team $team = null): void
    {
        if ($team->exists) {
            $this->form->setTeam($team);
            $this->description = $team->description;
        }
        if ($team->photo_id) {
            $this->oldImage = Photos::where('id', $team->photo_id)->first()->images;
        }
    }

    public function updatedImage()
    {
        if ($this->image) {
            $path = 'images/'.replaceStrToLower($this->team->fullname()).'/profil';
            if (empty($this->team->photo_id)) {
                $photo = Photos::create(teamPhotoUpdate($this, $path));
                Team::where('user_id', $this->team->user_id)->update([
                    'photo_id' => $photo->id,
                    'path' => $path,
                ]);
                Toastr::success('Dein Profilbild wurde angelegt.', ' ');
            } else {
                if (File::exists(public_path($path))) {
                    File::deleteDirectory(public_path($path));
                }
                Photos::where('id', $this->team->photo_id)->update(teamPhotoUpdate($this, $path));
                Toastr::success('Dein Profilbild wurde aktualisierst.', ' ');
            }
        }

        return redirect()->route('frontend.team.show', $this->team->slug);
    }

    public function edit()
    {
        $this->form->save();
    }

    public function render()
    {
        return view('livewire.frontend.team.edit');
    }
}
