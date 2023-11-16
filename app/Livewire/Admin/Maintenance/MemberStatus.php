<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefMemStatus;
use App\Services\General\PopupService;
use App\Services\Model\MemberStatusService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class MemberStatus extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|alpha|size:2','member status')]
    public $mbr_status;

    #[Rule('required|regex:/^[A-Za-z\s]+$/')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $mbrstatus;
    public $paginated;
    public $searchQuery;

    protected $memberstatus_Service;
    protected $popupService;


    public function __construct()
    {
        $this->memberstatus_Service = new MemberStatusService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Member Status", "Description");
        $this->reset(['mbr_status','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($mbr_status)
    {
        $this->mbrstatus = RefMemStatus::find($mbr_status);
        $this->mbr_status = $this->mbrstatus->mbr_status;
        $this->description = $this->mbrstatus->description;
        $this->setupModal("update", "Update Member Status", "Description", "update({$mbr_status})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        if (MemberStatusService::isCodeExists($this->mbr_status)) {
            $this->addError('mbr_status', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'mbr_status' => trim(strtoupper($this->mbr_status)),
            ];
            MemberStatusService::createMemberStatusService($data);
            $this->reset();
            $this->openModal = false;
        }
    }
    
    public function update($id)
    {
        $this->validate();

        if (MemberStatusService::canUpdateCode($id, $this->mbr_status)) {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'mbr_status' => trim(preg_replace('/\s+/', ' ', strtoupper($this->mbr_status))),
            ];
            MemberStatusService::updateMemberStatusService($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('mbr_status', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        MemberStatusService::deleteMemberStatusService($id);
    }
    
    public function render()
    {
        $data = $this->memberstatus_Service->getMemStatusResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.member-status',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
