<?php

namespace App\Livewire\Teller\Autopay;

use App\Models\Cif\CifCustomer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerSearch extends Component
{
    use WithPagination;

    public $sub = false;
    public $searchBy = 'CIF.CUSTOMERS.name';
    public $search = '';

    public function selectMember($uuid)
    {
        $customer = CifCustomer::select('CIF.CUSTOMERS.name', 'FMS.MEMBERSHIP.mbr_no', 'CIF.CUSTOMERS.staff_no')
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.CIF_ID', 'CIF.CUSTOMERS.id')
            ->where('CIF.CUSTOMERS.uuid',$uuid)
            ->first();

        $this->dispatch('customerSelected', customer: $customer);
        $this->search = '';
    }

    public function selectSubMember($uuid)
    {
        $customer = CifCustomer::select('CIF.CUSTOMERS.name', 'CIF.CUSTOMERS.identity_no','FMS.MEMBERSHIP.mbr_no', 'CIF.CUSTOMERS.staff_no')
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.CIF_ID', 'CIF.CUSTOMERS.id')
            ->where('CIF.CUSTOMERS.uuid',$uuid)
            ->first();

        $this->dispatch('customerSubSelected', customer: $customer);
        $this->search = '';
    }

    public function render()
    {
        $searchList = CifCustomer::select('CIF.CUSTOMERS.uuid', 'CIF.CUSTOMERS.identity_no', 'CIF.CUSTOMERS.staff_no', 'CIF.CUSTOMERS.name', 'CIF.ACCOUNT_STATUSES.description')
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.CIF_ID', 'CIF.CUSTOMERS.id')
            ->join('CIF.ACCOUNT_STATUSES', 'CIF.ACCOUNT_STATUSES.id', 'FMS.MEMBERSHIP.status_id')
            ->where($this->searchBy,'like','%'.$this->search.'%')
            ->whereNotNull('FMS.MEMBERSHIP.mbr_no')
            ->where('CIF.CUSTOMERS.name','NOT LIKE','%Administrator%')
            ->where('FMS.MEMBERSHIP.status_id',1)
            ->paginate(5);

        return view('livewire.teller.autopay.customer-search', [
            'searchList' => $searchList
        ]);
    }
}
