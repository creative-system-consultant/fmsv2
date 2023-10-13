<?php

namespace App\Livewire\Teller\PaymentContribution;

use App\Action\StoredProcedure\SpFmsUpTrxContributionIn;
use App\Livewire\General\CustomerSearch;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Services\Model\FmsGlobalParm;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Details extends Component
{
    use Actions;

    public $type;

    public $customer;
    public $name;
    public $refNo;
    public $totalContribution = 0;
    public $minContribution = 0;
    public $refBank;
    public $refBankIbt;
    public $startDate;
    public $endDate;

    public $txnCode = '4020';
    public $clientId = 1;

    public $chequeDate;
    public $bankCustomer;
    public $bankClient;
    public $documentNo;
    public $transactionAmount = 50;
    public $transactionDate;
    public $remarks;

    public $saveButton = false;

    public function mount()
    {
        $this->minContribution = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_CONTRIBUTION;
        $this->refBank = BankService::getAllRefBanks();
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];
    }

    #[On('customerSelected')]
    public function customerSelected($customer)
    {
        $this->customer = $customer;
        $this->name = (string) $this->customer['name'];
        $this->refNo = (string) $this->customer['fms_membership']['ref_no'];
        $this->totalContribution = (float) $this->customer['fms_membership']['total_contribution'];
        $this->saveButton = true;
    }

    #[On('typeUpdated')]
    public function typeUpdated($type)
    {
        $this->resetFields();
        $this->resetValidation();
        $this->type = $type;
        $this->updateTxnCode();
    }

    private function updateTxnCode()
    {
        $txnCodes = [
            'cheque' => '4020',
            'cash' => '4030',
            'ibt/si' => '4040',
        ];

        $this->txnCode = $txnCodes[$this->type] ?? '4020'; // Default to '4020'
    }

    private function resetFields()
    {
        $this->reset('chequeDate', 'bankCustomer', 'bankClient', 'documentNo', 'transactionAmount', 'transactionDate', 'remarks');
    }

    public function saveTransaction()
    {
        $this->validate($this->getValidationRules());
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    protected function getValidationRules()
    {
        $baseRules = [
            'transactionAmount' => ['required', 'numeric','gte:minContribution'],
            'transactionDate' => ['required', 'before_or_equal:today'],
            'remarks' => ['required'],
        ];

        switch ($this->type) {
            case 'cheque':
                return array_merge($baseRules, [
                    'chequeDate' => ['required', 'before_or_equal:today'],
                    'bankCustomer' => ['required']
                ]);
            case 'cash':
                return $baseRules;
            case 'ibt/si':
                return array_merge($baseRules, [
                    'bankClient' => ['required']
                ]);
            default:
                return []; // or throw an exception if this is unexpected
        }
    }

    public function confirmSaveTransaction()
    {
        $data = [
            'clientId' => $this->clientId,
            'refNo' => $this->refNo,
            'txnAmt' => $this->transactionAmount,
            'txnDate' => $this->transactionDate,
            'docNo' => $this->documentNo,
            'txnCode' => $this->txnCode,
            'remarks' => $this->remarks,
            'bankCustomer' => $this->bankClient,
            'userId' => auth()->id(),
            'chequeDate' => $this->chequeDate,
            'bankClient' => $this->bankClient
        ];

        $result = SpFmsUpTrxContributionIn::handle($data);
        ($result)
            ? $this->dialog()->success('Success!', 'The transaction have been recorded.')
            : $this->dialog()->error('Error!', 'something went wrong.');

        $this->resetFields();
        $this->dispatch('refreshComponent', uuid: $this->customer['uuid'])->to(CustomerSearch::class);
    }

    public function render()
    {
        return view('livewire.teller.payment-contribution.details');
    }
}
