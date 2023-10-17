<?php

namespace App\Livewire\Frontend\Kontakt;

use App\Mail\Kontakt\KontaktMail;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class Index extends Component
{
    use UsesSpamProtection;

    public HoneypotData $extraFields;

    #[Rule('required', as: 'Name')]
    public string $name = '';

    #[Rule('required|email:strict,dns,spoof', as: 'E-Mail')]
    public string $email = '';

    #[Rule('required', as: 'Betreff')]
    public string $subject = '';

    #[Rule('required|min:50', as: 'Message')]
    public string $message = '';

    public function mount()
    {
        $this->extraFields = new HoneypotData();
    }

    /**
     * @throws Exception
     */
    public function save()
    {
        $this->protectAgainstSpam();
        $validatedData = $this->validate();
        $validatedData['ip_adresse'] = request()->getClientIp();
        Mail::to(env('TTF_EMAIL'))->send(new KontaktMail($validatedData));
    }

    public function render()
    {
        metaTags('Hier kannst du uns kontaktieren.', 'images/logo.svg', 'Kontakt', 'INDEX,FOLLOW');

        return view('livewire.frontend.kontakt.index');
    }
}
