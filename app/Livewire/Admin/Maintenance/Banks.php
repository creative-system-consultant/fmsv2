<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefBank;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\General\PopupService;
use App\Services\Model\BanksService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Banks extends Component
{
    use Actions,WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $code;

    #[Rule('required|regex:/^[A-Za-z\s]*$/|max:50')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    #[Rule('numeric|min:1|max:9999')]
    public $priority;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $bank;
    public $paginated;
    public $searchQuery;
    public $bank_code;

    protected $banks_Service;
    protected $popupService;

    public function __construct()
    {
        $this->banks_Service = new BanksService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Bank", "Bank" );
        $this->reset(['code','description','status']);
        // $this->priority = $this->bank->priority;
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->bank_code = $id;
        $this->bank = RefBank::find($id);
        $this->description = $this->bank->description;
        $this->bank->status == 1 ? $this->status = true : $this->status = false;
        $this->priority = $this->bank->priority;
        $this->code = $this->bank->code;
        
        $this->setupModal("update", "Update Bank", "Description", "update({$this->bank_code})");
        $this->resetValidation();
    }

    public function create()
    {
        
        $this->validate([
        'code' => 'required|numeric|min:1|max:99',
        'description' => 'required|regex:/^[A-Za-z\s]*$/|max:50',]);

        $trim_code = trim($this->code);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }

        if (BanksService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'status' => $this->status,
            ];
            BanksService::createBanksService($data);
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

        if (BanksService::canUpdateCode($id, $trim_code)) {

            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'priority' => $this->priority,
                'status' => $this->status,
            ];
            BanksService::updateBanksService($id, $data);
            $this->openModal = false;
        } 
        else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete BANK : " . $description . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        BanksService::deleteBanksService($id);
    }

    public function render()
    {

        $data = $this->banks_Service->getBanksResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.banks',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
    
}
