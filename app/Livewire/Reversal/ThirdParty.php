<?php

namespace App\Livewire\Reversal;

use App\Models\Fms\FmsThirdPartyStatement;
use App\Services\General\ActgPeriod;
use App\Services\General\ReportService;
use App\Traits\Reversal\ThirdPartyPlaceholder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ThirdParty extends Component
{
    use Actions, WithPagination, ThirdPartyPlaceholder;

    public $reversalModal = false;
    public $clientId;
    public $searchBy = 'FMS.THIRDPARTY_STATEMENTS.mbr_no';
    public $search = '';

    public function search()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
    }

    public function reverse($id)
    {
        $this->reversalModal = true;
    }

    public function getData()
    {
        // only enable this when live, for now hard coded to sept 2023 (data that has in db)
        // $start = ActgPeriod::determinePeriodRange()['startDate'];
        // $end = ActgPeriod::determinePeriodRange()['endDate'];

        $start = '2023-09-01';
        $end = '2023-09-30';

        $rawData = FmsThirdPartyStatement::select(
            'FMS.THIRDPARTY_STATEMENTS.id',
            'FMS.THIRDPARTY_STATEMENTS.doc_no',
            'CIF.CUSTOMERS.name',
            'REF.TRANSACTION_CODES.description',
            'FMS.THIRDPARTY_STATEMENTS.mbr_no',
            'FMS.THIRDPARTY_STATEMENTS.transaction_date',
            'FMS.THIRDPARTY_STATEMENTS.transaction_amount',
            'REF.TRANSACTION_CODES.trx_group',
            'FMS.THIRDPARTY_STATEMENTS.ref_id_reversal'
        )
            ->join('FMS.MEMBERSHIP', 'FMS.THIRDPARTY_STATEMENTS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.THIRDPARTY_STATEMENTS.transaction_code_id')
            ->whereIn('REF.TRANSACTION_CODES.trx_group', ['THIRD PARTY PMT', 'THIRD PARTY PMT (REVERSAL)'])
            ->whereBetween('FMS.THIRDPARTY_STATEMENTS.transaction_date', [$start, $end])
            ->where('FMS.THIRDPARTY_STATEMENTS.client_id', $this->clientId)
            ->where('FMS.MEMBERSHIP.client_id', $this->clientId)
            ->where('CIF.CUSTOMERS.client_id', $this->clientId)
            ->where('REF.TRANSACTION_CODES.client_id', $this->clientId)
            ->where($this->searchBy, 'LIKE', '%' . $this->search . '%')
            ->orderBy('FMS.THIRDPARTY_STATEMENTS.id', 'desc')
            ->paginate(10);

        return $rawData;
    }

    public function render()
    {
        $dataTable = $this->getData();

        return view('livewire.reversal.third-party', [
            'dataTable' => $dataTable
        ])->extends('layouts.main');
    }
}
