<?php

namespace App\Livewire\Teller\PaymentMember\Category;

use App\Models\Fms\SpecialAid;
use App\Models\Ref\RefBank;
use Livewire\Component;

class TabungKhairat extends Component
{
    public $client_id,$refBank;
    public $identity_no,$mbr_no,$name,$approved_amount,$appoved_date,$descs,$payment,$apply_id;
    public $txn_date,$doc_no,$bankMember,$bank_acct_no,$bankClient,$remarks;

    public function mount(){
    }

    public function selectSpecialAid($apply_id){
        $selected_id = SpecialAid::selectraw("
            cif.customers.identity_no,
            fms.membership.mbr_no,
            cif.customers.name,
            fms.SPECIAL_AID.approved_amount,
            fms.SPECIAL_AID.appoved_date,
            descs = fms.get_special_aid_name(cif.customers.client_id,fms.SPECIAL_AID.special_aid_id),
            payment = (case when fms.SPECIAL_AID.req_status = 0 then 'No Payment' else 'Payment' end),
            fms.SPECIAL_AID.apply_id
        ")
        ->join('fms.membership','fms.SPECIAL_AID.mbr_no','fms.membership.mbr_no')
        ->join('cif.customers','cif.customers.id','fms.membership.cif_id')
        ->where('fms.SPECIAL_AID.client_id',$this->client_id)
        ->where('fms.membership.client_id',$this->client_id)
        ->where('cif.customers.client_id',$this->client_id)
        ->where('fms.SPECIAL_AID.apply_id',$apply_id)
        ->first();

        $this->identity_no     = $selected_id->identity_no;
        $this->mbr_no          = $selected_id->mbr_no;
        $this->name            = $selected_id->name;
        $this->approved_amount = $selected_id->approved_amount;
        $this->appoved_date    = $selected_id->appoved_date;
        $this->descs           = $selected_id->descs;
        $this->payment         = $selected_id->payment;
        $this->apply_id        = $selected_id->apply_id;
    }

    public function postTransaction(){
        $sp = 'Tunggu SP Hehe';
        dd($this->apply_id,$this->identity_no,$this->mbr_no,$this->approved_amount,$this->txn_date,$this->doc_no,$this->bankMember,$this->bank_acct_no,$this->bankClient,$this->remarks,$sp);
    }

    public function render()
    {
        $this->client_id = auth()->user()->client_id;

        $this->refBank = RefBank::where('client_id',$this->client_id)->get();

        $apply_list = SpecialAid::selectraw("
            cif.customers.identity_no,
            fms.membership.mbr_no,
            cif.customers.name,
            fms.SPECIAL_AID.approved_amount,
            fms.SPECIAL_AID.appoved_date,
            descs = fms.get_special_aid_name(cif.customers.client_id,fms.SPECIAL_AID.special_aid_id),
            payment = (case when fms.SPECIAL_AID.req_status = 0 then 'No Payment' else 'Payment' end),
            fms.SPECIAL_AID.apply_id
        ")
        ->join('fms.membership','fms.SPECIAL_AID.mbr_no','fms.membership.mbr_no')
        ->join('cif.customers','cif.customers.id','fms.membership.cif_id')
        ->where('fms.SPECIAL_AID.client_id',$this->client_id)
        ->where('fms.membership.client_id',$this->client_id)
        ->where('cif.customers.client_id',$this->client_id)
        ->paginate(10);

        return view('livewire.teller.payment-member.category.tabung-khairat',[
            'apply_list' => $apply_list,
            'refBank' => $this->refBank,
        ]);
    }
}
