<?php

namespace App\Livewire\Frontend\Gaestebuch;

use App\Mail\Gaestebuch\GaestebuchEintragMail;
use App\Models\Frontend\Gaestebuch\Gaestebuch;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Yoeunes\Toastr\Facades\Toastr;

class Index extends Component
{
    #[Rule([
        'form.name' => 'required|min:4|max:50',
        'form.email' => 'required|email',
        'form.message' => 'required|max:10000',
        'form.facebook' => 'nullable|max:255',
        'form.tiktok' => 'nullable|max:255',
        'form.instagram' => 'nullable|max:255',
        'form.webseite' => 'nullable|max:255',
        'form.ip_adresse' => 'nullable',
    ], as: [
        'form.name' => 'Name',
        'form.email' => 'E-Mail Adresse',
        'form.message' => 'Nachricht',
        'form.facebook' => 'Facebook',
        'form.tiktok' => 'TikTok',
        'form.instagram' => 'Instagram',
        'form.webseite' => 'Webseite',
        'form.ip_adresse' => 'IP Adresse',
    ])]
    public $form = [];

    public function save()
    {
        //        $this->form['ip_adresse'] = request()->getClientIp();
        $this->form['ip_adresse'] = '31.19.236.175';
        $this->validate();
        $gaestebuch = Gaestebuch::create($this->validate()['form']);

        Mail::to('info@thueringer-tuning-freunde.de')->send(new GaestebuchEintragMail($gaestebuch));
        Toastr::success('Gästebucheintrag wurde erfolgreich eingesandt.', ' ');

        return redirect()->route('frontend.gaestebuch.index');
    }

    public function published(Gaestebuch $gaestebuch)
    {
        $gaestebuch->update(['published' => 1, 'published_at' => now()]);
        Toastr::success('Gästebucheintrag freigegeben.', ' ');

        return redirect()->route('frontend.gaestebuch.index');
    }

    public function destroy(Gaestebuch $gaestebuch)
    {
        $gaestebuch->delete();
        Toastr::error('Gästebucheintrag wurde gelöscht!', ' ');

        return redirect()->route('frontend.gaestebuch.index');
    }

    public function render()
    {
        $gaestebuch = Gaestebuch::orderBy('created_at', 'DESC')->get();
        metaTags('Hier kannst du uns einen netten Kommentar hinterlassen.', 'images/logo.svg', 'Gästebuch', 'INDEX,FOLLOW');

        return view('livewire.frontend.gaestebuch.index', ['gaestebuch' => $gaestebuch]);
    }
}
