<?php

namespace App\Livewire\SysAdmin;

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
        $user->syncRoles($this->role);

        $this->openModal = false;
        $this->dialog()->success('Assign Successful', 'Role assigning to this user is successful.');
    }

    public function render()
    {
        $users = User::paginate(10);
        $roles = Role::all();

        return view('livewire.sys-admin.user-management', [
            'users' => $users,
            'roles' => $roles,
        ])->extends('layouts.main');
    }
}
