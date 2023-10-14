<?php

namespace App\Livewire\General;

use App\Services\Model\CifCustomer;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Livewire component for searching customers.
 */
class CustomerSearch extends Component
{
    use WithPagination;

    // Customer attributes
    public $name, $refNo, $totalContribution;

    // Search and sorting attributes
    public $searchBy = 'name', $search, $sortField, $sortDirection;

    // Listen to the 'refreshComponent' event
    protected $listeners = ['refreshComponent' => 'reload'];

    /**
     * Reset pagination if the search term is updated.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Retrieve customer data based on UUID.
     *
     * @param string $uuid The UUID of the customer.
     * @return object The customer object.
     */
    private function getData($uuid)
    {
        $customer = CifCustomer::getCifCustomerByUuid($uuid);

        // Set the public properties with customer details
        $this->name = $customer->name;
        $this->refNo = $customer->fmsMembership->ref_no;
        $this->totalContribution = $customer->fmsMembership->total_contribution;

        return $customer;
    }

    /**
     * Handle customer selection and dispatch an event.
     *
     * @param string $uuid The UUID of the selected customer.
     */
    public function selectedUuid($uuid)
    {
        $customer = $this->getData($uuid);
        $this->dispatch('customerSelected', customer: $customer);
    }

    /**
     * Refresh the component with new customer data based on UUID.
     *
     * @param string $uuid The UUID of the customer.
     */
    #[On('refreshComponent')]
    public function reload($uuid)
    {
        $this->getData($uuid);
    }

    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $conditions = [
            ['fmsMembership.whereNotNull', 'ref_no'],
            ['fmsMembership.where', 'status_id', '<>', 4],
            ['where', 'name', 'NOT LIKE', '%Administrator%']
        ];

        $relationships = ['fmsMembership'];

        // Retrieve customers based on conditions, search field and search term
        $customers = CifCustomer::fetchByCondition($conditions, $this->searchBy, $this->search,null, null, $relationships);

        return view('livewire.general.customer-search', ['customers' => $customers]);
    }
}
