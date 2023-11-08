<?php

namespace App\Livewire\SysAdmin;

use App\Services\General\PopupService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission as ModelsPermission;
use WireUi\Traits\Actions;

class Permission extends Component
{
    use Actions;

    public $openModal = false;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $search = '';

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
        $this->setupModal("create", "Create Permission", "Permission Name");
    }

    public function create()
    {
        $this->validate();

        ModelsPermission::create([
            'name' => strtolower($this->name)
        ]);

        $this->reset('name');
        $this->openModal = false;

        $this->dialog()->success('Success!', 'Permission Created Successfully');
    }

    public function edit($id)
    {
        $this->name = ModelsPermission::whereId($id)->first()->name;
        $this->setupModal("update", "Update Permission", "Permission Name", "update({$id})");
    }

    public function update($id)
    {
        $this->validate();

        ModelsPermission::whereId($id)->update([
            'name' => strtolower($this->name)
        ]);

        $this->reset('name');
        $this->openModal = false;

        $this->dialog()->success('Success!', 'Permission Successfully Updated.');
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the permission?', 'Are you sure you want to delete the permission?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelsPermission::whereId($id)->delete();
        $this->dialog()->success('Success!', 'Permission Successfully Deleted.');
    }

    public function render()
    {
        // $permissions = ModelsPermission::paginate(10);
        $permissions = ModelsPermission::where('name', 'like', '%' . $this->search . '%')->get();

        return view('livewire.sys-admin.permission', [
            'permissions' => $permissions
        ])->extends('layouts.main');
    }
}
