<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Fms\FmsGlobalParm;
use App\Services\General\PopupService;
use App\Services\Model\VirtualAccService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class VirtualAcc extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric')]
    public $valueCoolingPeriod;
    
    #[Rule('required|numeric')]
    public $valueThreshold;
    
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $virtualAcc;
    public $paginated;
    public $searchQuery;
    public $vac_item;

    protected $virtualAcc_Service;
    protected $popupService;

    public function __construct()
    {
        $this->virtualAcc_Service = new VirtualAccService();
        $this->popupService = app(PopupService::class);
    }

    public function openUpdateModal($va_item)
    { 
        $via_item = FmsGlobalParm::whereClientId(auth()->user()->client_id)
        ->select('COOLING_PERIOD', 'THRESHOLD')
        ->first();

        $this->vac_item = $va_item;
        $this->valueCoolingPeriod = $via_item->COOLING_PERIOD;
        $this->valueThreshold = $via_item->THRESHOLD;

        if($this->valueCoolingPeriod == $va_item)
        {
            $this->setupModal("update", "Update Value Cooling Period", "Description", "update({$va_item})");
        }
        else
        {
            $this->setupModal("update", "Update Value Threshold", "Description", "update({$va_item})");
        }

        $this->resetValidation();
    }
    
    public function update()
    {
        $this->validate();

        $data = FmsGlobalParm::whereClientId(auth()->user()->client_id)->first();

        if ($this->vac_item == $data->COOLING_PERIOD){ 
            VirtualAccService::updateCoolingPeriod($this->valueCoolingPeriod);
        }
        elseif (VirtualAccService::updateThreshold($this->valueThreshold)){ 
            $this->valueThreshold = $data->THRESHOLD;
        }
        $this->openModal = false;
    }
    
    public function render()
    {
        $data = $this->virtualAcc_Service->getVirtualAccResult($this->paginated);
        return view('livewire.admin.maintenance.virtual-acc',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
