<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefFinancingRule;
use App\Services\Model\FinancingRuleService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class FinancingRule extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:9999')]
    public $code;

    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $financingRule;
    public $paginated;
    public $searchQuery;

    protected $financingRuleService;
    protected $popupService;

    public function __construct()
    {
        $this->financingRuleService = new FinancingRuleService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Financing Rule", "Financing Rule");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->financingRule = RefFinancingRule::find($id);
        $this->description = $this->financingRule->description;
        $this->code = $this->financingRule->code;
        $this->setupModal("update", "Update Financing Rule", "Financing Rule", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate();

        $paddedCode = str_pad(trim(strtoupper($this->code)), 4, '0', STR_PAD_LEFT);

        if (FinancingRuleService::isCodeExists($paddedCode)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => $paddedCode,
            ];

            FinancingRuleService::createFinancingRule($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (FinancingRuleService::canUpdateCode($id, $this->code)) {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => str_pad(trim(strtoupper($this->code)), 4, '0', STR_PAD_LEFT),
            ];

            FinancingRuleService::updateFinancingRule($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$code)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete code:' . $code .'?', $id);
    }
    
    
    public function ConfirmDelete($id)
    {
        FinancingRuleService::deleteFinancingRule($id);
    }

    public function render()
    {
        $data = $this->financingRuleService->getFinancingRuleResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.financing-rule', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
