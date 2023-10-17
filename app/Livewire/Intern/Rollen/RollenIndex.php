<?php

namespace App\Livewire\Intern\Rollen;

use App\Livewire\Forms\Intern\Rollen\RollenForm;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RollenIndex extends Component
{
    public $roles;

    public $permissions;

    public RollenForm $form;

    public function mount()
    {
        $this->roles = Role::all();
        $this->permissions = Permission::all();
    }

    public function save()
    {
        $this->form->save();
    }

    public function edit($rollen)
    {
        return redirect(route('intern.rollen.edit', $rollen));
    }

    public function show($rollen)
    {
        return redirect(route('intern.rollen.show', $rollen));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        toastr()->error('Die Rolle wurde gelöscht.', ' ');

        return redirect(route('intern.rollen.index'));
    }

    public function render()
    {
        metaTags('Verwalten Sie hier Ihre Rollen.', 'images/logo.svg', 'Rollen', 'NOINDEX,NOFOLLOW');

        return view('livewire.intern.rollen.rollen-index');
    }
}
