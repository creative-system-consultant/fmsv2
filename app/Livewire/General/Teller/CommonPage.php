<?php

namespace App\Livewire\General\Teller;

use App\Action\StoredProcedure\SpFmsGenerateMbrWithdrawShare;
use App\Action\StoredProcedure\SpFmsUpTrx3800FinancingPayment;
use App\Action\StoredProcedure\SpFmsUpTrx3920EarlySettlement;
use App\Action\StoredProcedure\SpFmsUpTrxContributionIn;
use App\Action\StoredProcedure\SpFmsUpTrxMiscInBk;
use App\Action\StoredProcedure\SpFmsUpTrxPaymentAll;
use App\Action\StoredProcedure\SpFmsUpTrxPreSettlemtPostn;
use App\Livewire\General\CustomerSearch;
use App\Livewire\Teller\General\MembersBankInfo;
use App\Models\Systm\SysMsgSp;
use App\Traits\PaymentContributionRulesTrait;
use App\Traits\BulkPaymentRulesTrait;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Services\Model\FmsGlobalParm;
use App\Traits\EarlySettlementPaymentTrait;
use App\Traits\FinancingRepaymentRulesTrait;
use App\Traits\MiscellaneousInRulesTrait;
use App\Traits\PurchaseShareRulesTrait;
use App\Traits\WithdrawShareRulesTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class CommonPage extends Component
{
    use Actions,
        // payment in
        PaymentContributionRulesTrait, PurchaseShareRulesTrait, FinancingRepaymentRulesTrait, EarlySettlementPaymentTrait, MiscellaneousInRulesTrait, BulkPaymentRulesTrait,
        // payment out
        WithdrawShareRulesTrait;

    public $module = '';
    public $category = false;
    public $categoryList = [];
    public $selectedType;
    public $txnCode;
    public $tellerOutModule = [];

    // search variable
    public $searchMbrNo = false;
    public $searchStaffNo = false;
    public $searchAccNo = false;
    public $searchTotContribution = false;
    public $searchTotShare = false;
    public $searchMthInstallAmt = false;
    public $searchInstallAmtArear = false;
    public $searchBalOutstanding = false;
    public $searchRebate = false;
    public $searchSettleProfit = false;

    // mount variable
    public $startDate, $endDate, $refBank, $refBankIbt;
    public $minContribution;
    public $minShare;
    public $minFinRepay;
    public $totalShareValid;

    // fetch variable
    public $customer, $ic, $mbrNo, $accId, $accNo, $totalContribution, $idMsg;
    public $saveButton = false;

    // input variable
    public $clientId, $chequeDate, $bankMember, $bankClient, $docNo, $txnAmt, $txnDate, $remarks;

    public $additionalField = false;

    // public $loading = false;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
        $this->refBank = BankService::getAllRefBanks();
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];

        $this->tellerOutModule = [
            "withdrawContribution",
            "withdrawShare",
            "closeMembership",
            "paymentToMembers",
            "dividendWithdrawal",
            "disbursement",
            "miscellaneousOut",
            "refundAdvance",
            "dividenBatchWidthdrawal",
        ];

        $this->initializeModule();
    }

    private function initializeModule()
    {
        switch ($this->module) {
            // payment in
            case 'paymentContribution':
                $this->setupPaymentContribution();
                break;
            case 'purchaseShare':
                $this->setupPurchaseShare();
                break;
            case 'financingRepayment':
                $this->setupFinancingRepayment();
                break;
            case 'earlySettlementRepayment':
                $this->setupEarlySettlementRepayment();
                break;
            case 'miscellaneousIn':
                $this->setupMiscellaneousIn();
                break;
            case 'bulkPayment':
                $this->setupBulkPayment();
                break;
            // payment out
            case 'withdrawShare':
                $this->setupWithdrawShare();
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

    private function setupEarlySettlementRepayment()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'cheque', 'code' => '3921', 'icon' => 'credit-card'],
            ['name' => 'cash/cdm', 'code' => '3922', 'icon' => 'cash'],
            ['name' => 'ibt/si', 'code' => '3923', 'icon' => 'cash'],
        ];
        $this->setDefaultCategory();
    }

    private function setupMiscellaneousIn()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'cheque', 'code' => '2110', 'icon' => 'credit-card'],
            ['name' => 'cash/cdm', 'code' => '2110', 'icon' => 'cash'],
            ['name' => 'ibt/si', 'code' => '2110', 'icon' => 'cash'],
        ];
        $this->setDefaultCategory();
        $this->minContribution = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_CONTRIBUTION;
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

    private function setupWithdrawShare()
    {
        $this->minShare = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_SHARE;
        $this->txnCode = '3104';
    }

    private function setDefaultCategory()
    {
        if (!empty($this->categoryList)) {
            $this->selectedType = $this->categoryList[0]['name'];
            $this->txnCode = $this->categoryList[0]['code'];
        }
    }

    public function getCustomQueryProperty()
    {
        switch ($this->module) {
            case 'financingRepayment':
                return 'financingRepayment';
            case 'earlySettlementRepayment':
                return 'earlySettlementRepayment';
            case 'withdrawShare':
                return 'withdrawShare';
            default:
                return '';
        }
    }

    #[On('customerSelected')]
    public function handleCustomerSelection($customer)
    {
        // $this->loading = true;
        $this->customer = $customer;
        $this->bankMember = $customer['bank_id'];
        $this->mbrNo = (string) $customer['fms_membership']['mbr_no'];

        if($this->module == 'withdrawShare')
        {
            $this->totalShareValid = $customer['fms_membership']['total_share'] - $this->minShare;
            $this->txnAmt = $this->totalShareValid;
            $this->saveButton = $this->bankMember && $customer['bank_acct_no'];

            $this->ic = $customer['identity_no'];
            $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);
            $this->docNo = SpFmsGenerateMbrWithdrawShare::handle(1, $this->mbrNo);

        } elseif($this->module == 'earlySettlementRepayment') {
            $this->idMsg = mt_rand(100000000, 999999999);
            $this->accNo = $customer['fmsMembership']['fmsAccountMaster']['acaccount_no'];
            $this->accId = $customer['fmsMembership']['fmsAccountMaster']['id'];

        } else {
            $this->saveButton = true;
        }
        // $this->dispatch('endProcessing');
    }

    #[On('accNoSelected')]
    public function handleAccNoSelection($bankMember, $accNo, $mthInstallAmtValue, $totalContribution)
    {
        $this->additionalField = true;
        $this->saveButton = true;

        $this->bankMember = $bankMember;
        $this->accNo = (string) $accNo;
        $this->txnAmt = $mthInstallAmtValue;
        $this->totalContribution = $totalContribution;
    }

    #[On('updatePayButton')]
    public function updatePayButton($data)
    {
        $this->saveButton = $data['bankMember'] && $data['memberBankAccNo'];
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
            // payment in
            case 'paymentContribution':
                $rules = $this->getPaymentContributionRules();
                break;
            case 'purchaseShare':
                $rules = $this->getPurchaseShareRules();
                break;
            case 'financingRepayment':
                $rules = $this->getFinancingRepayment();
                break;
            case 'earlySettlementRepayment':
                $rules = $this->getEarlySettlementRepayment();
                break;
            case 'miscellaneousIn':
                $rules = $this->getMiscellaneousIn();
                break;
            case 'bulkPayment':
                $rules = $this->getBulkPaymentRules();
                break;
            // payment out
            case 'withdrawShare':
                $rules = $this->getWithdrawShareRules();
                break;
        }

        $this->validate($rules);
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        // payment in
        if ($this->module == 'paymentContribution' || $this->module == 'purchaseShare' || $this->module == 'withdrawShare') {
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

        if ($this->module == 'earlySettlementRepayment') {
            // pre Settlement
            SpFmsUpTrxPreSettlemtPostn::handle([
                'clientId' => $this->clientId,
                'accNo' => $this->accNo,
                'userId' => auth()->id(),
                'msgId' => $this->idMsg,
                'accId' => $this->accId,
            ]);

            $checkPreSettlement = SysMsgSp::select('MSG_ID', 'PROCESS_STATUS', 'MSG_TEXT')
                ->where('sp_name', 'up_trx_pre_settlemt_postn')
                ->where('MSG_ID', $this->id_msg)
                ->orderBy('EVENT_TIMESTAMP', 'desc')
                ->limit(1)
                ->first();

            if ($checkPreSettlement->PROCESS_STATUS == 'F' && $checkPreSettlement->MSG_ID == $this->idMsg) {
                $this->dialog()->error(
                    'Error!',
                    $checkPreSettlement->MSG_TEXT . ' For This Account No ' . $this->accNo . ' Message ID ' . $checkPreSettlement->MSG_ID
                );
            } else {
                $result = SpFmsUpTrx3920EarlySettlement::handle([
                    'clientId' => $this->clientId,
                    'accNo' => $this->accNo,
                    'txnAmt' => $this->txnAmt,
                    'txnCode' => $this->txnCode,
                    'docNo' => $this->docNo,
                    'txnDate' => $this->txnDate,
                    'userId' => auth()->id(),
                    'remarks' => $this->remarks,
                    'bankClient' => $this->bankClient
                ]);
            }
        }

        if ($this->module == 'miscellaneousIn') {
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
        }

        if ($this->module == 'bulkPayment') {
            $result = SpFmsUpTrxPaymentAll::handle([
                'clientId' => $this->clientId,
                'mbrNo' => $this->mbrNo,
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
