<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefGlcode;
use App\Services\Maintenance\GlCodeService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class GlCode extends Component
{
    use Actions, WithPagination;

    #[Rule('required|max:3|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $glcode;
    public $coopId;
    public $paginated;

    protected $glcodeService;

    public function __construct()
    {
        $this->glcodeService = new GlCodeService();
    }

    private function setupModal($method, $title, $description, $actualMethod = null)
    {
        $this->openModal = true;
        $this->modalTitle = $title;
        $this->modalDescription = $description;
        $this->modalMethod = $actualMethod ?? $method;
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Race", "Race");
    }

    public function openUpdateModal($id)
    {
        $this->glcode = RefGlcode::find($id);
        $this->description = $this->glcode->description;
        $this->code = $this->glcode->code;
        $this->glcode->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update Race", "Race", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->glcodeService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->glcodeService->createGlCode($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->glcodeService->canUpdateCode($id, $this->code)) {
            $this->glcodeService->updateGlcode($id, $this->description, $this->code, $this->status);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Delete the information?',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'ConfirmDelete',
                'params' => $id,
            ],
            'reject' => [
                'label'  => 'No, cancel',
                'method' => 'cancel',
            ],
        ]);
    }

    public function ConfirmDelete($id)
    {
        $this->glcodeService->deleteGlcode($id);
    }

    public function render()
    {
        $data = $this->glcodeService->getPaginatedGlcode($this->paginated);

        return view('livewire.admin.maintenance.glcode', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
