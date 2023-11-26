<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefGlcode;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class GlCode extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and gl code management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $glcode;

    // Properties for gl code data
    public $code;
    public $description;
    public $status;

    // Pagination & searching
    public $paginated;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'code' => ['required', 'string', 'min:2', 'max:6'],
            'description' => ['required', new ValidDescription],
            // 'status' => ['nullable', 'boolean'],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create GL Code", "GL Code Name");
    }

    public function openUpdateModal($id)
    {
        $this->glcode = ModelService::findById(RefGlcode::class, $id);
        $this->description = $this->glcode->description;
        $this->code = $this->glcode->code;
        $this->glcode->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update GL Code", "GL Code Name", "update({$id})");
    }

    protected function formatData()
    {
        return [
            'GL_CODE' => FormattingService::formatCode($this->code),
            'DESCRIPTION' => FormattingService::formatDescription($this->description),
            // 'status' => $this->status,
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefGlcode::class, $formattedData['GL_CODE'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefGlcode::class, $formattedData);
            $this->reset('code', 'description', 'status');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefGlcode::class, $id, $formattedData['GL_CODE'])) {
            ModelService::update(RefGlcode::class, $id, $formattedData);
            $this->reset('code', 'description', 'status');
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
        ModelService::delete(RefGlcode::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(RefGlcode::class, $this->paginated);

        return view('livewire.admin.maintenance.glcode', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
