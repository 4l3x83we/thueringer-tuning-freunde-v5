<?php

namespace App\Livewire\Intern\Rollen;

use App\Livewire\Forms\Intern\Rollen\RollenForm;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RollenEdit extends Component
{
    public ?Role $rollen = null;

    public $permissions;

    public RollenForm $form;

    public function mount(Role $rollen = null)
    {
        if ($rollen->exists) {
            $this->permissions = Permission::all();
            $this->form->setRolle($rollen);
        }
    }

    public function save()
    {
        $this->form->save();
    }

    public function render()
    {
        metaTags('Hier kannst du einer Rolle neue Berechtigungen hinzufügen.', 'images/logo.svg', 'Rolle bearbeiten', 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.rollen.rollen-edit');
    }
}
