<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefIncome;
use App\Rules\Maintenance\ValidRangeDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Income extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and income management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $income;

    // Properties for income data
    public $code;
    public $description;

    // Pagination and searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'code' => 'required|numeric|min:1|max:99',
            'description' => ['required', new ValidRangeDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Income", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->income = ModelService::findById(RefIncome::class, $id);
        $this->code = $this->income->code;
        $this->description = $this->income->description;
        $this->setupModal("update", "Update Income", "Description", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code, true),
            'description' => FormattingService::formatDescription($this->description, $range = true),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefIncome::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefIncome::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefIncome::class, $id, $formattedData['code'])) {
            ModelService::update(RefIncome::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete CODE: " . $code . " and INCOME: " .$description. " ?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefIncome::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefIncome::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'code' => 'ASC',
                'description' => 'ASC'
            ] // $orderByArray
        );

        return view('livewire.admin.maintenance.income',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
