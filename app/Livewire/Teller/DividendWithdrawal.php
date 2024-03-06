<?php

namespace App\Livewire\Teller;

use App\Action\StoredProcedure\SpFmsTrxDividendOut;
use App\Livewire\General\CustomerSearch;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Services\Model\FmsGlobalParm;
use App\Services\Module\General\CustomerSearch as GeneralCustomerSearch;
use App\Traits\DividendWithdrawalRulesTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class DividendWithdrawal extends Component
{
    use Actions, DividendWithdrawalRulesTrait, WithPagination;

    public $tabIndex = 1;
    public $searchBy = 'CIF.CUSTOMERS.name', $search;
    public $name;
    public $searchMbrNoValue;
    public $searchBalDividenValue;

    public $clientId;
    public $startDate;
    public $endDate;
    public $refBank;
    public $refBankIbt;
    public $minWithdrawDiv;
    public $categoryList = [];
    public $selectedType;
    public $txnCode;
    public $saveButton = false;

    // fetch from customer search component
    public $customer;
    public $mbrNo;
    public $balDividen;

    // input
    public $chequeDate;
    public $bankMember;
    public $bankClient;
    public $docNo;
    public $txnAmt;
    public $txnDate;
    public $remarks;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];
        $this->refBank = BankService::getAllRefBanks($this->clientId);
        $this->refBankIbt = BankIbtService::getAllRefBankIbts($this->clientId);
        $this->docNo = "N/A";
        $this->minWithdrawDiv = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_WITHDRAW_DIV;

        $this->categoryList = [
            ['name' => 'ibt/si', 'code' => '7204', 'icon' => 'cash'],
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectedMbrSiskop($mbrNo)
    {
        $customer = GeneralCustomerSearch::getDividendWithdrawalSiskopData($this->clientId, $mbrNo);

        $this->name = $customer->name;
        $this->searchMbrNoValue = $customer->mbr_no;
        $this->searchBalDividenValue = number_format($customer->dividend_total, 2) ?? 0;

        $this->customer = $customer;
        $this->mbrNo = (string) $customer->mbr_no;
        $this->docNo = "N/A";
        $this->balDividen = $customer->dividend_total;
        $this->txnAmt = $customer->div_cash_approved;
        $this->saveButton = true;
    }

    public function selectedMbr($mbrNo)
    {
        $customer = GeneralCustomerSearch::getDividendWithdrawalData($this->clientId, $mbrNo);

        $this->name = $customer->name;
        $this->searchMbrNoValue = $customer->mbr_no;
        $this->searchBalDividenValue = number_format($customer->bal_dividen, 2) ?? 0;

        $this->customer = $customer;
        $this->mbrNo = (string) $customer->mbr_no;
        $this->docNo = "N/A";
        $this->balDividen = $customer->bal_dividen;
        $this->txnAmt = $customer->bal_dividen;
        $this->saveButton = true;
    }

    public function selectType($name, $code)
    {
        $this->selectedType = $name;
        $this->txnCode = $code;
        $this->resetValidation();
    }

    public function saveTransaction()
    {
        $this->validate($this->getDividendWithdrawalRules());
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $result = SpFmsTrxDividendOut::handle([
            'clientId' => $this->clientId,
            'mbrNo' => $this->mbrNo,
            'txnAmt' => $this->txnAmt,
            'txnDate' => $this->txnDate,
            'txnCode' => $this->txnCode,
            'remarks' => $this->remarks,
            'userId' => auth()->id(),
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
        $this->reset('name', 'searchMbrNoValue', 'searchBalDividenValue', 'customer', 'mbrNo', 'docNo', 'balDividen', 'chequeDate', 'bankMember', 'bankClient', 'docNo', 'txnAmt', 'txnDate', 'remarks');
        $this->docNo = 'N/A';
        $this->saveButton = false;
        $this->dispatch('refresh')->self();
    }

    public function render()
    {
        $siskopDatas = GeneralCustomerSearch::getAllDividendWithdrawalSiskop($this->clientId, $this->searchBy, $this->search);
        $fmsDatas = GeneralCustomerSearch::getAllDividendWithdrawal($this->clientId, $this->searchBy, $this->search);

        return view('livewire.teller.dividend-withdrawal', [
            'siskopDatas' => $siskopDatas,
            'fmsDatas' => $fmsDatas
        ]);
    }
}
