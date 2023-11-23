<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefTakaful;
use App\Services\General\PopupService;
use App\Services\Model\TakafulService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Takaful extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $code;
    
    #[Rule('required|regex:/^[A-Za-z\s]*$/|max:50')]
    public $description;
    
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $takaful;
    public $paginated;
    public $searchQuery;

    protected $takaful_Service;
    protected $popupService;


    public function __construct()
    {
        $this->takaful_Service = new TakafulService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Takaful", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($code)
    {
        $this->takaful = RefTakaful::find($code);
        $this->code = $this->takaful->code;
        $this->description = $this->takaful->description;
        $this->setupModal("update", "Update Takaful", "Description", "update({$code})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $trim_code = trim($this->code);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        
        if (TakafulService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            TakafulService::createTakaful($data);
            $this->reset();
            $this->openModal = false;
        }
    }
    
    public function update($id)
    {
        $this->validate();

        $trim_code = trim($this->code);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        
        if (TakafulService::canUpdateCode($id, $trim_code)){
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            TakafulService::updateTakaful($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 
        "Are you sure to delete CODE " . $code . " : " .$description. "?",$id);
    }

    public function ConfirmDelete($id)
    {
        TakafulService::deleteTakaful($id);
    }
    
    public function render()
    {
        $data = $this->takaful_Service->getTakafulResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.takaful',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
