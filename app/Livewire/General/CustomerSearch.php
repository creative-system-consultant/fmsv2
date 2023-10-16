<?php

namespace App\Livewire\General;

use App\Services\Model\CifCustomer;
use App\Services\Model\FmsAccountMaster;
use App\Services\Module\General\CustomerSearch as GeneralCustomerSearch;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerSearch extends Component
{
    use WithPagination;

    public $name;
    public $searchRefNo, $searchRefNoValue;
    public $searchTotContribution, $searchTotContributionAmt;
    public $searchTotShare, $searchTotShareAmt;
    public $searchMthInstallAmt, $searchMthInstallAmtValue;
    public $searchInstallAmtArear, $searchInstallAmtArearAmt;

    public $customQuery = '';

    public $searchBy = 'name', $search, $sortField, $sortDirection;

    public $headers = [];

    public function mount()
    {
        $this->setHeaders();
    }

    public function setHeaders()
    {
        if ($this->customQuery == 'financingRepayment') {
            $this->headers = [
                "IDENTITY NO.",
                "NAME",
                "ACCOUNT NO",
                "APPROVED AMOUNT",
                "FINANCING",
                "ACTION"
            ];
        } elseif ($this->customQuery == 'withdrawShare') {
            $this->headers = [
                "MEMBERSHIP NO",
                "NAME",
                "TOTAL SHARE",
                "LAST PAYMENT DATE",
                "ACTION"
            ];
        } else {
            $this->headers = [
                "STAFF NO",
                "IDENTITY NO.",
                "MEMBERSHIP NO",
                "NAME",
                "ACTION"
            ];
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectedUuid($uuid)
    {
        $customer = $this->getData($uuid);
        $this->dispatch(
            'customerSelected',
            customer: $customer,
        );
    }

    private function getData($uuid)
    {
        $customer = CifCustomer::getCustomerSearchData($uuid);

        $this->name = $customer->name;

        if ($this->searchRefNo) {
            $this->searchRefNoValue = $customer->fmsMembership->ref_no;
        }

        if ($this->searchTotContribution) {
            $this->searchTotContributionAmt = $customer->fmsMembership->total_contribution;
        }

        if ($this->searchTotShare) {
            $this->searchTotShareAmt = $customer->fmsMembership->total_share;
        }

        return $customer;
    }

    public function selectedAccNo($accNo)
    {
        $accMaster = $this->getFmsData($accNo);
        $this->dispatch(
            'accNoSelected',
            bankMember: $accMaster->fmsMembership->cifCustomer->bank_id,
            accNo: $accNo,
            mthInstallAmtValue: $accMaster->instal_amount,
            totalContribution: $accMaster->fmsMembership->total_contribution
        );
    }

    private function getFmsData($accNo)
    {
        $accMaster = FmsAccountMaster::getAccountData($accNo);

        $this->name = $accMaster->fmsMembership->cifCustomer->name;

        if ($this->searchMthInstallAmt) {
            $this->searchMthInstallAmtValue = $accMaster->instal_amount;
        }

        if ($this->searchInstallAmtArear) {
            $this->searchInstallAmtArearAmt = $accMaster->fmsAccountPosition->instal_arrears;
        }

        if ($this->searchTotContribution) {
            $this->searchTotContributionAmt = $accMaster->fmsMembership->total_contribution;
        }

        return $accMaster;
    }

    #[On('refreshComponent')]
    public function reload($uuid)
    {
        $this->getData($uuid);
    }

    #[On('refreshComponentAccNo')]
    public function reloadAccData($accNo)
    {
        $this->getFmsData($accNo);
    }

    public function render()
    {
        switch ($this->customQuery) {
            case 'financingRepayment':
                $customers = GeneralCustomerSearch::getFinancingRepaymentData($this->searchBy, $this->search);
                break;
            case 'withdrawShare':
                $customers = GeneralCustomerSearch::getWithdrawShareData($this->searchBy, $this->search);
                break;
            default:
                $customers = GeneralCustomerSearch::getData($this->searchBy, $this->search);
        }

        return view('livewire.general.customer-search', ['customers' => $customers]);
    }
}
