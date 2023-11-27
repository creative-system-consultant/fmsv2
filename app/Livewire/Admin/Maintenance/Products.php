<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Siskop\SiskopAccountProduct;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Products extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    // Properties for modal and product management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $products;

    // Properties for cust product data
    public $name;
    public $priority;
    public $profit_rate;
    public $payout_max;
    public $process_fee;
    public $amount_min;
    public $amount_max;
    public $amount_default;

    public $updated_by;
    public $updated_at;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    protected function createRules()
    {
        return [
            'name' => 'required|string|max:255',
            'profit_rate' => 'required|numeric|min:0.00',
            'payout_max' => 'required|numeric|min:0.00',
            'process_fee' => 'required|numeric|min:0.00',
            'amount_min' => 'required|numeric|min:0.00',
            'amount_max' => 'required|numeric|min:0.00',
            'amount_default' => 'required|numeric|min:0.00'
        ];
    }

    protected function updateRules()
    {
        return [
            'name' => 'required|string|max:255',
            'profit_rate' => 'required|numeric|min:0.00',
            'payout_max' => 'required|numeric|min:0.00',
            'process_fee' => 'required|numeric|min:0.00',
            'amount_min' => 'required|numeric|min:0.00',
            'amount_max' => 'required|numeric|min:0.00',
            'amount_default' => 'required|numeric|min:0.00',
            'priority' => 'numeric|min:1|max:9999',
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Product", "Name" );
        $this->reset('name','profit_rate','payout_max','process_fee','amount_min','amount_max','amount_default');
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->products = ModelService::findById(SiskopAccountProduct::class, $id);

        $fields = ['name', 'profit_rate', 'payout_max', 'process_fee', 'amount_min', 'amount_max', 'amount_default', 'priority'];

        foreach ($fields as $field) {
                $this->$field = $this->products->$field;
            }
        $this->setupModal("update", "Update Product", "Name", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'name' => FormattingService::formatDescription($this->name),
            'profit_rate' => $this->profit_rate,
            'payout_max' => $this->payout_max,
            'process_fee' => $this->process_fee,
            'amount_min' => $this->amount_min,
            'amount_max' => $this->amount_max,
            'amount_default' => $this->amount_default,
            'priority' => $this->priority ?? 9999,
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(SiskopAccountProduct::class, $formattedData['name'], 'name')) {
            $this->addError('name', 'The name has already been taken.');
        } else {
            ModelService::create(SiskopAccountProduct::class, $formattedData);
            $this->reset('name', 'profit_rate', 'payout_max', 'process_fee', 'amount_min', 'amount_max', 'amount_default', 'priority');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(SiskopAccountProduct::class, $id, $formattedData['name'], 'name')) {
            ModelService::update(SiskopAccountProduct::class, $id, $formattedData);
            $this->reset('name', 'profit_rate', 'payout_max', 'process_fee', 'amount_min', 'amount_max', 'amount_default', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('name', 'The name has already been taken.');
        }
    }

    public function delete($id,$name)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete PRODUCT : " . $name . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(SiskopAccountProduct::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            SiskopAccountProduct::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'priority' => 'ASC',
                'name' => 'ASC'
            ] // $orderByArray
        );

        return view('livewire.admin.maintenance.products',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}