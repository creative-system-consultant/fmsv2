<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Fms\FmsGlobalParm;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class VirtualAcc extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and va management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $virtualAcc;

    // Properties for va data
    #[Rule('required|numeric')]
    public $valueCoolingPeriod;

    #[Rule('required|numeric')]
    public $valueThreshold;

    // Pagination and searching
    public $paginated;
    public $searchQuery;
    public $vac_item;

    // Services
    protected $popupService;

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openUpdateModal($va_item)
    {
        $via_item = ModelService::findFirstByClientId(FmsGlobalParm::class, auth()->user()->client_id);

        $this->vac_item = $va_item;
        $this->valueCoolingPeriod = $via_item->COOLING_PERIOD;
        $this->valueThreshold = $via_item->THRESHOLD;

        $modalTitle = $this->valueCoolingPeriod == $va_item ? "Update Value Cooling Period" : "Update Value Threshold";
        $this->setupModal("update", $modalTitle, "Description", "update({$va_item})");
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate();

        $data = FmsGlobalParm::whereClientId(auth()->user()->client_id)->first();

        $formattedData = [];

        if ($this->vac_item == $data->COOLING_PERIOD) {
            $formattedData['COOLING_PERIOD'] = $this->valueCoolingPeriod;
            ModelService::updateUsingClientId(FmsGlobalParm::class, $formattedData);
        } elseif ($this->vac_item == $data->THRESHOLD) {
            $formattedData['THRESHOLD'] = $this->valueThreshold;
            ModelService::updateUsingClientId(FmsGlobalParm::class, $formattedData);
        }

        $this->reset('valueCoolingPeriod', 'valueThreshold');
        $this->openModal = false;
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            FmsGlobalParm::class,
            $this->paginated, // $perPage
        );

        return view('livewire.admin.maintenance.virtual-acc',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
