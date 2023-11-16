<?php

namespace App\Livewire\SysAdmin;

use App\Models\Ref\RefClient;
use App\Models\User;
use App\Services\General\PopupService;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use WireUi\Traits\Actions;

class UserManagement extends Component
{
    use Actions;

    public $openModal = false;
    public $modalMethod;

    public $role = [];

    protected $popupService;

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function assign($id)
    {
        $user = User::whereId($id)->first();
        $this->openModal = true;
        $this->modalMethod = "save({$id})";
        $this->role = $user->roles->pluck('name')->toArray();
    }

    public function save($id)
    {
        $user = User::whereId($id)->first();
        $clientId = auth()->user()->client_id;

        // Retrieve the role by its name and client ID
        $role = Role::where('name', $this->role)
            ->where('client_id', $clientId)
            ->first();

        // First, detach all roles for this client
        $currentRoles = $user->roles()->wherePivot('client_id', $clientId)->get();
        foreach ($currentRoles as $currentRole) {
            $user->removeRole($currentRole);
        }

        // Then, assign the new role for this client
        if ($role) {
            // Use syncRoles to manually attach the role with extra pivot column
            $user->roles()->syncWithoutDetaching([$role->id => ['client_id' => $clientId]]);
        }

        $this->openModal = false;
        $this->dialog()->success('Assign Successful', 'Role assigning to this user is successful.');
    }

    public function render()
    {
        $client = RefClient::whereId(auth()->user()->client_id)->first();
        $users = $client->users()->paginate(10);

        $roles = Role::where('client_id', auth()->user()->client_id)->get();

        return view('livewire.sys-admin.user-management', [
            'users' => $users,
            'roles' => $roles,
        ])->extends('layouts.main');
    }
}
