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

    public $clientId;

    public $complete = false;
    public $name;
    public $searchMbrNo = false, $searchMbrNoValue;
    public $searchAccNo = false, $searchAccNoValue;
    public $searchTotContribution = false, $searchTotContributionAmt;
    public $searchTotShare = false, $searchTotShareAmt;
    public $searchMthInstallAmt = false, $searchMthInstallAmtValue;
    public $searchInstallAmtArear = false, $searchInstallAmtArearAmt;
    public $searchBalOutstanding = false, $searchBalOutstandingAmt;
    public $searchRebate = false, $searchRebateAmt;
    public $searchSettleProfit = false, $searchSettleProfitAmt;
    public $searchMiscAmt = false, $searchMiscAmtValue;
    public $searchFee = false, $searchFeeValue = 10;
    public $searchBalDividen = false, $searchBalDividenValue;
    public $searchAdvPayment = false, $searchAdvPaymentValue;
    public $searchInstitute = false, $searchInstituteValue;
    public $searchTrxAmt = false, $searchTrxAmtValue;
    public $searchModeId = false, $searchModeIdValue;

    public $customQuery = '';

    public $searchBy = 'name', $search, $sortField, $sortDirection;

    public $headers = [];

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
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
                "ACTION",
            ];
        } elseif ($this->customQuery == 'thirdParty') {
            $this->headers = [
                "NAME",
                "RECORDED AMOUNT",
                "TOTAL CONTRIBUTION",
                "TOTAL MISC",
                "INSTITUTE",
                "MODE",
                "STATUS",
                "EFFECTIVE DATE",
                "REMARKS",
                "ACTION",
            ];
        } elseif ($this->customQuery == 'withdrawShare') {
            $this->headers = [
                "MEMBERSHIP NO",
                "NAME",
                "TOTAL SHARE",
                "LAST PAYMENT DATE",
                "ACTION",
            ];
        } elseif ($this->customQuery == 'closeMembership') {
            $this->headers = [
                "MEMBERSHIP NO",
                "IDENTITY NO",
                "NAME",
                "ACTION",
            ];
        } elseif ($this->customQuery == 'miscellaneousOut') {
            $this->headers = [
                "MEMBERSHIP NO",
                "IDENTITY NO",
                "NAME",
                "MISCELLANEOUS AMOUNT",
                "ACTION",
            ];
        } elseif ($this->customQuery == 'refundAdvance') {
            $this->headers = [
                "IC NO",
                "MEMBERSHIP NO",
                "NAME",
                "ACCOUNT NO",
                "PRODUCT",
                "DISBURSED AMOUNT",
                "PRIN OUTSTANDING",
                "UEI OUTSTANDING",
                "ADV AMOUNT",
                "BAL OUTS",
                "ACTION",
            ];
        } elseif ($this->customQuery == 'dividendWithdrawal') {
            $this->headers = [
                "MEMBERSHIP NO",
                "IC NO",
                "NAME",
                "BALANCE",
                "ACTION",
            ];
        } elseif ($this->customQuery == 'withdrawContribution') {
            $this->headers = [
                "MEMBERSHIP NO",
                "NAME",
                "APPROVED AMOUNT",
                "APPROVED DATE",
                "ACTION",
            ];
        } else {
            $this->headers = [
                "STAFF NO",
                "IDENTITY NO.",
                "MEMBERSHIP NO",
                "NAME",
                "ACTION",
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
        if ($this->customQuery == 'closeMembership') {
            $customer = GeneralCustomerSearch::getCloseMembership($uuid);
        } elseif ($this->customQuery == 'withdrawContribution') {
            $customer = GeneralCustomerSearch::getContributionWithdrawalData($this->clientId, $uuid);
        } else {
            $customer = CifCustomer::getCustomerSearchData($this->clientId, $uuid);
        }

        $this->name = $customer->name;

        if ($this->searchMbrNo) {
            $this->searchMbrNoValue = $customer->mbr_no;
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

    public function selectedId($id)
    {
        $customer = $this->getIdData($id);
        $this->dispatch(
            'idSelected',
            customer: $customer,
        );
    }

    private function getIdData($id)
    {
        if ($this->customQuery == 'thirdParty') {
            $customer = GeneralCustomerSearch::getThirdPartyIdData($id);
        }

        $this->name = $customer->name;

        if ($this->searchMbrNo) {
            $this->searchMbrNoValue = $customer->mbr_no;
        }

        if ($this->searchInstitute) {
            $this->searchInstituteValue = $customer->description;
        }

        if ($this->searchTrxAmt) {
            $this->searchTrxAmtValue = number_format($customer->transaction_amt, 2) ?? 0;
        }

        if ($this->searchModeId) {
            $this->searchModeIdValue = $customer->mode;
        }

        return $customer;
    }

    public function selectedMbr($mbrNo)
    {
        $customer = $this->getMbrData($mbrNo);
        $this->dispatch(
            'mbrSelected',
            customer: $customer,
        );
    }

    private function getMbrData($mbrNo)
    {
        if ($this->customQuery == 'miscellaneousOut') {
            $customer = GeneralCustomerSearch::getMiscellaneousOutMbrData($this->clientId, $mbrNo, $this->complete);
        } elseif ($this->customQuery == 'dividendWithdrawal') {
            $customer = GeneralCustomerSearch::getDividendWithdrawalData($this->clientId, $mbrNo);

            if (!$customer) {
                $this->reset('name', 'searchMbrNoValue', 'searchBalDividenValue');
                $this->dispatch('refresh')->self();
                return;
            }
        }

        $this->name = $customer->name;

        if ($this->searchMbrNo) {
            $this->searchMbrNoValue = $customer->mbr_no;
        }

        if ($this->searchMiscAmt) {
            $this->searchMiscAmtValue = number_format($customer->misc_amt, 2) ?? 0;
        }

        if ($this->searchBalDividen) {
            $this->searchBalDividenValue = number_format($customer->bal_dividen, 2) ?? 0;
        }

        return $customer;
    }

    public function selectedAccNo($accNo)
    {
        $accMaster = $this->getFmsData($accNo);
        $this->dispatch(
            'accNoSelected',
            accMaster: $accMaster,
            accNo: $accNo
        );
    }

    private function getFmsData($accNo)
    {
        if ($this->customQuery == 'financingRepayment') {
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
        }

        if ($this->customQuery == 'refundAdvance') {
            $accMaster = GeneralCustomerSearch::getRrefundAdvance($accNo);

            $this->name = $accMaster->name;

            if ($this->searchAdvPayment) {
                $this->searchAdvPaymentValue = number_format($accMaster->advance_payment, 2) ?? 0;
            }

            if ($this->searchAccNo) {
                $this->searchAccNoValue = $accMaster->account_no;
            }

            if ($this->searchAdvPayment) {
                $this->searchAdvPaymentValue = number_format($accMaster->advance_payment, 2) ?? 0;
            }
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

    #[On('refreshComponentId')]
    public function reloadIdData($id)
    {
        $this->getIdData($id);
    }

    #[On('refreshComponentMbrNo')]
    public function reloadMbrNoData($mbrNo)
    {
        $this->complete = true;
        $customer = $this->getMbrData($mbrNo);

        if ($customer) {
            $this->dispatch(
                'mbrSelected',
                customer: $customer,
            );
        }
    }

    public function render()
    {
        switch ($this->customQuery) {
            case 'financingRepayment':
                $customers = GeneralCustomerSearch::getFinancingRepaymentData($this->clientId, $this->searchBy, $this->search);
                break;
            case 'earlySettlementPayment':
                $customers = GeneralCustomerSearch::getEarlySettlementPaymentData($this->clientId, $this->searchBy, $this->search);
                break;
            case 'thirdParty':
                $customers = GeneralCustomerSearch::getThirdPartyData($this->clientId, $this->searchBy, $this->search);
                break;
            case 'withdrawShare':
                $customers = GeneralCustomerSearch::getWithdrawShareData($this->clientId, $this->searchBy, $this->search);
                break;
            case 'closeMembership':
                $customers = GeneralCustomerSearch::getAllCloseMembership($this->clientId, $this->searchBy, $this->search);
                break;
            case 'miscellaneousOut':
                $customers = GeneralCustomerSearch::getAllMiscellaneousOut($this->clientId, $this->searchBy, $this->search);
                break;
            case 'refundAdvance':
                $customers = GeneralCustomerSearch::getAllRefundAdvance($this->clientId, $this->searchBy, $this->search);
                break;
            case 'dividendWithdrawal':
                $customers = GeneralCustomerSearch::getAllDividendWithdrawal($this->clientId, $this->searchBy, $this->search);
                break;
            case 'withdrawContribution':
                $customers = GeneralCustomerSearch::getAllContributionWithdrawal($this->clientId, $this->searchBy, $this->search);
                break;
            default:
                $customers = GeneralCustomerSearch::getData($this->clientId, $this->searchBy, $this->search);
        }

        return view('livewire.general.customer-search', ['customers' => $customers]);
    }
}
