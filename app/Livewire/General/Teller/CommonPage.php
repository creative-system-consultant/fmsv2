<?php

namespace App\Livewire\General\Teller;

use App\Action\StoredProcedure\SpFmsGenerateMbrClosedMembers;
use App\Action\StoredProcedure\SpFmsGenerateMbrMisc;
use App\Action\StoredProcedure\SpFmsGenerateMbrWithdrawShare;
use App\Action\StoredProcedure\SpFmsUpTrx3800FinancingPayment;
use App\Action\StoredProcedure\SpFmsUpTrx3920EarlySettlement;
use App\Action\StoredProcedure\SpFmsUpTrx3950RefundAdvance;
use App\Action\StoredProcedure\SpFmsUpTrxContributionIn;
use App\Action\StoredProcedure\SpFmsUpTrxMiscInBk;
use App\Action\StoredProcedure\SpFmsUpTrxMiscOut;
use App\Action\StoredProcedure\SpFmsUpTrxPaymentAll;
use App\Action\StoredProcedure\SpFmsUpTrxPreSettlemtPostn;
use App\Action\StoredProcedure\SpFmsUpTrxRetirementProcess;
use App\Action\StoredProcedure\SpFmsUpTrxThirdparty;
use App\Livewire\General\CustomerSearch;
use App\Livewire\Teller\General\MembersBankInfo;
use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsAccountMaster;
use App\Models\Fms\FmsMembership;
use App\Models\Systm\SysMsgSp;
use App\Traits\PaymentContributionRulesTrait;
use App\Traits\BulkPaymentRulesTrait;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Services\Model\FmsGlobalParm;
use App\Services\Module\General\CustomerSearch as GeneralCustomerSearch;
use App\Traits\CloseMembershipRulesTrait;
use App\Traits\EarlySettlementPaymentTrait;
use App\Traits\FinancingRepaymentRulesTrait;
use App\Traits\MiscellaneousInRulesTrait;
use App\Traits\MiscellaneousOutRulesTrait;
use App\Traits\PurchaseShareRulesTrait;
use App\Traits\RefundAdvanceRulesTrait;
use App\Traits\ThirdPartyRulesTrait;
use App\Traits\WithdrawShareRulesTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class CommonPage extends Component
{
    use Actions,
        // payment in
        PaymentContributionRulesTrait, PurchaseShareRulesTrait, FinancingRepaymentRulesTrait, EarlySettlementPaymentTrait, ThirdPartyRulesTrait, MiscellaneousInRulesTrait, BulkPaymentRulesTrait,
        // payment out
        WithdrawShareRulesTrait, CloseMembershipRulesTrait, MiscellaneousOutRulesTrait, RefundAdvanceRulesTrait;

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
    public $searchMiscAmt = false;
    public $searchFee = false;
    public $searchBalDividen = false;
    public $searchAdvPayment = false;
    public $searchInstitute = false;
    public $searchTrxAmt = false;
    public $searchModeId = false;

    // mount variable
    public $startDate, $endDate, $refBank, $refBankIbt;
    public $minContribution;
    public $minShare;
    public $minThirdparty;
    public $minFinRepay;
    public $totalShareValid;
    public $advancePayment;
    public $miscAmt;
    public $instalAmt;

    // fetch variable
    public $customer, $ic, $mbrNo, $accId, $accNo, $totalContribution, $idMsg, $instiCode, $mode, $idThirdParty;
    public $saveButton = false;

    // input variable
    public $clientId, $chequeDate, $chequeNo, $bankMember, $bankClient, $docNo, $txnAmt, $txnDate, $remarks;

    public $additionalField = false;
    public $selectedMiscOutFinancing;

    // public $loading = false;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
        $this->refBank = BankService::getAllRefBanks();
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];

        //list all module do not use category
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
            case 'earlySettlementPayment':
                $this->setupEarlySettlementPayment();
                break;
            case 'thirdParty':
                $this->setupThirdParty();
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
            case 'closeMembership':
                $this->setupCloseMembership();
                break;
            case 'miscellaneousOut':
                $this->setupMiscellaneousOut();
                break;
            case 'refundAdvance':
                $this->setupRefundAdvance();
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

    private function setupEarlySettlementPayment()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'cheque', 'code' => '3921', 'icon' => 'credit-card'],
            ['name' => 'cash/cdm', 'code' => '3922', 'icon' => 'cash'],
            ['name' => 'ibt/si', 'code' => '3923', 'icon' => 'cash'],
        ];
        $this->setDefaultCategory();
    }

    private function setupThirdParty()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'cheque', 'code' => '1', 'icon' => 'credit-card'],
            ['name' => 'cash/cdm', 'code' => '2', 'icon' => 'cash'],
            ['name' => 'ibt', 'code' => '3', 'icon' => 'cash'],
            ['name' => 'contribution', 'code' => '4', 'icon' => 'cash'],
            ['name' => 'misc', 'code' => '5', 'icon' => 'cash'],
        ];
        $this->minThirdparty = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_THIRDPARTY;
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

    private function setupCloseMembership()
    {
        $this->txnCode = '3101';
    }

    private function setupMiscellaneousOut()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'contribution', 'code' => '2220', 'icon' => 'credit-card'],
            ['name' => 'members', 'code' => '2210', 'icon' => 'cash'],
            ['name' => 'financing', 'code' => '2230', 'icon' => 'cash'],
            ['name' => 'share', 'code' => '2250', 'icon' => 'cash'],
        ];
        $this->setDefaultCategory();
    }

    private function setupRefundAdvance()
    {
        $this->category = true;
        $this->categoryList = [
            ['name' => 'Pay to Members', 'code' => '3950', 'icon' => 'cash'],
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

    public function getCustomQueryProperty()
    {
        switch ($this->module) {
            case 'financingRepayment':
                return 'financingRepayment';
            case 'earlySettlementPayment':
                return 'earlySettlementPayment';
            case 'thirdParty':
                return 'thirdParty';
            case 'withdrawShare':
                return 'withdrawShare';
            case 'closeMembership':
                return 'closeMembership';
            case 'miscellaneousOut':
                return 'miscellaneousOut';
            case 'refundAdvance':
                return 'refundAdvance';
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
        $this->mbrNo = (string) $customer['mbr_no'];

        if($this->module == 'withdrawShare')
        {
            $this->totalShareValid = $customer['total_share'] - $this->minShare;
            $this->txnAmt = $this->totalShareValid;
            $this->saveButton = $this->bankMember && $customer['bank_acct_no'];

            $this->ic = $customer['identity_no'];
            $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);
            $this->docNo = SpFmsGenerateMbrWithdrawShare::handle(1, $this->mbrNo);

        } elseif($this->module == 'closeMembership') {
            $this->saveButton = $this->bankMember && $customer['bank_acct_no'];
            $this->ic = $customer['identity_no'];
            $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);

            //generate pv no
            SpFmsGenerateMbrClosedMembers::handle(1, $this->mbrNo);
            $this->docNo = FmsMembership::where('mbr_no', $this->mbrNo)->first()->closed_mbr_pv;

        } elseif($this->module == 'earlySettlementPayment') {
            $this->idMsg = mt_rand(100000000, 999999999);
            $this->accNo = $customer['acaccount_no'];
            $this->accId = $customer['id'];

        } else {
            $this->saveButton = true;
        }
        // $this->dispatch('endProcessing');
    }

    #[On('mbrSelected')]
    public function handleMbrNoSelection($customer)
    {
        // $this->loading = true;
        $this->customer = $customer;
        $this->bankMember = $customer['bank_id'];
        $this->mbrNo = (string) $customer['mbr_no'];
        $this->docNo = "N/A";

        if($this->module == 'miscellaneousOut') {
            $this->miscAmt = (float) $customer['misc_amt'];
            $this->ic = $customer['identity_no'];
            $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);
            $this->saveButton = $this->bankMember && $customer['bank_acct_no'];
            // dd($this->financing);
        }
        // $this->dispatch('endProcessing');
    }

    #[On('idSelected')]
    public function handleIdSelection($customer)
    {
        // $this->loading = true;
        $this->customer = $customer;
        $this->bankMember = $customer['bank_id'];
        $this->mbrNo = (string) $customer['mbr_no'];

        if($this->module == 'thirdParty') {
            $this->idThirdParty = $customer['id'];
            $this->instiCode = $customer['institution_code'];
            $this->mode = $customer['mode'];
        }

        $this->saveButton = true;
        // $this->dispatch('endProcessing');
    }

    #[On('accNoSelected')]
    public function handleAccNoSelection($accMaster, $accNo)
    {
        if($this->module == 'financingRepayment') {
            $this->accNo = (string) $accNo;
            $this->additionalField = true;
            $this->bankMember = $accMaster['fms_membership']['cif_customer']['bank_id'];
            $this->txnAmt = $accMaster['instal_amount'];
            $this->totalContribution = $accMaster['fms_membership']['total_contribution'];
            $this->saveButton = true;
        }

        if($this->module == 'refundAdvance') {
            $this->accNo = (string) $accMaster['account_no'];
            $this->advancePayment = $accMaster['advance_payment'];
            $this->bankMember = $accMaster['bank_id'];
            $this->ic = $accMaster['identity_no'];
            $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);
            $this->saveButton = $this->bankMember && $accMaster['bank_acct_no'];
        }
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

        if ($this->module == 'miscellaneousOut') {
            if($this->txnCode == '2210') {
                $this->docNo = SpFmsGenerateMbrMisc::handle([
                    'clientId' => $this->clientId,
                    'mbrNo' => $this->mbrNo
                ]);
            } else {
                $this->docNo = "N/A";
            }
        }
        // $this->reset();  need to reset input field when change type
        $this->resetValidation();
    }

    public function miscOutSelectedFinancing($accNo)
    {
        $this->accNo = strval($accNo);
        $this->selectedMiscOutFinancing = $accNo;

        $account = FmsAccountMaster::where('account_no', $accNo)->first();
        $this->txnAmt = $account->instal_amount;
        $this->instalAmt = $account->instal_amount;
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
            case 'earlySettlementPayment':
                $rules = $this->getEarlySettlementPayment();
                break;
            case 'thirdParty':
                $rules = $this->getThirdParty();
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
            case 'closeMembership':
                $rules = $this->getCloseMembershipRules();
                break;
            case 'miscellaneousOut':
                $rules = $this->getMiscellaneousOutRules();
                break;
            case 'refundAdvance':
                $rules = $this->getRefundAdvanceRules();
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

        if ($this->module == 'earlySettlementPayment') {
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

        if ($this->module == 'thirdParty') {
            $result = SpFmsUpTrxThirdparty::handle([
                'clientId' => $this->clientId,
                'mbrNo' => $this->mbrNo,
                'instiCode' => $this->instiCode,
                'paymentMode' => $this->txnCode,
                'txnAmt' => $this->txnAmt,
                'txnDate' => $this->txnDate,
                'docNo' => $this->docNo,
                'bankMember' => $this->bankMember,
                'chequeNo' => $this->chequeNo,
                'chequeDate' => $this->chequeDate,
                'remarks' => $this->remarks,
                'userId' => auth()->id(),
                'mode' => $this->mode,
                'bankClient' => $this->bankClient,
                'idThirdParty' => $this->idThirdParty
            ]);
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

        if ($this->module == 'closeMembership') {
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
        }

        if ($this->module == 'miscellaneousOut') {
            $result = SpFmsUpTrxMiscOut::handle([
                'clientId' => $this->clientId,
                'mbrNo' => $this->mbrNo,
                'txnAmt' => $this->txnAmt,
                'txnDate' => $this->txnDate,
                'txnCode' => $this->txnCode,
                'remarks' => $this->remarks,
                'docNo' => $this->docNo,
                'userId' => auth()->id(),
                'bankMember' => $this->bankMember,
                'accNo' => $this->accNo,
                'instiCode' => $this->instiCode,
                'bankClient' => $this->bankClient
            ]);
        }

        if ($this->module == 'refundAdvance') {
            $result = SpFmsUpTrx3950RefundAdvance::handle([
                'clientId' => $this->clientId,
                'accNo' => $this->accNo,
                'txnAmt' => $this->txnAmt,
                'txnDate' => $this->txnDate,
                'txnCode' => $this->txnCode,
                'remarks' => $this->remarks,
                'docNo' => $this->docNo,
                'userId' => auth()->id(),
                'bankMember' => $this->bankMember,
                'bankClient' => $this->bankClient
            ]);
        }

        $result
            ? $this->dialog()->success('Success!', 'The transaction has been recorded.')
            : $this->dialog()->error('Error!', 'Something went wrong.');

        if ($this->module == 'financingRepayment' || $this->module == 'refundAdvance') {
            $this->dispatch('refreshComponentAccNo', accNo: $this->accNo)->to(CustomerSearch::class);
        } elseif($this->module == 'thirdParty') {
            $this->dispatch('refreshComponentId', id: $this->customer['id'])->to(CustomerSearch::class);
        } elseif($this->module == 'miscellaneousOut') {
            $this->dispatch('refreshComponentMbrNo', mbrNo: $this->customer['mbr_no'])->to(CustomerSearch::class);
        } else {
            $this->dispatch('refreshComponent', uuid: $this->customer['uuid'])->to(CustomerSearch::class);
        }

        //need to reset input field after done
        // $this->resetFields();
    }

    public function render()
    {
        $financing = null;

        if ($this->module == 'miscellaneousOut') {
            $financing = GeneralCustomerSearch::getMiscellaneousOutFinancingData($this->clientId, $this->mbrNo);
        }

        return view('livewire.general.teller.common-page', [
            'financing' => $financing
        ]);
    }
}
