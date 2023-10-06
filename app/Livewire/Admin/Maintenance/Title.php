<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefTitle;
use Livewire\Component;
use App\Services\Maintenance\TitleService;
use App\Services\General\PopupService;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Title extends Component
{
    use Actions, WithPagination;

    #[Rule('required|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $title;
    public $coopId;
    public $paginated;

    protected $titleService;
    protected $popupService;

    public function __construct()
    {
        $this->titleService = new TitleService();
        $this->popupService = app(PopupService::class);
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
        $this->setupModal("create", "Create Title", "Title");
    }

    public function openUpdateModal($id)
    {
        $this->title = RefTitle::find($id);
        $this->description = $this->title->description;
        $this->code = $this->title->code;
        $this->title->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update Title", "Title", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->titleService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->titleService->createTitle($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->titleService->canUpdateCode($id, $this->code)) {
            $this->titleService->updateTitle($id, $this->description, $this->code, $this->status);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        $this->titleService->deleteTitle($id);
    }

    public function render()
    {
        $data = $this->titleService->getPaginatedTitle($this->paginated);
        
        return view('livewire.admin.maintenance.title', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
