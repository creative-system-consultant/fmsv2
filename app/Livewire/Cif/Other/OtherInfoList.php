<?php

namespace App\Livewire\Cif\Other;

use App\Services\Model\CifCustomer;
use DB;
use Livewire\Component;
use Livewire\WithPagination;

class OtherInfoList extends Component
{

    use WithPagination;

    public $searchBy = 'name';
    public $search;
    public $uuid;
    public $setIndex = 0;

    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function render()
    {
        $clientID = auth()->user()->client_id;

        $customers = DB::table('CIF.CUSTOMERS')
            ->select(
                'CIF.CUSTOMERS.uuid',
                'CIF.CUSTOMERS.staff_no',
                'FMS.MEMBERSHIP.mbr_no',
                'CIF.CUSTOMERS.identity_no',
                'CIF.CUSTOMERS.name',
                'CIF.CUSTOMERS.created_at',
                'CIF.CUSTOMERS.updated_at',
                DB::raw('FMS.uf_get_cust_status(' . $clientID . ', FMS.MEMBERSHIP.mbr_status) as status')
            )
            ->leftJoin('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->where($this->searchBy, 'like', '%' . $this->search . '%')
            ->where('CIF.CUSTOMERS.cust_status', 'Y')
            ->where('CIF.CUSTOMERS.client_id', $clientID)
            ->where('FMS.MEMBERSHIP.client_id', $clientID)
            ->whereNotNull('FMS.MEMBERSHIP.mbr_no')
            ->paginate(10);

        return view('livewire.cif.other.other-info-list', ['customers' => $customers])->extends('layouts.main');
    }
}
