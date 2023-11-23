<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Siskop\SiskopAccountProduct;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\General\PopupService;
use App\Services\Model\ProductsService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Products extends Component
{
    use Actions,WithPagination,MaintenanceModalTrait;

    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('required|numeric|min:1| max:9999')]
    public $priority;

    #[Rule('required|numeric|min:0.00')]
    public $profit_rate;

    #[Rule('required|numeric|min:0.00')]
    public $payout_max;

    #[Rule('required|numeric|min:0.00')]
    public $process_fee;

    #[Rule('required|numeric|min:0.00')]
    public $amount_min;

    #[Rule('required|numeric|min:0.00')]
    public $amount_max;

    #[Rule('required|numeric|min:0.00')]
    public $amount_default;

    public $updated_by;
    public $updated_at;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $products;
    public $product_id;
    public $paginated;
    public $searchQuery;

    protected $products_Service;
    protected $popupService;

    public function __construct()
    {
        $this->products_Service = new ProductsService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Product", "Name" );
        $this->reset(['name','profit_rate','payout_max','process_fee','amount_min','amount_max','amount_default','updated_by','updated_at']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->product_id = $id;
        $this->products = SiskopAccountProduct::find($id);
    
        $fields = ['name', 'profit_rate', 'payout_max', 'process_fee', 'amount_min', 'amount_max', 'amount_default', 'priority','updated_by','updated_at'];
    
        foreach ($fields as $field) {
                $this->$field = $this->products->$field;
            }
        $this->setupModal("update", "Update Product", "Name", "update({$this->product_id})");
        $this->resetValidation();
    }

    public function create()
    {
        
        $this->validate([
        'name' => 'required|string|max:255',
        'profit_rate' => 'required|numeric|min:0.00',
        'payout_max' => 'required|numeric|min:0.00',
        'process_fee' => 'required|numeric|min:0.00',
        'amount_min' => 'required|numeric|min:0.00',
        'amount_max' => 'required|numeric|min:0.00',
        'amount_default' => 'required|numeric|min:0.00',
        ]);


        if (ProductsService::isProductExists($this->name)) {
            $this->addError('name', 'The name has already been taken.');
        } else {
            $data = [
                'name'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->name))),
                'profit_rate' => $this->profit_rate,
                'payout_max' => $this->payout_max,
                'process_fee' => $this->process_fee,
                'amount_min' => $this->amount_min,
                'amount_max' => $this->amount_max,
                'amount_default' => $this->amount_default,
                'updated_by' =>  $this->updated_by,
                'updated_at' =>  $this->updated_at,
            ];
            ProductsService::createAllProducts($data);
            $this->reset();
            $this->openModal = false;
        }
        dd($data);
    }

    public function update($id)
    {
        $this->validate();

        if (ProductsService::canUpdateProducts($id, $this->name)) {
    
            $data = [
                'name'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->name))),
                'profit_rate' => trim($this->profit_rate),
                'payout_max' => $this->payout_max,
                'process_fee' => $this->process_fee,
                'amount_min' => $this->amount_min,
                'amount_max' => $this->amount_max,
                'amount_default' => $this->amount_default,
                'updated_by' =>  $this->updated_by,
                'updated_at' =>  $this->updated_at,
                'priority' => $this->priority,
            ];
            ProductsService::UpdateProducts($id, $data);
            $this->openModal = false;
        } 
        else {
            $this->addError('name', 'The name has already been taken.');
        }
    }

    public function delete($id,$name)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete PRODUCT : " . $name . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        ProductsService::deleteProducts($id);
    }

    public function render()
    {
        $data = $this->products_Service->getProductsResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.products',[
            'data' =>$data,
        ])->extends('layouts.main');
        
        
    }
    
}