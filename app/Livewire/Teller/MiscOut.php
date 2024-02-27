<?php

namespace App\Livewire\Teller;

use App\Action\StoredProcedure\SpFmsGenerateMbrMisc;
use App\Action\StoredProcedure\SpFmsUpTrxMiscOut;
use App\Livewire\General\CustomerSearch;
use App\Livewire\Teller\General\MembersBankInfo;
use App\Models\Fms\FmsAccountMaster;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Traits\MiscellaneousOutRulesTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class MiscOut extends Component
{
    use Actions, MiscellaneousOutRulesTrait;

    public $clientId;
    public $startDate;
    public $endDate;
    public $refBank;
    public $refBankIbt;
    public $miscAmt;
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
    public $instiCode;

    // financing variable
    public $accNo;
    public $selectedMiscOutFinancing;
    public $instalAmt;

    public function mount()
    {
        $this->clientId = (int) auth()->user()->client_id;
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];
        $this->refBank = BankService::getAllRefBanks($this->clientId);
        $this->refBankIbt = BankIbtService::getAllRefBankIbts($this->clientId);

        $this->categoryList = [
            ['name' => 'contribution', 'code' => '2220', 'icon' => 'credit-card'],
            ['name' => 'members', 'code' => '2210', 'icon' => 'cash'],
            ['name' => 'financing', 'code' => '2230', 'icon' => 'cash'],
            ['name' => 'share', 'code' => '2250', 'icon' => 'cash'],
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

    #[On('mbrSelected')]
    public function handleMbrNoSelection($customer)
    {
        // $this->loading = true;
        $this->customer = $customer;
        $this->bankMember = $customer['bank_id'];
        $this->mbrNo = (string) $customer['mbr_no'];
        $this->docNo = "N/A";
        $this->miscAmt = (float) $customer['misc_amt'];
        $this->ic = $customer['identity_no'];
        $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);
        $this->saveButton = $this->bankMember && $customer['bank_acct_no'];
        // $this->dispatch('endProcessing');
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

        if($this->txnCode == '2210') {
            $this->docNo = SpFmsGenerateMbrMisc::handle([
                'clientId' => $this->clientId,
                'mbrNo' => $this->mbrNo
            ]);
        } else {
            $this->docNo = "N/A";
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
        $this->validate($this->getMiscellaneousOutRules());
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
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

        if (!$result) {
            $this->dialog()->error('Error!', 'Something went wrong.');
            return;
        }

        $message = (array) $result[0];
        $dialogType = $message["SP_RETURN_CODE"] == 0 ? 'success' : 'error';
        $messageText = $message["SP_RETURN_CODE"] == 0 ? 'Success!' : 'Error!';

        $this->dialog()->$dialogType($messageText, $message["SP_RETURN_MSG"]);
        $this->reset('chequeDate', 'bankMember', 'bankClient', 'docNo', 'txnAmt', 'txnDate', 'remarks');
        $this->dispatch('refreshComponentMbrNo', mbrNo: $this->customer['mbr_no'])->to(CustomerSearch::class);
    }

    public function render()
    {
        return view('livewire.teller.misc-out');
    }
}
