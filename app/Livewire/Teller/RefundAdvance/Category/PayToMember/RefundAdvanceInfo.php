<?php

namespace App\Livewire\Teller\RefundAdvance\Category\PayToMember;

use App\Action\StoredProcedure\SpFmsGenerateFinancingAdv;
use App\Action\StoredProcedure\SpFmsUpTrx3950RefundAdvance;
use App\Livewire\Teller\RefundAdvance\RefundAdvanceCreate;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\FmsAccountMaster;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class RefundAdvanceInfo extends Component
{
    use Actions;

    protected const TXN_CODE = '3950';

    public $accountNo;
    public $advancePayment;
    public $startDate;
    public $endDate;

    public $refBankIbt;

    #[Rule('required|lte:advancePayment|numeric')]
    public $amount;

    public $bank;

    #[Rule('required|before_or_equal:today')]
    public $transactionDate;

    public $documentNo;
    public $payableAccountNo;

    #[Rule('required')]
    public $bankIbt;

    public $remark;

    public $clientBankDetails = false;

    protected $listeners = ['updatePayButton'];

    public function mount($accountNo)
    {
        $this->accountNo = $accountNo;
        $this->setInitialValues();
    }

    private function setInitialValues()
    {
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
        $accountMaster = FmsAccountMaster::getAccountData($this->accountNo);
        $this->bank = $accountMaster->cifCustomer->bank_id;
        $this->advancePayment = $accountMaster->fmsAccountPosition->advance_payment;
        $this->documentNo = SpFmsGenerateFinancingAdv::handle(1, $this->accountNo);
        $this->payableAccountNo = $accountMaster->cifCustomer->bank_acct_no;
        $this->clientBankDetails = $this->bank && $this->payableAccountNo;

        $periodRange  = ActgPeriod::determinePeriodRange();
        $this->startDate = $periodRange ['startDate'];
        $this->endDate = $periodRange ['endDate'];
    }

    public function updatePayButton($data)
    {
        $this->bank = $data['bank'];
        $this->payableAccountNo = $data['payableAccountNo'];
        $this->clientBankDetails = $this->bank && $this->payableAccountNo;
    }

    public function saveTransaction()
    {
        $this->validate();
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $data = [
            'clientId' => 1,
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

        $result = SpFmsUpTrx3950RefundAdvance::handle($data);
        $result == 'DONE'
            ? $this->dialog()->success('Success!', 'The transaction have been recorded.')
            : $this->dialog()->error('Error!', 'something went wrong.');

        $this->dispatch('refreshComponent')->to(RefundAdvanceCreate::class);
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->reset('amount', 'transactionDate', 'bankIbt', 'remark');
    }

    public function render()
    {
        return view('livewire.teller.refund-advance.category.pay-to-member.refund-advance-info');
    }
}
