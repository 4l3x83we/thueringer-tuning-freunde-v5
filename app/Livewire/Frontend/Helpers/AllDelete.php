<?php

namespace App\Livewire\Frontend\Helpers;

use App\Mail\Delete\AnfrageMail;
use Livewire\Component;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class AllDelete extends Component
{
    public $team;

    public $text = '';

    public function destroy($team)
    {
        Mail::to(env('TTF_EMAIL'))->send(new AnfrageMail($team));
        Toastr::error('Deine Anfrage zum Austritt wurde versandt.');

        return redirect(route('frontend.team.index'));
    }

    public function render()
    {
        return view('livewire.frontend.helpers.all-delete');
    }
}
