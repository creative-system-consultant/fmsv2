<?php

namespace App\Livewire\Teller\RefundAdvance\Category;

use App\Action\StoredProcedure\SpFmsGenerateFinancingAdv;
use App\Action\StoredProcedure\SpFmsUpTrx3950RefundAdvance;
use App\Livewire\Teller\RefundAdvance\RefundAdvanceCreate;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Services\Model\FmsAccountMaster;
use App\Services\Module\RefundAdvance;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class PayToMember extends Component
{
    use Actions;

    protected const TXN_CODE = '3950';

    public $accountNo;
    public $advancePayment;
    public $startDate;
    public $endDate;
    public $refBank;
    public $refBankIbt;

    #[Rule('required|lte:advancePayment|numeric')]
    public $amount;

    #[Rule('required|before_or_equal:today')]
    public $transactionDate;

    public $documentNo;

    public $bank;
    public $payableAccountNo;

    #[Rule('required')]
    public $bankIbt;

    public $remark;

    public $clientBankDetails = true;

    protected $popupService;
    protected $financingAdvService;
    protected $refundAdvanceService;

    public function __construct()
    {
        $this->financingAdvService = app(SpFmsGenerateFinancingAdv::class);
        $this->refundAdvanceService = app(RefundAdvance::class);
        $this->popupService = app(PopupService::class);
    }

    public function mount($accountNo)
    {
        $this->accountNo = $accountNo;
        $this->setInitialValues();
    }

    private function setInitialValues()
    {
        $this->refBank = BankService::getAllRefBanks();
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
        $accountMaster = FmsAccountMaster::getAccountData($this->accountNo);
        $this->advancePayment = $accountMaster->fmsAccountPosition->advance_payment;
        $this->bank = $accountMaster->bank_members;
        $this->documentNo = $this->financingAdvService->handle($this->accountNo);
        $this->payableAccountNo = $accountMaster->account_no_members;

        if ($this->bank == NULL && $this->payableAccountNo == NULL) {
            $this->clientBankDetails = false;
        }

        $result = $this->refundAdvanceService->determinePeriodRange();
        $this->startDate = $result['startDate'];
        $this->endDate = $result['endDate'];
    }

    public function saveAdvanceInfo()
    {
        $this->validate([
            'bank' => 'required',
            'payableAccountNo' => 'required'
        ]);

        $this->popupService->confirm($this, 'confirmSaveAdvanceInfo', 'Save Information?', 'Are you sure to save this information?');
    }

    public function confirmSaveAdvanceInfo()
    {
        $data = [
            "bank_members" => $this->bank,
            "account_no_members" => $this->payableAccountNo
        ];

        FmsAccountMaster::updateAccountData($this->accountNo, $data);

        $this->clientBankDetails = true;
        $this->dialog()->success('Updated!', 'The detail has been updated.');
    }

    public function saveTransaction()
    {
        $this->validate([
            'amount' => 'required|lte:advancePayment|numeric',
            'transactionDate' => 'required|before_or_equal:today',
            'bankIbt' => 'required'
        ]);

        $this->popupService->confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $sp = new SpFmsUpTrx3950RefundAdvance();
        $data = [
            'accountNo' => $this->accountNo,
            'amount' => $this->amount,
            'transactionDate' => $this->transactionDate,
            'txnCode' => self::TXN_CODE,
            'remark' => $this->remark,
            'documentNo' => $this->documentNo,
            'userId' => auth()->id(),
            'bank' => $this->bank,
            'bankIbt' => $this->bankIbt
        ];

        $result = $sp->handle($data);

        $result == 'DONE'
            ? $this->notification()->success('Success!', 'The transaction have been recorded.')
            : $this->notification()->error('Error!', 'something went wrong.');

        $this->dispatch('refreshComponent')->to(RefundAdvanceCreate::class);
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->reset('amount', 'transactionDate', 'bankIbt', 'remark');
    }

    public function render()
    {
        return view('livewire.teller.refund-advance.category.pay-to-member');
    }
}
