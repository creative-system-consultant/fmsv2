<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsThirdPartyList;
use App\Models\Fms\FmsThirdPartyStatement;
use App\Models\Fms\Membership;
use App\Models\Ref\RefThirdParty;
use App\Services\General\PopupService;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ThirdPartyInfo extends Component
{
    use Actions, WithPagination;
    public $customer, $uuid, $ThirdPartyStatement, $priority, $status, $transaction_amt, $status_effective_dt, $RefThirdParty, $mode, $institution_code, $expiry_dt, $remarks, $MembershipInfo, $ThirdPartys, $clientID;
    public $thirdPartyId, $startDate, $endDate;
    public $thirdPartyModal, $thirdPartyModalStatement, $modalTitle = 'Create', $modalSubmit;

    protected $rules = [
        'transaction_amt'                       => 'required',
        'priority'                              => 'required',
        'status_effective_dt'                   => 'required',
    ];

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function mount()
    {
        $clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $clientID)->first();
        $this->MembershipInfo = Membership::where('cif_id', $this->customer->id)->first();
        $this->clientID = auth()->user()->client_id;
        $this->ThirdPartyStatement      = [];

        $this->startDate = now()->subYear()->format('Y-m-d');
        $this->endDate = now()->format('Y-m-d');
    }

    public function updatedStartDate()
    {
        $this->getStatementData();
    }

    public function updatedEndDate()
    {
        $this->getStatementData();
    }

    public function statement($id)
    {
        $this->thirdPartyId = $id;
        $this->getStatementData();
        $this->thirdPartyModalStatement = true;
    }

    public function getStatementData()
    {
        $this->ThirdPartyStatement = FmsThirdPartyStatement::with('detail', 'creator')
            ->where('mbr_no', $this->MembershipInfo->mbr_no)
            ->where('id_thirdparty', $this->thirdPartyId)
            ->whereBetween('transaction_date', [$this->startDate, $this->endDate])
            ->orderby('id')->get();
    }

    public function resetThirdParty()
    {
        $this->institution_code = null;
        $this->transaction_amt = null;
        $this->priority = null;
        $this->transaction_amt = null;
        $this->status_effective_dt = null;
    }

    public function openCreateThirdPartyModal()
    {
        $this->modalTitle = 'Create';
        $this->modalSubmit = 'createThirdParty';
        $this->thirdPartyModal = true;
    }

    public function createThirdParty()
    {
        $this->validate([
            'transaction_amt'     => 'required',
            'priority'            => 'required',
            'status_effective_dt' => 'required',
        ]);

        $this->thirdPartyModal = false;

        // Insert into db
        FmsThirdPartyList::create([
            'client_id' =>  $this->clientID,
            'mbr_no' => $this->MembershipInfo->mbr_no,
            'mode' => $this->mode,
            'institution_code' => $this->institution_code,
            'transaction_amt' => $this->transaction_amt,
            'status'  => 1, //$this->status,
            'priority'  => $this->priority,
            'status_effective_dt' => $this->status_effective_dt,
            'expiry_dt' => $this->expiry_dt,
            'remarks' => $this->remarks
        ]);

        $this->reset('institution_code', 'transaction_amt', 'priority', 'transaction_amt', 'status_effective_dt', 'remarks');
    }

    public function openUpdateThirdPartyModal($id)
    {
        $this->modalTitle = 'Update';
        $this->modalSubmit = 'updateThirdParty('.$id.')';
        $data = FmsThirdPartyList::find($id);
        $this->mode = $data->mode;
        $this->institution_code = $data->institution_code;
        $this->transaction_amt = $data->transaction_amt;
        $this->priority = $data->priority;
        $this->status_effective_dt = Carbon::parse($data->status_effective_dt)->format('Y-m-d');
        $this->expiry_dt = $data->expiry_dt;
        $this->remarks = $data->remarks;
        $this->status = $data->status;
        $this->thirdPartyModal = true;
    }

    public function updateThirdParty($id)
    {
        $this->validate([
            'transaction_amt'     => 'required',
            'priority'            => 'required',
            'status_effective_dt' => 'required',
        ]);

        // update db
        FmsThirdPartyList::where('id', $id)->update([
            'priority'         => $this->priority,
            'mode'             => $this->mode,
            'status'           => $this->status,
            'transaction_amt'  => $this->transaction_amt,
            'status_effective_dt' => $this->status_effective_dt,
            'remarks' => $this->remarks,
            'status' => $this->status
        ]);

        $this->thirdPartyModal = false;
        $this->reset('institution_code', 'transaction_amt', 'priority', 'transaction_amt', 'status_effective_dt', 'remarks');
    }

    public function delete($id)
    {
        PopupService::confirm($this, 'deleteThirdParty', 'Delete Third Party?', 'Are you sure to proceed?', $id);
    }

    public function deleteThirdParty($id)
    {
        FmsThirdPartyList::where('id', $id)->delete();
    }

    public function showThirdParty($id)
    {
        $priority_id = FmsThirdPartyList::where('id', $id)->first();
        $this->priority  = $priority_id->priority;
        $this->status    = $priority_id->status;
        $this->transaction_amt  = $priority_id->transaction_amt;
        $this->status_effective_dt  = date('Y-m-d', strtotime($priority_id->status_effective_dt));
    }

    public function render()
    {
        $this->RefThirdParty = RefThirdParty::all();

        if ($this->RefThirdParty == null) {
            $this->RefThirdParty = new RefThirdParty;
        }

        $this->ThirdPartys = FmsThirdPartyList::where('mbr_no', $this->MembershipInfo->mbr_no)
                                                ->where('client_id', $this->clientID)
                                                ->orderby('status', 'asc')
                                                ->orderby('priority', 'asc')
                                                ->get();

        if ($this->ThirdPartys == null) {
            $this->ThirdPartys = new FmsThirdPartyList;
        }

        return view('livewire.cif.info.third-party-info', [
            'ThirdPartys' => $this->ThirdPartys,
            'ThirdPartyStatement' => $this->ThirdPartyStatement,
        ])->extends('layouts.main');
    }
}
