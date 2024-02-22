<?php

namespace App\Livewire\Teller\PaymentMember\Category;

use App\Action\StoredProcedure\SpFmsUpTrxSpecialAid;
use App\Livewire\Teller\General\MembersBankInfo;
use App\Models\Cif\CifCustomer;
use App\Services\General\ActgPeriod;
use App\Services\Model\BankService;
use App\Models\Fms\SpecialAid;
use App\Services\General\PopupService;
use App\Models\Ref\RefBank;
use App\Traits\SpecialAidRulesTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class TabungKhairat extends Component
{
    use Actions, SpecialAidRulesTrait;

    public $client_id;
    public $startDate;
    public $endDate;
    public $refBank;
    public $txnCode;

    // fetch from customer search component
    public $mbr_no;
    public $name;
    public $approved_amount;
    public $approved_date;
    public $identity_no;
    public $ic;
    public $descs;

    //input
    public $apply_id;
    public $bankMember;
    public $bank_acct_no;
    public $payment;
    public $txn_date;
    public $doc_no;
    public $bankClient;
    public $remarks;
    //public $saveButton;
    public $type;
    public $saveButton = false;


    public function mount(){
        $this->client_id = (int) auth()->user()->client_id;
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];
        $this->refBank = BankService::getAllRefBanks($this->client_id);
        $this->txnCode = '10005';
        $this->type = 1;
    }

    #[On('idSelected')]
    public function selectSpecialAid($apply_id){
        $selected_id = SpecialAid::selectraw("
            cif.customers.identity_no,
            fms.membership.mbr_no,
            cif.customers.name,
            FMS.SPECIAL_AID_REQ_HISTORY.approved_amount,
            FMS.SPECIAL_AID_REQ_HISTORY.approved_date,
            descs = fms.get_special_aid_name(cif.customers.client_id,FMS.SPECIAL_AID_REQ_HISTORY.special_aid_id),
            payment = (case when FMS.SPECIAL_AID_REQ_HISTORY.req_status = 0 then 'No Payment' else 'Payment' end),
            FMS.SPECIAL_AID_REQ_HISTORY.apply_id
        ")
        ->join('fms.membership','FMS.SPECIAL_AID_REQ_HISTORY.mbr_no','fms.membership.mbr_no')
        ->join('cif.customers','cif.customers.id','fms.membership.cif_id')
        ->where('FMS.SPECIAL_AID_REQ_HISTORY.req_status',0)
        ->where('FMS.SPECIAL_AID_REQ_HISTORY.client_id',$this->client_id)
        ->where('fms.membership.client_id',$this->client_id)
        ->where('cif.customers.client_id',$this->client_id)
        ->where('FMS.SPECIAL_AID_REQ_HISTORY.apply_id',$apply_id)
        ->first();

        
        $this->ic              = $selected_id->identity_no;
        $this->mbr_no          = $selected_id->mbr_no;
        $this->name            = $selected_id->name;
        $this->bankMember      = $selected_id->bank_id;
        $this->bank_acct_no    = $selected_id->bank_acct_no;
        $this->approved_amount = $selected_id->approved_amount;
        $this->approved_date   = $selected_id->approved_date;
        $this->descs           = $selected_id->descs;
        $this->payment         = $selected_id->payment;
        $this->apply_id        = $selected_id->apply_id;

        $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);
        $this->doc_no = 'N/A';
    }

    // function save bank and account no members
    #[On('updatePayButton')]
    public function updatePayButton($data)
    {
        $this->saveButton = $data['bankMember'] && $data['memberBankAccNo'];
    }

    public function saveTransaction()
    {
        $this->validate($this->getSpecialAidRules());
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $result = SpFmsUpTrxSpecialAid::handle([
            
            'clientId' => $this->client_id,
            'applyId' => $this->apply_id,
            'mbrNo' => $this->mbr_no,
            'txnAmt' => $this->approved_amount,
            'docNo' => $this->doc_no,
            'type' => $this->type,
            'txnDate' => $this->txn_date,
            'txnCode' => $this->txnCode,
            'remarks' => $this->remarks,
            'userId' => auth()->id(),
        ]);

        if (!$result) {
            $this->dialog()->error('Error!', 'Something went wrong.');
            return;
        }

        $message = (array) $result[0];
        $dialogType = $message["SP_RETURN_CODE"] == 0 ? 'success' : 'error';
        $messageText = $message["SP_RETURN_CODE"] == 0 ? 'Success!' : 'Error!';

        $this->dialog()->$dialogType($messageText, $message["SP_RETURN_MSG"]);

        $this->dispatch('clear')->to(MembersBankInfo::class);
        $this->reset('approved_amount', 'txn_date', 'remarks', 'doc_no');
        
        // $this->dispatch('refreshComponentMbrNo', mbr_no: $this->customer['mbr_no'])->to(CustomerSearch::class);
    } 

    public function render()
    {
        $this->client_id = auth()->user()->client_id;

        $this->refBank = RefBank::where('client_id',$this->client_id)->get();

        $apply_list = SpecialAid::selectraw("
            cif.customers.identity_no,
            fms.membership.mbr_no,
            cif.customers.name,
            FMS.SPECIAL_AID_REQ_HISTORY.approved_amount,
            FMS.SPECIAL_AID_REQ_HISTORY.approved_date,
            descs = fms.get_special_aid_name(cif.customers.client_id,FMS.SPECIAL_AID_REQ_HISTORY.special_aid_id),
            payment = (case when FMS.SPECIAL_AID_REQ_HISTORY.req_status = 0 then 'No Payment' else 'Payment' end),
            FMS.SPECIAL_AID_REQ_HISTORY.apply_id
        ")
        ->join('fms.membership','FMS.SPECIAL_AID_REQ_HISTORY.mbr_no','fms.membership.mbr_no')
        ->join('cif.customers','cif.customers.id','fms.membership.cif_id')
        ->where('FMS.SPECIAL_AID_REQ_HISTORY.req_status',0)
        ->where('FMS.SPECIAL_AID_REQ_HISTORY.client_id',$this->client_id)
        ->where('fms.membership.client_id',$this->client_id)
        ->where('cif.customers.client_id',$this->client_id)
        ->paginate(10);

        return view('livewire.teller.payment-member.category.tabung-khairat',[
            'apply_list' => $apply_list,
            'refBank' => $this->refBank,
        ]);
    }
}
