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
    public $coolingperiod;
    public $threshold;

    protected $virtualAcc_Service;
    protected $popupService;

    public function __construct()
    {
        $this->virtualAcc_Service = new VirtualAccService();
        $this->popupService = app(PopupService::class);
    }

    public function show(){
        
        $data = FmsGlobalParm::getValue();

        // Check if $va_item is not null before accessing its properties
        if ($data) {
            $this->valueCoolingPeriod = $data->COOLING_PERIOD;
            $this->valueThreshold = $data->THRESHOLD;
        }
    }

    public function openUpdateModal()
    {
        $data = FmsGlobalParm::getValue();

        // Check if $va_item is not null before accessing its properties
        if ($data) {
            $this->valueCoolingPeriod = $data->COOLING_PERIOD;
            $this->valueThreshold = $data->THRESHOLD;
        }
        $this->setupModal("update", "Update value Cooling Period", "Description", "update({$data})");
        $this->resetValidation();
    }

    public function openUpdateModal_Threshold($valueThreshold)
    {
        $this->threshold = FmsGlobalParm::find($valueThreshold);
        $this->valueThreshold = $this->threshold->valueThreshold;
        $this->setupModal("update", "Update value Threshold", "Description", "update({$valueThreshold})");
        $this->resetValidation();
    }
    
    public function update($id)
    {
        $this->validate();
        
        if (VirtualAcc::canUpdateCoolingPeriod($id, $this->valueCoolingPeriod)){
            $data = [
                'COOLING_PERIOD'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->valueCoolingPeriod))),
            ];
            VirtualAccService::updateCoolingPeriod($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('valueCoolingPeriod', 'The value has already been taken.');
        }
    }
    
    public function render()
    {
        $data = $this->virtualAcc_Service->getVirtualAccResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.virtual-acc',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
