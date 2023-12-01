<?php

namespace App\Livewire\SysAdmin;

use App\Models\Ref\System;
use App\Models\Ref\SystemModule;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class EditRoleBody extends Component
{
    use Actions;

    public $selectedSystem = false;
    public $clientRole;
    public $role;
    public $name;
    public $currentSystem;
    public $currentSystemData;
    public $modules;
    public $permissions;
    public $selectedPermission = [];
    public $selectedModule = [];
    public $allModules = [];
    public $allPermissions = [];

    public function mount($systemId, $roleId, $name)
    {
        $user = User::find(auth()->id());
        $this->permissions = $user->getAllPermissions();
        $this->updateSystemData($systemId);
        $this->clientRole = Role::find($user->roles->first()->id);
        $this->role = Role::find($roleId);
        $this->name = $name;

        // // Cache all modules and permissions
        $this->allModules = SystemModule::whereSystemId($this->currentSystem)->whereIn('id', $this->permissions->pluck('module_id')->unique())->pluck('id')->toArray();
        $this->allPermissions = Permission::where('system_id', $this->currentSystem)->pluck('id')->toArray();

        $this->selectedPermission = $this->role->permissions->where('system_id', $this->currentSystem)->pluck('id')->toArray();
        $this->modules = SystemModule::whereSystemId($this->currentSystem)->whereIn('id', $this->permissions->pluck('module_id')->unique())->get();

        // Iterate over each module and check if the role has all permissions of the module
        foreach ($this->modules as $module) {
            $modulePermissions = Permission::where('system_id', $this->currentSystem)->where('module_id', $module->id)->pluck('id')->toArray();
            if (!array_diff($modulePermissions, $this->selectedPermission) && count($modulePermissions) > 0) {
                $this->selectedModule[] = $module->id;
            }
        }

        // Check if all modules and permissions in the system are selected
        $this->selectedSystem = !array_diff($this->allModules, $this->selectedModule) && !array_diff($this->allPermissions, $this->selectedPermission);
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'currentSystem') {
            $this->updateSystemData($this->currentSystem);
        }
    }

    private function updateSystemSelection()
    {
        $this->selectedSystem = !array_diff($this->allModules, $this->selectedModule) && !array_diff($this->allPermissions, $this->selectedPermission);
    }

    public function updatedSelectedSystem($value)
    {
        if ($value) {
            // Select all modules and only the permissions in the current system that the role has
            $this->selectedModule = SystemModule::whereSystemId($this->currentSystem)->pluck('id')->toArray();
            $this->selectedPermission = Permission::where('system_id', $this->currentSystem)
                ->whereIn('id', $this->role->permissions->pluck('id'))
                ->pluck('id')
                ->toArray();
        } else {
            // Deselect all modules and permissions
            $this->selectedModule = [];
            $this->selectedPermission = [];
        }
        $this->updateSystemSelection();
    }

    public function updatedSelectedModule()
    {
        foreach ($this->selectedModule as $moduleId) {
            $moduleId = (int) $moduleId; // Cast to integer
            // Fetch permissions for this module that the SA role has
            $modulePermissions = Permission::where('module_id', $moduleId)
                ->whereIn('id', $this->clientRole->permissions->pluck('id'))
                ->pluck('id')
                ->toArray();

            $this->selectedPermission = array_merge($this->selectedPermission, $modulePermissions);
        }

        $this->selectedPermission = array_values(array_unique($this->selectedPermission));
        $this->updateSystemSelection();
    }

    public function updatedSelectedPermission()
    {
        $allModulePermissions = Permission::whereIn('module_id', $this->modules->pluck('id'))->get()->groupBy('module_id');

        $this->selectedModule = [];
        foreach ($this->modules as $module) {
            $modulePermissions = $allModulePermissions[$module->id] ?? collect();
            if ($modulePermissions->pluck('id')->diff($this->selectedPermission)->isEmpty()) {
                $this->selectedModule[] = $module->id;
            }
        }

        // Cast permission IDs to integers
        $this->selectedPermission = array_map('intval', $this->selectedPermission);

        // Update selectedSystem status
        $this->updateSystemSelection();
    }

    private function updateSystemData($systemId)
    {
        $user = User::find(auth()->id());
        $this->currentSystem = $systemId;
        $this->permissions = $user->getAllPermissions();
        $this->currentSystemData = System::find($this->currentSystem);
        $this->modules = SystemModule::whereSystemId($this->currentSystem)->whereIn('id', $this->permissions->pluck('module_id')->unique())->get();
    }

    public function update()
    {
        $this->role->update([
            'name' => strtolower($this->name),
            'client_id' => auth()->user()->client_id,
            'created_by' => auth()->id()
        ]);

        // Revoke all current permissions
        $this->role->revokePermissionTo($this->role->permissions);

        // Assign new permissions
        $this->role->givePermissionTo($this->selectedPermission);

        $this->notification()->success('Success!', 'Role Successfully Updated.');
    }

    public function render()
    {
        return view('livewire.sys-admin.edit-role-body');
    }
}
