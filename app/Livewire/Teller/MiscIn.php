<?php

namespace App\Livewire\Teller;

use App\Action\StoredProcedure\SpFmsUpTrxMiscInBk;
use App\Livewire\General\CustomerSearch;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Services\Model\FmsGlobalParm;
use App\Traits\MiscellaneousInRulesTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class MiscIn extends Component
{
    use Actions, MiscellaneousInRulesTrait;

    public $clientId;
    public $startDate;
    public $endDate;
    public $refBank;
    public $refBankIbt;
    public $minContribution;
    public $categoryList = [];
    public $selectedType;
    public $txnCode;
    public $saveButton = false;

    // fetch from customer search component
    public $customer;
    public $mbrNo;

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
        $this->clientId = auth()->user()->client_id;
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];
        $this->refBank = BankService::getAllRefBanks();
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
        $this->docNo = "N/A";
        $this->minContribution = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_CONTRIBUTION;

        $this->categoryList = [
            ['name' => 'cheque', 'code' => '2110', 'icon' => 'credit-card'],
            ['name' => 'cash/cdm', 'code' => '2110', 'icon' => 'cash'],
            ['name' => 'ibt/si', 'code' => '2110', 'icon' => 'cash'],
        ];

        $this->setDefaultCategory();
    }

    private function setDefaultCategory()
    {
        if (!empty($this->categoryList)) {
            $this->selectedType = $this->categoryList[0]['name'];
            $this->txnCode = $this->categoryList[0]['code'];
        }
    }

    #[On('customerSelected')]
    public function handleCustomerSelection($customer)
    {
        // $this->loading = true;
        $this->customer = $customer;
        $this->bankMember = $customer['bank_id'];
        $this->mbrNo = (string) $customer['mbr_no'];
        $this->saveButton = true;
        // $this->dispatch('endProcessing');
    }

    public function selectType($name, $code)
    {
        $this->selectedType = $name;
        $this->txnCode = $code;
        // $this->reset();  need to reset input field when change type
        $this->resetValidation();
    }

    public function saveTransaction()
    {
        $this->validate($this->getMiscellaneousIn());
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $result = SpFmsUpTrxMiscInBk::handle([
            'clientId' => $this->clientId,
            'mbrNo' => $this->mbrNo,
            'txnAmt' => $this->txnAmt,
            'txnDate' => $this->txnDate,
            'txnCode' => $this->txnCode,
            'remarks' => $this->remarks,
            'userId' => auth()->id(),
            'thirdPartyCode' => NULL,
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

        $this->reset('chequeDate', 'txnAmt', 'txnDate');
        $this->dispatch('refreshComponent', uuid: $this->customer['uuid'])->to(CustomerSearch::class);
    }

    public function render()
    {
        return view('livewire.teller.misc-in');
    }
}
