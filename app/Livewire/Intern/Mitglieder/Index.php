<?php

namespace App\Livewire\Intern\Mitglieder;

use App\Models\Frontend\Team\Team;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $teams;

    public $alben;

    public function mount()
    {
        $this->teams = Team::with('users')->get();
    }

    public function show($slug)
    {
        return redirect(route('intern.mitglieder.show', $slug));
    }

    public function sendNewPassword(User $user)
    {
        $expiresAt = now()->addMonth();
        $user->sendWelcomeNotification($expiresAt);
        toastr()->info('Die Einladung zum neu setzen der Passwortes wurde versand an: '.$user->vorname.' '.$user->nachname.' mit der E-Mail '.$user->email, ' ');

        return redirect(route('intern.mitglieder.index'));
    }

    public function render()
    {
        metaTags('Hier kannst du alle Mitglieder sehen.', 'images/logo.svg', 'Mitglieder', 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.mitglieder.index');
    }
}
