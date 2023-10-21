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
    public $searchMbrNo, $searchMbrNoValue;
    public $searchStaffNo, $searchStaffNoValue;
    public $searchAccNo, $searchAccNoValue;
    public $searchTotContribution, $searchTotContributionAmt;
    public $searchTotShare, $searchTotShareAmt;
    public $searchMthInstallAmt, $searchMthInstallAmtValue;
    public $searchInstallAmtArear, $searchInstallAmtArearAmt;
    public $searchBalOutstanding, $searchBalOutstandingAmt;
    public $searchRebate, $searchRebateAmt;
    public $searchSettleProfit, $searchSettleProfitAmt;
    public $searchMiscAmt, $searchMiscAmtValue;
    public $searchFee, $searchFeeValue = 10;
    public $searchBalDividen, $searchBalDividenValue;
    public $searchAdvPayment, $searchAdvPaymentValue;

    public $customQuery = '';

    public $searchBy = 'name', $search, $sortField, $sortDirection;

    public $headers = [];

    public function mount()
    {
        $this->setHeaders();
    }

    public function setHeaders()
    {
        if ($this->customQuery == 'financingRepayment' || $this->customQuery == 'earlySettlementPayment') {
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
        } elseif ($this->customQuery == 'closeMembership') {
            $this->headers = [
                "MEMBERSHIP NO",
                "IDENTITY NO",
                "NAME",
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
        if($this->customQuery == 'closeMembership') {
            $customer = GeneralCustomerSearch::getCloseMembership($uuid);
        } else {
            $customer = CifCustomer::getCustomerSearchData($uuid);
        }

        $this->name = $customer->name;

        if ($this->searchMbrNo) {
            $this->searchMbrNoValue = $customer->mbr_no;
        }

        if ($this->searchStaffNo) {
            $this->searchStaffNoValue = $customer->staff_no;
        }

        if ($this->searchAccNo) {
            $this->searchAccNoValue = $customer->account_no;
        }

        if ($this->searchTotContribution) {
            $this->searchTotContributionAmt = number_format($customer->total_contribution, 2) ?? 0;
        }

        if ($this->searchTotShare) {
            $this->searchTotShareAmt = number_format($customer->total_share, 2) ?? 0;
        }

        if ($this->searchBalOutstanding) {
            $this->searchBalOutstandingAmt = number_format($customer->bal_outstanding, 2) ?? 0;
        }

        if ($this->searchRebate) {
            $this->searchRebateAmt = number_format($customer->rebate_amt, 2) ?? 0;
        }

        if ($this->searchSettleProfit) {
            $this->searchSettleProfitAmt = number_format($customer->settle_profit, 2) ?? 0;
        }

        if ($this->searchMiscAmt) {
            $this->searchMiscAmtValue = number_format($customer->misc_amt, 2) ?? 0;
        }

        if ($this->searchBalDividen) {
            $this->searchBalDividenValue = number_format($customer->bal_dividen, 2) ?? 0;
        }

        if ($this->searchAdvPayment) {
            $this->searchAdvPaymentValue = number_format($customer->advance_payment, 2) ?? 0;
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
            $this->searchMthInstallAmtValue = number_format($accMaster->instal_amount, 2);
        }

        if ($this->searchInstallAmtArear) {
            $this->searchInstallAmtArearAmt = number_format($accMaster->fmsAccountPosition->instal_arrears, 2);
        }

        if ($this->searchTotContribution) {
            $this->searchTotContributionAmt = number_format($accMaster->fmsMembership->total_contribution, 2);
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
            case 'earlySettlementPayment':
                $customers = GeneralCustomerSearch::getEarlySettlementPaymentData($this->searchBy, $this->search);
                break;
            case 'withdrawShare':
                $customers = GeneralCustomerSearch::getWithdrawShareData($this->searchBy, $this->search);
                break;
            case 'closeMembership':
                $customers = GeneralCustomerSearch::getAllCloseMembership($this->searchBy, $this->search);
                break;
            default:
                $customers = GeneralCustomerSearch::getData($this->searchBy, $this->search);
        }

        return view('livewire.general.customer-search', ['customers' => $customers]);
    }
}
