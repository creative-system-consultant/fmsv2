<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefBank;
use Livewire\Component;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Banks extends Component
{
    use Actions,WithPagination,MaintenanceModalTrait;

    // Properties for modal and banks management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $bank;

    // Properties for banks data
    public $code;
    public $sys_desc;
    public $description;
    public $status;
    public $bank_acc_len;
    public $priority;
    public $bank_client;
    public $bank_cust;

    // Pagination & searching
    public $paginated;
    public $searchQuery;
    public $bank_code;
    public $orderBy = 'default';

    // Services
    protected $popupService;

    protected function createRules()
    {
        return [
            'code' => 'required|numeric|min:1|max:99',
            'description' => ['required', new ValidDescription, 'max:50'],
            'status' => 'nullable|boolean',
            'bank_acc_len' => 'required|numeric|min:1|max:99',
            'bank_client' => 'nullable|boolean',
            'bank_cust' => 'nullable|boolean',
        ];
    }

    protected function updateRules()
    {
        return [
            'code' => 'required|numeric|min:1|max:99',
            'description' => ['required', new ValidDescription, 'max:50'],
            'status' => 'nullable|boolean',
            'bank_acc_len' => 'required|numeric|min:1|max:99',
            'bank_client' => 'nullable|boolean',
            'bank_cust' => 'nullable|boolean',
            'priority' => 'numeric|min:1|max:9999'
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Bank", "Bank" );
        $this->reset(['code','description', 'bank_acc_len','status','bank_client','bank_cust','priority']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->bank = ModelService::findById(RefBank::class, $id);
        $this->sys_desc = $this->bank->sys_desc;
        $this->description = $this->bank->description;
        $this->bank_acc_len = $this->bank->bank_acc_len;
        $this->bank->status == 1 ? $this->status = true : $this->status = false;
        $this->bank->bank_client == 'Y' ? $this->bank_client = true : $this->bank_client = false;
        $this->bank->bank_cust == 'Y' ? $this->bank_cust = true : $this->bank_cust = false;
        $this->priority = $this->bank->priority;
        $this->code = $this->bank->code;

        $this->setupModal("update", "Update Bank", "Description", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code),
            'description' => FormattingService::formatDescription($this->description),
            'status' => $this->status,
            'priority' => $this->priority ?? 9999,
            'bank_acc_len' => trim($this->bank_acc_len),
            'bank_client' => $this->bank_client ? 'Y' : 'N',
            'bank_cust' => $this->bank_cust ? 'Y' : 'N',
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefBank::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefBank::class, $formattedData);
            $this->reset('code', 'description', 'priority');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefBank::class, $id, $formattedData['code'])) {
            ModelService::update(RefBank::class, $id, $formattedData);
            $this->reset('code', 'description', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete BANK : " . $description . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefBank::class, $id);
    }

    public function render()
    {
        if ($this->orderBy == 'default') {
            $orderBy = [
                'priority' => 'ASC',
                'description' => 'ASC'
            ];
        } else {
            $orderBy = [
                $this->orderBy => 'ASC'
            ];
        }

        $data = MaintenanceService::getPaginated(
            RefBank::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            $orderBy // $orderByArray
        );

        return view('livewire.admin.maintenance.banks',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
