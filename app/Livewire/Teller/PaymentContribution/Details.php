<?php

namespace App\Livewire\Teller\PaymentContribution;

use App\Action\StoredProcedure\SpFmsUpTrxContributionIn;
use App\Livewire\General\CustomerSearch;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use App\Services\Model\FmsGlobalParm;
use App\Traits\Teller\PaymentContribution\DetailsTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Details extends Component
{
    use Actions, DetailsTrait;

    public function mount()
    {
        $this->minContribution = (float) FmsGlobalParm::getAllFmsGlobalParm()->MIN_CONTRIBUTION;
        $this->refBank = BankService::getAllRefBanks();
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];
    }

    #[On('customerSelected')]
    public function handleCustomerSelection($customer)
    {
        $this->customer = $customer;
        $this->name = (string) $customer['name'];
        $this->refNo = (string) $customer['fms_membership']['ref_no'];
        $this->totalContribution = (float) $customer['fms_membership']['total_contribution'];
        $this->saveButton = true;
    }

    #[On('typeUpdated')]
    public function handleTypeUpdate($type)
    {
        $this->resetFields();
        $this->resetValidation();
        $this->type = $type;
        $this->updateTxnCode();
    }

    public function saveTransaction()
    {
        $this->validate($this->getValidationRules());
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $result = SpFmsUpTrxContributionIn::handle([
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
        ]);

        $result
            ? $this->dialog()->success('Success!', 'The transaction has been recorded.')
            : $this->dialog()->error('Error!', 'Something went wrong.');

        $this->resetFields();
        $this->dispatch('refreshComponent', uuid: $this->customer['uuid'])->to(CustomerSearch::class);
    }

    public function render()
    {
        return view('livewire.teller.payment-contribution.details');
    }
}
