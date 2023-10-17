<?php

namespace App\Livewire\Forms\Intern\Rollen;

use Livewire\Attributes\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RollenForm extends Form
{
    public ?Role $rollen = null;

    #[Rule('required', as: 'Rolle')]
    public $name;

    #[Rule('required', as: 'Berechtigung')]
    public $permission = [];

    public function save(Role $rollen = null)
    {
        $this->validate();
        if ($this->rollen) {
            $this->rollen->update($this->only('name'));
            $this->rollen->syncPermissions($this->permission);
            toastr()->success('Die Rolle wurde erfolgreich geändert.', ' ');
        } else {
            $role = Role::create(['name' => $this->name]);
            $role->syncPermissions($this->permission);
            toastr()->success('Die Rolle wurde erfolgreich angelegt.', ' ');
        }

        return redirect(route('intern.rollen.index'));
    }

    public function setRolle(Role $rollen = null)
    {
        $this->rollen = $rollen;
        $this->name = $rollen->name;
        $this->permission = $rollen->permissions->pluck('name')->toArray();
    }
}
