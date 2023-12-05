<?php

namespace App\Livewire\Cif;

use App\Services\Model\CifCustomer;
use DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Individual extends Component
{
    use WithPagination;

    public $searchBy = 'name';
    public $search;
    public $clientID;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
    }

    public function render()
    {
        $customer = DB::table('CIF.CUSTOMERS')
            ->select(
                'CIF.CUSTOMERS.uuid',
                'CIF.CUSTOMERS.staff_no',
                'FMS.MEMBERSHIP.mbr_no',
                'CIF.CUSTOMERS.identity_no',
                'CIF.CUSTOMERS.name',
                'CIF.CUSTOMERS.created_at',
                'CIF.CUSTOMERS.updated_at',
                DB::raw('FMS.uf_get_cust_status(' . $this->clientID . ',status_id) as status_id')
            )
            ->leftJoin('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->where($this->searchBy, 'like', '%' . $this->search . '%')
            ->where('CIF.CUSTOMERS.cust_status', 'Y')
            ->where('CIF.CUSTOMERS.client_id', $this->clientID)
            ->where('FMS.MEMBERSHIP.client_id', $this->clientID)
            ->whereNotNull('FMS.MEMBERSHIP.mbr_no')
            ->paginate(10);

        return view('livewire.cif.individual', ['customers' => $customer])->extends('layouts.main');
    }
}
