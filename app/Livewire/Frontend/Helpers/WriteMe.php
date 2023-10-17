<?php

namespace App\Livewire\Frontend\Helpers;

use App\Mail\Team\WriteMeMail;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Mail;
use Yoeunes\Toastr\Facades\Toastr;

class WriteMe extends Component
{
    public $team;

    #[Rule('required|max:255', as: 'Name')]
    public $nameSender;

    #[Rule('required|max:255', as: 'E-Mail Adresse')]
    public $emailSender;

    #[Rule('nullable', as: 'Name Empfänger')]
    public $nameRecipient;

    #[Rule('nullable', as: 'E-Mail Empfänger')]
    public $emailRecipient;

    #[Rule('required|max:255', as: 'Betreff')]
    public $subject;

    #[Rule('required', as: 'Nachricht')]
    public $message;

    public function writeMe($name, $email)
    {
        $validatedData = $this->validate();
        $validatedData['nameRecipient'] = $name;
        $validatedData['emailRecipient'] = $email;

        Mail::to($validatedData['emailRecipient'])->send(new WriteMeMail($validatedData));
        Toastr::success('E-Mail wurde versandt.', ' ');
        $this->dispatch('close-modal');
        $this->nameSender = null;
        $this->emailSender = null;
        $this->subject = null;
        $this->message = null;
    }

    public function render()
    {
        return view('livewire.frontend.helpers.write-me');
    }
}
