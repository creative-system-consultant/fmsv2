<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefTitle;
use Livewire\Component;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Title extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and title management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $title;

    // Properties for title data
    public $title_id;
    public $description;
    public $priority;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    protected function createRules()
    {
        return [
            'title_id' => ['required', 'numeric', 'min:1', 'max:99'],
            'description' => ['required', new ValidDescription],
        ];
    }

    protected function updateRules()
    {
        return [
            'title_id' => ['required', 'numeric', 'min:1', 'max:99'],
            'description' => ['required', new ValidDescription],
            'priority' => 'numeric|min:1|max:9999',
        ];
    }

    public function __construct()
    {
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
        $this->title = ModelService::findById(RefTitle::class, $id);
        $this->description = $this->title->description;
        $this->title_id = $this->title->title_id;
        $this->priority = $this->title->priority;
        $this->setupModal("update", "Update Title", "Title", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'title_id' => FormattingService::formatCode($this->title_id, true),
            'description' => FormattingService::formatDescription($this->description),
            'priority' => $this->priority ?? 9999,
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefTitle::class, $formattedData['title_id'])) {
            $this->addError('code', 'The Title ID has already been taken.');
        } else {
            ModelService::create(RefTitle::class, $formattedData);
            $this->reset('title_id', 'description', 'priority');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefTitle::class, $id, $formattedData['title_id'])) {
            ModelService::update(RefTitle::class, $id, $formattedData);
            $this->reset('title_id', 'description', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The Title Id has already been taken.');
        }
    }

    public function delete($id,$description)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete ' . $description .'?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefTitle::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(RefTitle::class, $this->paginated, true, $this->searchQuery);

        return view('livewire.admin.maintenance.title', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
