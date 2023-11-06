<?php

namespace App\Livewire\SysAdmin;

use App\Services\General\PopupService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role as ModelsRole;
use WireUi\Traits\Actions;

class Role extends Component
{
    use Actions;

    public $openModal = false;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;

    #[Rule('required')]
    public $name;

    protected $popupService;

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    private function setupModal($method, $title, $description, $actualMethod = null)
    {
        $this->openModal = true;
        $this->modalTitle = $title;
        $this->modalDescription = $description;
        $this->modalMethod = $actualMethod ?? $method;
    }

    public function add()
    {
        $this->setupModal("create", "Create Role", "Role Name");
    }

    public function create()
    {
        $this->validate();

        ModelsRole::create([
            'name' => strtolower($this->name)
        ]);

        $this->reset('name');
        $this->openModal = false;

        $this->dialog()->success('Success!', 'Role Created Successfully');
    }

    public function edit($id)
    {
        $this->name = ModelsRole::whereId($id)->first()->name;
        $this->setupModal("update", "Update Role", "Role Name", "update({$id})");
    }

    public function update($id)
    {
        $this->validate();

        ModelsRole::whereId($id)->update([
            'name' => strtolower($this->name)
        ]);

        $this->reset('name');
        $this->openModal = false;

        $this->dialog()->success('Success!', 'Role Successfully Updated.');
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the role?', 'Are you sure you want to delete the role?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelsRole::whereId($id)->delete();
        $this->dialog()->success('Success!', 'Role Successfully Deleted.');
    }

    public function render()
    {
        $roles = ModelsRole::paginate(10);

        return view('livewire.sys-admin.role',[
            'roles' => $roles
        ])->extends('layouts.main');
    }
}
