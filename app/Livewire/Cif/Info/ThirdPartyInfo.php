<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsThirdPartyList;
use App\Models\Fms\FmsThirdPartyStatement;
use App\Models\Fms\Membership;
use App\Models\Ref\RefThirdParty;
use Livewire\Component;
use Livewire\WithPagination;

class ThirdPartyInfo extends Component
{
    use WithPagination;
    public $customer, $uuid, $ThirdPartyStatement, $priority, $status, $transaction_amt, $status_effective_dt, $RefThirdParty,
        $mode, $institution_code, $expiry_dt, $MembershipInfo, $ThirdPartys, $clientID;

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
        $this->customer = CifCustomer::where('uuid', $this->uuid)->first();
        $this->MembershipInfo = Membership::where('cif_id', $this->customer->id)->first();
        $this->clientID = auth()->user()->client_id;

        $this->ThirdPartyStatement      = [];
    }

    public function statement($id)
    {
        $this->ThirdPartyStatement = FmsThirdPartyStatement::with('detail')
            ->where('mbr_id', $this->MembershipInfo->mbr_no)
            ->where('id_thirdparty', $id)
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

    public function createThirdParty()
    {

        $this->validate([
            'transaction_amt'     => 'required',
            'priority'            => 'required',
            'status_effective_dt' => 'required',
        ]);

        $this->dispatchBrowserEvent('thirdparty-create');

        // Insert into db
        FmsThirdPartyList::create([
            'mbr_no' => $this->MembershipInfo->mbr_no,
            'mode' => $this->mode,
            'institution_code' => $this->institution_code,
            'transaction_amt' => $this->transaction_amt,
            'status'  => 1, //$this->status,
            'priority'  => $this->priority,
            'status_effective_dt' => $this->status_effective_dt,
            'expiry_dt' => $this->expiry_dt,
        ]);

        // $this->dispatchBrowserEvent('swal',[
        //     'title' => 'Success!',
        //     'text'  => 'The transaction have been recorded.',
        //     'icon'  => 'success',
        //     'showConfirmButton' => false,
        //     'timer' => 1500,
        // ]);

        $this->institution_code = null;
        $this->transaction_amt = null;
        $this->priority = null;
        $this->transaction_amt = null;
        $this->status_effective_dt = null;

        // return redirect()->to('/cif/individual/'.$this->customer->uuid);
    }

    public function updateThirdParty($id)
    {
        // update db
        FmsThirdPartyList::where('id', $id)->update([
            'priority'         => $this->priority,
            'mode'             => $this->mode,
            'status'           => $this->status,
            'transaction_amt'  => $this->transaction_amt,
            'status_effective_dt' => $this->status_effective_dt
        ]);

        // $this->dispatchBrowserEvent('swal',[
        //     'title' => 'Success!',
        //     'text'  => 'Update Success.',
        //     'icon'  => 'success',
        //     'showConfirmButton' => false,
        //     'timer' => 1500,
        // ]);

        // return redirect()->to('/cif/individual/'.$this->customer->uuid);
    }

    public function deleteThirdParty($id)
    {
        FmsThirdPartyList::where('id', $id)->delete();

        // $this->dispatchBrowserEvent('swal',[
        //     'title' => 'Success!',
        //     'text'  => 'Delete Success.',
        //     'icon'  => 'success',
        //     'showConfirmButton' => false,
        //     'timer' => 1500,
        // ]);

        // return redirect()->to('/cif/individual/'.$this->customer->uuid);
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
        $this->ThirdPartys = FmsThirdPartyList::where('mbr_no', $this->MembershipInfo->mbr_no)->where('client_id', $this->clientID)->orderby('status', 'asc')->orderby('priority', 'asc')->get();
        // dd($this->ThirdPartys);
        if ($this->ThirdPartys == null) {
            $this->ThirdPartys = new FmsThirdPartyList;
        }
        return view('livewire.cif.info.third-party-info', [
            'ThirdPartys' => $this->ThirdPartys,
            'ThirdPartyStatement' => $this->ThirdPartyStatement,
        ])->extends('layouts.main');
    }
}
