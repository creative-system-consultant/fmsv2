<?php

namespace App\Livewire\General\Teller;

use App\Action\StoredProcedure\SpFmsUpTrx3800FinancingPayment;
use App\Action\StoredProcedure\SpFmsUpTrxContributionIn;
use App\Action\StoredProcedure\SpFmsUpTrxPaymentAll;
use App\Livewire\General\CustomerSearch;
use App\Traits\PaymentContributionRulesTrait;
use App\Traits\BulkPaymentRulesTrait;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Services\Model\FmsGlobalParm;
use App\Traits\FinancingRepaymentRulesTrait;
use App\Traits\PurchaseShareRulesTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class CommonPage extends Component
{
    use Actions, PaymentContributionRulesTrait, PurchaseShareRulesTrait, FinancingRepaymentRulesTrait, BulkPaymentRulesTrait;

    public $module = '';
    public $category = false;
    public $categoryList = [];
    public $selectedType;
    public $txnCode;

    // search variable
    public $searchRefNo = false;
    public $searchTotContribution = false;
    public $searchTotShare = false;
    public $searchMthInstallAmt = false;
    public $searchInstallAmtArear = false;

    // mount variable
    public $startDate, $endDate, $refBank, $refBankIbt;
    public $minContribution;
    public $minShare;
    public $minFinRepay;

    // fetch variable
    public $refNo, $accNo, $totalContribution;
    public $saveButton = false;

    // input variable
    public $clientId = 1, $chequeDate, $bankMember, $bankClient, $docNo, $txnAmt, $txnDate, $remarks;

    public $additionalField = false;

    public function mount()
    {
        $this->refBank = BankService::getAllRefBanks();
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];

        $this->initializeModule();
    }

    private function initializeModule()
    {
        switch ($this->module) {
            case 'paymentContribution':
                $this->setupPaymentContribution();
                break;
            case 'purchaseShare':
                $this->setupPurchaseShare();
                break;
            case 'financingRepayment':
                $this->setupFinancingRepayment();
                break;
            case 'bulkPayment':
                $this->setupBulkPayment();
                break;
        }
    }

    private function setupPaymentContribution()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'cheque', 'code' => '4020', 'icon' => 'credit-card'],
            ['name' => 'cash/cdm', 'code' => '4030', 'icon' => 'cash'],
            ['name' => 'ibt/si', 'code' => '4040', 'icon' => 'cash'],
        ];
        $this->setDefaultCategory();
        $this->minContribution = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_CONTRIBUTION;
    }

    private function setupPurchaseShare()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'cheque', 'code' => '3020', 'icon' => 'credit-card'],
            ['name' => 'cash/cdm', 'code' => '3030', 'icon' => 'cash'],
            ['name' => 'ibt/si', 'code' => '3040', 'icon' => 'cash'],
        ];
        $this->setDefaultCategory();
        $this->minShare = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_SHARE;
    }

    private function setupFinancingRepayment()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'cheque', 'code' => '3810', 'icon' => 'credit-card'],
            ['name' => 'cash/cdm', 'code' => '3820', 'icon' => 'cash'],
            ['name' => 'ibt/si', 'code' => '3830', 'icon' => 'cash'],
            ['name' => 'contribution', 'code' => '3850', 'icon' => 'inbox-in'],
        ];
        $this->setDefaultCategory();
        $this->minFinRepay = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_FIN_REPAYMENT;
    }

    private function setupBulkPayment()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'cheque', 'code' => 1, 'icon' => 'credit-card'],
            ['name' => 'cash/cdm', 'code' => 2, 'icon' => 'cash'],
            ['name' => 'ibt/si', 'code' => 3, 'icon' => 'cash'],
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
    public function handleCustomerSelection($refNo, $bankMember)
    {
        $this->saveButton = true;
        $this->bankMember = $bankMember;
        $this->refNo = (string) $refNo;
    }

    #[On('accNoSelected')]
    public function handleAccNoSelection($bankMember, $accNo, $mthInstallAmtValue, $totalContribution)
    {
        $this->additionalField = true;
        $this->saveButton = true;

        $this->bankMember = $bankMember;
        $this->accNo = (string) $accNo;
        $this->txnAmt = (string) $mthInstallAmtValue;
        $this->totalContribution = $totalContribution;
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
        $rules = [];

        switch ($this->module) {
            case 'paymentContribution':
                $rules = $this->getPaymentContributionRules();
                break;
            case 'purchaseShare':
                $rules = $this->getPurchaseShareRules();
                break;
            case 'financingRepayment':
                $rules = $this->getFinancingRepayment();
                break;
            case 'bulkPayment':
                $rules = $this->getBulkPaymentRules();
                break;
        }

        $this->validate($rules);
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        if ($this->module == 'paymentContribution') {
            $result = SpFmsUpTrxContributionIn::handle([
                'clientId' => $this->clientId,
                'refNo' => $this->refNo,
                'txnAmt' => $this->txnAmt,
                'txnDate' => $this->txnDate,
                'docNo' => $this->docNo,
                'txnCode' => $this->txnCode,
                'remarks' => $this->remarks,
                'bankMember' => $this->bankMember,
                'userId' => auth()->id(),
                'chequeDate' => $this->chequeDate,
                'bankClient' => $this->bankClient
            ]);
        }

        if ($this->module == 'purchaseShare') {
            $result = SpFmsUpTrxContributionIn::handle([
                'clientId' => $this->clientId,
                'refNo' => $this->refNo,
                'txnAmt' => $this->txnAmt,
                'txnDate' => $this->txnDate,
                'docNo' => $this->docNo,
                'txnCode' => $this->txnCode,
                'remarks' => $this->remarks,
                'bankMember' => $this->bankMember,
                'userId' => auth()->id(),
                'chequeDate' => $this->chequeDate,
                'bankClient' => $this->bankClient
            ]);
        }

        if ($this->module == 'financingRepayment') {
            $result = SpFmsUpTrx3800FinancingPayment::handle([
                'clientId' => $this->clientId,
                'accNo' => $this->accNo,
                'txnAmt' => $this->txnAmt,
                'txnCode' => $this->txnCode,
                'docNo' => $this->docNo,
                'txnDate' => $this->txnDate,
                'remarks' => $this->remarks,
                'bankClient' => $this->bankClient,
                'userId' => auth()->id()
            ]);
        }

        if ($this->module == 'bulkPayment') {
            $result = SpFmsUpTrxPaymentAll::handle([
                'clientId' => $this->clientId,
                'refNo' => $this->refNo,
                'txnAmt' => $this->txnAmt,
                'txnDate' => $this->txnDate,
                'docNo' => $this->docNo,
                'txnCode' => $this->txnCode,
                'remarks' => $this->remarks,
                'bankMember' => $this->bankMember,
                'userId' => auth()->id(),
                'chequeDate' => $this->chequeDate
            ]);
        }

        $result
            ? $this->dialog()->success('Success!', 'The transaction has been recorded.')
            : $this->dialog()->error('Error!', 'Something went wrong.');

        if ($this->module == 'financingRepayment') {
            $this->dispatch('refreshComponentAccNo', accNo: $this->accNo)->to(CustomerSearch::class);
        } else {
            $this->dispatch('refreshComponent', uuid: $this->customer['uuid'])->to(CustomerSearch::class);
        }

        //need to reset input field after done
        // $this->resetFields();
    }

    public function render()
    {
        return view('livewire.general.teller.common-page');
    }
}
