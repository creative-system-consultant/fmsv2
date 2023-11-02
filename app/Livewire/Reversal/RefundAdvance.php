<?php

namespace App\Livewire\Reversal;

use App\Models\Fms\FmsAccountStatement;
use App\Traits\Reversal\RefundAdvancePlaceholder;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class RefundAdvance extends Component
{
    use Actions, WithPagination, RefundAdvancePlaceholder;

    public $reversalModal = false;
    public $clientId;
    public $searchBy = 'FMS.MEMBERSHIP.mbr_no';
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

        $rawData = FmsAccountStatement::select(
            'FMS.ACCOUNT_STATEMENTS.id',
            'CIF.CUSTOMERS.name',
            'FMS.MEMBERSHIP.mbr_no',
            'FMS.ACCOUNT_STATEMENTS.account_no',
            'FMS.ACCOUNT_POSITIONS.advance_payment',
            'FMS.ACCOUNT_STATEMENTS.remarks',
            'REF.TRANSACTION_CODES.description',
            'FMS.ACCOUNT_STATEMENTS.amount',
            'FMS.ACCOUNT_STATEMENTS.doc_no',
            'FMS.ACCOUNT_STATEMENTS.transaction_code_id',
            'FMS.ACCOUNT_STATEMENTS.transaction_date',
            'REF.TRANSACTION_CODES.trx_group',
            'FMS.ACCOUNT_STATEMENTS.ref_id_reversal'
        )
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.ACCOUNT_STATEMENTS.transaction_code_id')
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', 'FMS.ACCOUNT_STATEMENTS.account_no')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.account_no', 'FMS.ACCOUNT_STATEMENTS.account_no')
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'FMS.ACCOUNT_MASTERS.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.ID', 'FMS.MEMBERSHIP.cif_id')
            ->whereIn('FMS.ACCOUNT_STATEMENTS.transaction_code_id', ['3950', '9810'])
            ->where('FMS.ACCOUNT_STATEMENTS.transaction_code_id', '>', 0)
            ->whereBetween('FMS.ACCOUNT_STATEMENTS.transaction_date', [$start, $end])
            ->where('FMS.ACCOUNT_STATEMENTS.client_id', $this->clientId)
            ->where('REF.TRANSACTION_CODES.client_id', $this->clientId)
            ->where('FMS.ACCOUNT_POSITIONS.client_id', $this->clientId)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $this->clientId)
            ->where('FMS.MEMBERSHIP.client_id', $this->clientId)
            ->where('CIF.CUSTOMERS.client_id', $this->clientId)
            ->where($this->searchBy, 'LIKE', '%' . $this->search . '%')
            ->orderBy('FMS.ACCOUNT_STATEMENTS.id', 'desc')
            ->paginate(10);

        return $rawData;
    }

    public function render()
    {
        $dataTable = $this->getData();

        return view('livewire.reversal.refund-advance', [
            'dataTable' => $dataTable
        ])->extends('layouts.main');
    }
}
