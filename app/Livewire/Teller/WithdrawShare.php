<?php

namespace App\Livewire\Teller;

use App\Action\StoredProcedure\SpFmsGenerateMbrWithdrawShare;
use App\Action\StoredProcedure\SpFmsUpTrxContributionIn;
use App\Livewire\General\CustomerSearch;
use App\Livewire\Teller\General\MembersBankInfo;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Services\Model\FmsGlobalParm;
use App\Traits\WithdrawShareRulesTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class WithdrawShare extends Component
{
    use Actions, WithdrawShareRulesTrait;

    public $clientId;
    public $startDate;
    public $endDate;
    public $refBank;
    public $refBankIbt;
    public $minShare;
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
        $this->minShare = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_SHARE;
        $this->txnCode = '3104';
    }

    #[On('mbrSelected')]
    public function handleCustomerSelection($customer)
    {
        $this->customer = $customer;
        $this->bankMember = $customer['bank_id'];
        $this->mbrNo = (string) $customer['mbr_no'];
        $this->totalShareValid = $customer['total_share'] - $this->minShare;
        $this->txnAmt = $this->totalShareValid;
        $this->saveButton = $this->bankMember && $customer['bank_acct_no'];

        $this->ic = $customer['identity_no'];
        $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);
        $this->docNo = 'N/A';
    }

    #[On('updatePayButton')]
    public function updatePayButton($data)
    {
        $this->saveButton = $data['bankMember'] && $data['memberBankAccNo'];
    }

    public function saveTransaction()
    {
        $this->validate($this->getWithdrawShareRules());
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $result = SpFmsUpTrxContributionIn::handle([
            'clientId' => $this->clientId,
            'mbrNo' => $this->mbrNo,
            'txnAmt' => $this->txnAmt,
            'txnDate' => $this->txnDate,
            'docNo' => $this->docNo,
            'txnCode' => $this->txnCode,
            'remarks' => $this->remarks,
            'bankMember' => $this->bankMember,
            'userId' => auth()->id(),
            'chequeDate' => $this->chequeDate,
            'bankClient' => $this->bankClient,
        ]);

        if (!$result) {
            $this->dialog()->error('Error!', 'Something went wrong.');
            return;
        }

        $message = (array) $result[0];
        $dialogType = $message["SP_RETURN_CODE"] == 0 ? 'success' : 'error';
        $messageText = $message["SP_RETURN_CODE"] == 0 ? 'Success!' : 'Error!';

        $this->dialog()->$dialogType($messageText, $message["SP_RETURN_MSG"]);

        $this->reset('chequeDate', 'txnAmt', 'txnDate');
        $this->dispatch('refreshComponent', uuid: $this->customer['uuid'])->to(CustomerSearch::class);
    }

    public function render()
    {
        return view('livewire.teller.withdraw-share');
    }
}
