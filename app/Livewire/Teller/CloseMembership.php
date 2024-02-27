<?php

namespace App\Livewire\Teller;

use App\Action\StoredProcedure\SpFmsGenerateMbrClosedMembers;
use App\Action\StoredProcedure\SpFmsUpTrxRetirementProcess;
use App\Livewire\General\CustomerSearch;
use App\Livewire\Teller\General\MembersBankInfo;
use App\Models\Fms\FmsMembership;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Traits\CloseMembershipRulesTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class CloseMembership extends Component
{
    use Actions, CloseMembershipRulesTrait;

    public $clientId;
    public $startDate;
    public $endDate;
    public $refBank;
    public $refBankIbt;
    public $idMsg;
    public $categoryList = [];
    public $selectedType;
    public $txnCode;
    public $saveButton = false;

    // fetch from customer search component
    public $customer;
    public $mbrNo;
    public $accId;
    public $totalShareValid;
    public $ic;

    // input
    public $chequeDate;
    public $bankMember;
    public $bankClient;
    public $docNo;
    public $txnAmt;
    public $txnDate;
    public $remarks;

    public function mount()
    {
        $this->clientId = (int) auth()->user()->client_id;
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];
        $this->refBank = BankService::getAllRefBanks($this->clientId);
        $this->refBankIbt = BankIbtService::getAllRefBankIbts($this->clientId);
        $this->txnCode = '3101';
    }

    #[On('customerSelected')]
    public function handleCustomerSelection($customer)
    {
        // $this->loading = true;
        $this->customer = $customer;
        $this->bankMember = $customer['bank_id'];
        $this->mbrNo = (string) $customer['mbr_no'];
        $this->txnAmt = $customer['total_contribution'] + $customer['total_share'] + $customer['misc_amt'] + $customer['bal_dividen'] + $customer['advance_payment'];
        $this->saveButton = $this->bankMember && $customer['bank_acct_no'];
        $this->ic = $customer['identity_no'];
        $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);

        //generate pv no
        // SpFmsGenerateMbrClosedMembers::handle(1, $this->mbrNo);
        // $this->docNo = FmsMembership::where('mbr_no', $this->mbrNo)->first()->closed_mbr_pv;
        $this->docNo = 'N/A';
    }

    #[On('updatePayButton')]
    public function updatePayButton($data)
    {
        $this->saveButton = $data['bankMember'] && $data['memberBankAccNo'];
    }

    public function saveTransaction()
    {
        $this->validate($this->getCloseMembershipRules());
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $result = SpFmsUpTrxRetirementProcess::handle([
            'clientId' => $this->clientId,
            'mbrNo' => $this->mbrNo,
            'txnAmt' => $this->txnAmt,
            'txnDate' => $this->txnDate,
            'docNo' => $this->docNo,
            'remarks' => $this->remarks,
            'userId' => auth()->id(),
            'bankClient' => $this->bankClient
        ]);

        if (!$result) {
            $this->dialog()->error('Error!', 'Something went wrong.');
            return;
        }

        $message = (array) $result[0];
        $dialogType = $message["SP_RETURN_CODE"] == 0 ? 'success' : 'error';
        $messageText = $message["SP_RETURN_CODE"] == 0 ? 'Success!' : 'Error!';

        $this->dialog()->$dialogType($messageText, $message["SP_RETURN_MSG"]);
        $this->reset('chequeDate', 'bankMember', 'bankClient', 'docNo', 'txnAmt', 'txnDate', 'remarks');
        $this->dispatch('refreshComponent', uuid: $this->customer['uuid'])->to(CustomerSearch::class);
    }

    public function render()
    {
        return view('livewire.teller.close-membership');
    }
}
