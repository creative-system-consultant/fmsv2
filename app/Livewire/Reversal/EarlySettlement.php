<?php

namespace App\Livewire\Reversal;

use App\Models\Fms\FmsAccountStatement;
use App\Services\General\ActgPeriod;
use App\Services\General\ReportService;
use App\Traits\Reversal\EarlySettlementPlaceholder;
use DB;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class EarlySettlement extends Component
{
    use Actions, WithPagination, EarlySettlementPlaceholder;

    public $reversalModal = false;
    public $clientId;
    public $searchBy = 'FMS.ACCOUNT_STATEMENTS.account_no';
    public $search = '';

    public function search()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
    }

    public static function formatData($data)
    {
        return [
            'MEMBERSHIP NO' => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'ACCOUNT NO' => [
                'value' => $data->account_no,
                'align' => 'left'
            ],
            'DESCRIPTION' => [
                'value' => $data->transaction_code_id,
                'align' => 'left'
            ],
            'DOCUMENT NO' => [
                'value' => $data->doc_no,
                'align' => 'left'
            ],
            'AMOUNT' => [
                'value' => number_format($data->amount, 2),
                'align' => 'right'
            ],
            'TRANSACTION DATE' => [
                'value' => date('d/m/Y', strtotime($data->transaction_date)),
                'align' => 'left'
            ],
            'ACTION' => [
                'value' => ($data->ref_id_reversal == NULL) ? 'reverse("' . $data->id . '")' : 'DONE',
                'align' => 'center'
            ],
        ];
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
            'FMS.ACCOUNT_STATEMENTS.doc_no',
            'FMS.ACCOUNT_STATEMENTS.transaction_code_id',
            DB::raw('txn_desc = FMS.uf_get_transaction_code_desc(' . $this->clientId . ', FMS.ACCOUNT_STATEMENTS.transaction_code_id)'),
            'CIF.CUSTOMERS.name',
            'FMS.ACCOUNT_MASTERS.account_no',
            'FMS.ACCOUNT_MASTERS.mbr_no',
            'FMS.ACCOUNT_STATEMENTS.transaction_date',
            'FMS.ACCOUNT_STATEMENTS.amount',
            'REF.TRANSACTION_CODES.trx_group',
            'FMS.ACCOUNT_STATEMENTS.ref_id_reversal'
        )
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_STATEMENTS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->join('FMS.MEMBERSHIP', 'FMS.ACCOUNT_MASTERS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.ACCOUNT_STATEMENTS.transaction_code_id')
            ->whereIn('FMS.ACCOUNT_STATEMENTS.transaction_code_id', ['3852', '3921', '3922', '3923'])
            ->whereBetween('FMS.ACCOUNT_STATEMENTS.transaction_date', [$start, $end])
            ->where('FMS.ACCOUNT_STATEMENTS.client_id', $this->clientId)
            ->where('FMS.MEMBERSHIP.client_id', $this->clientId)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $this->clientId)
            ->where('CIF.CUSTOMERS.client_id', $this->clientId)
            ->where('REF.TRANSACTION_CODES.client_id', $this->clientId)
            ->where($this->searchBy, 'LIKE', '%' . $this->search . '%')
            ->get();

        $formattedData = [];

        foreach ($rawData as $data) {
            $formattedData[] = $this->formatData($data);
        }

        $data = new Collection($formattedData);

        return ReportService::paginateData($data);
    }

    public function render()
    {
        $dataTable = $this->getData();

        return view('livewire.reversal.early-settlement', [
            'dataTable' => $dataTable
        ])->extends('layouts.main');
    }
}
