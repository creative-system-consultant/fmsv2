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

    #[Rule('required|numeric|min:1|max:100')]
    public $bank_acc_len;

    #[Rule('numeric|min:1|max:9999')]
    public $priority;

    #[Rule('nullable|boolean')]
    public $bank_client;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $bank;
    public $paginated;
    public $searchQuery;
    public $bank_code;
    public $orderBy = 'default';

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
        $this->reset(['code','description', 'bank_acc_len','status','bank_client']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->bank_code = $id;
        $this->bank = RefBank::find($id);
        $this->description = $this->bank->description;
        $this->bank_acc_len = $this->bank->bank_acc_len;
        $this->bank->status == 1 ? $this->status = true : $this->status = false;
        $this->bank->bank_client == 'Y' ? $this->bank_client = true : $this->bank_client = false;
        $this->priority = $this->bank->priority;
        $this->code = $this->bank->code;
        
        $this->setupModal("update", "Update Bank", "Description", "update({$this->bank_code})");
        $this->resetValidation();
    }

    public function create()
    {
        
        $this->validate([
        'code' => 'required|numeric|min:1|max:99',
        'description' => 'required|regex:/^[A-Za-z\s]*$/|max:50',
        'status' =>'nullable|boolean',
        'bank_acc_len' => 'required|numeric|min:1|max:99',
        'bank_client' =>'nullable|boolean',
        ]);

        $trim_code = trim($this->code);
        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }

        // $table->char('bank_client', 1)->default('N');

        if (BanksService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'status' => $this->status,
                'bank_client'=> $this->bank_client ? 'Y' : 'N',
                'bank_client'=> $this->bank_client
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
                'status' => $this->status,
                'bank_acc_len'=> trim($this->bank_acc_len),
                'bank_client'=> $this->bank_client ? 'Y' : 'N',
                'priority' => $this->priority,
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

        $data = $this->banks_Service->getBanksResult($this->searchQuery, $this->orderBy, $this->paginated);
        return view('livewire.admin.maintenance.banks',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
    
}
