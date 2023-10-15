<?php

namespace App\Livewire\General;

use App\Services\Model\CifCustomer;
use App\Services\Module\General\CustomerSearch as GeneralCustomerSearch;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerSearch extends Component
{
    use WithPagination;

    public $name, $refNo;
    public $totalContribution, $totalContributionAmt;
    public $totalShare, $totalShareAmt;

    public $searchBy = 'name', $search, $sortField, $sortDirection;

    protected $listeners = ['refreshComponent' => 'reload'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    private function getData($uuid)
    {
        $customer = CifCustomer::getCifCustomerByUuid($uuid);

        $this->name = $customer->name;
        $this->refNo = $customer->fmsMembership->ref_no;

        if ($this->totalContribution) {
            $this->totalContributionAmt = $customer->fmsMembership->total_contribution;
        }

        if ($this->totalShare) {
            $this->totalShareAmt = $customer->fmsMembership->total_share;
        }

        return $customer;
    }

    public function selectedUuid($uuid)
    {
        $customer = $this->getData($uuid);
        $this->dispatch('customerSelected', customer: $customer);
    }

    #[On('refreshComponent')]
    public function reload($uuid)
    {
        $this->getData($uuid);
    }

    public function render()
    {
        $customers = GeneralCustomerSearch::getData($this->searchBy, $this->search);

        return view('livewire.general.customer-search', ['customers' => $customers]);
    }
}
