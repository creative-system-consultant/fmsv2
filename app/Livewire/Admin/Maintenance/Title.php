<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefTitle;
use Livewire\Component;
use App\Services\Model\TitleService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Title extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $title_id;

    #[Rule('required|regex:/^[A-Za-z \']+(\([A-Za-z]+\))?$/')]
    public $description;

    #[Rule('numeric|min:1|max:9999')]
    public $priority;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $title;
    public $paginated;
    public $searchQuery;
    public $prio_id;

    protected $titleService;
    protected $popupService;

    public function __construct()
    {
        $this->titleService = new TitleService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Title", "Title");
        $this->reset(['description', 'title_id']); // Clear the values for description and title_id
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->prio_id = $id;
        $this->title = RefTitle::find($id);
        $this->description = $this->title->description;
        $this->title_id = $this->title->title_id;
        $this->priority = $this->title->priority;
        $this->setupModal("update", "Update Title", "Title", "update({$this->prio_id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate([
            'title_id' => 'required|numeric|min:1|max:99',
            'description' => 'required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/',
        ]);
        $trim_code = trim($this->title_id);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        if (TitleService::isTitleIdExists($trim_code)) {
            $this->addError('title_id', 'The title id has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'title_id' => $trim_code,
            ];

            TitleService::createTitle($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $trim_code = trim($this->title_id);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }

        if (TitleService::canUpdateTitleId($id, $this->title_id)) {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'priority' => $this->priority,
                'title_id' => $trim_code,
            ];

            TitleService::updateTitle($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('title_id', 'The title id has already been taken.');
        }
    }

    public function delete($id,$description)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete ' . $description .'?', $id);
    }
    
    
    public function ConfirmDelete($id)
    {
        TitleService::deleteTitle($id);
    }

    public function render()
    {
        $data = $this->titleService->getTitleResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.title', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
