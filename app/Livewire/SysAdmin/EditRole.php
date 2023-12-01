<?php

namespace App\Livewire\SysAdmin;

use App\Models\Ref\System;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class EditRole extends Component
{
    public $role;
    public $name;
    public $system;
    public $currentSystem = 1;
    public $currentSystemData;
    public $modules;
    public $permissions;

    public function mount($id)
    {
        $this->role = Role::find($id);
        $this->name = $this->role->name;
        $this->system = System::all();
    }

    public function setState($index)
    {
        $this->currentSystem = $index;
    }

    public function render()
    {
        return view('livewire.sys-admin.edit-role')->extends('layouts.main');
    }
}
