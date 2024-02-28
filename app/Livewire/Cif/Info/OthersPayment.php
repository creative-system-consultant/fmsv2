<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsOtherStatement;
use App\Models\Fms\FmsSpecialAidStatement as FmsFmsSpecialAidStatement;
use App\Models\Fms\SpecialAid;
use App\Models\FmsSpecialAidStatement;
use DB;
use Livewire\Component;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class OthersPayment extends Component
{
    use WithPagination;
    public $customer, $uuid;
    public $startDT, $endDT;
    public $clientID;

    public function mount()
    {
        $this->startDT    =  '2021-12-31';
        $this->endDT      =  now()->format('Y-m-d');
    }

    protected $rules = [
        'customer.last_withdraw_date'             => '',
        'customer.no_of_withdrawal'               => '',
    ];

    public function renderReportList(){
        $special_aid_stmt = FmsOtherStatement::with(['transaction'])
        ->whereIn('txn_code', function($query) {
            $query->select('id')
                ->from('REF.TRANSACTION_CODES')
                ->where('client_id', $this->clientID);
        })
        ->where('client_id',$this->clientID)
        ->where('mbr_no',$this->customer->membership->mbr_no)
        ->whereBetween(DB::raw('CAST(txn_date AS DATE)'), [$this->startDT, $this->endDT])
        ->orderBy('id', 'asc')
        ->get();

        foreach ($special_aid_stmt as $item) {
            yield $item;
        }

    }

    public function generateExcel()
    {
        return response()->streamDownload(function () {
            $header_style = (new Style())->setFontBold();
            $rows_style = (new Style())->setShouldWrapText(false);
            (new FastExcel($this->renderReportList()))
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->export('php://output', function ($item) {
                    return [
                        'Date'                      => date('d/m/Y', strtotime($item->txn_date)),
                        'Doc No'                    => ($item->doc_no ? $item->doc_no : 'N/A'),
                        'Transaction Description'   => $item->transaction->description,
                        'Remark'                    => ($item->remarks ? $item->remarks : 'N/A'),
                        'Amount'                    => ($item->dr_cr == 'D' ? '-' : number_format($item->txn_amt, 2)),
                        'Total Amount'              => number_format($item->total_amt, 2),
                        'Created By'                => ($item->created_by ? $item->created_by : 'N/A'),
                        'Created At'                => ($item->created_at ? date('d/m/Y/h:m:s', strtotime($item->created_at)) : 'N/A'),
                    ];
                });
        }, sprintf('Others Statements-%s.xlsx', now()->format('Y-m-d')));
    }

    public function render()
    {
        $this->clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();

        $othersPayment = DB::table('FMS.OTHER_PAYMENTS_STATEMENTS')
            ->select(
                'FMS.OTHER_PAYMENTS_STATEMENTS.id',
                'FMS.OTHER_PAYMENTS_STATEMENTS.mbr_no',
                'FMS.OTHER_PAYMENTS_STATEMENTS.doc_no',
                'FMS.OTHER_PAYMENTS_STATEMENTS.txn_date',
                'FMS.OTHER_PAYMENTS_STATEMENTS.remarks',
                'FMS.OTHER_PAYMENTS_STATEMENTS.txn_code',
                'FMS.OTHER_PAYMENTS_STATEMENTS.txn_amt',
                DB::raw('created_by = 1'),
                'FMS.OTHER_PAYMENTS_STATEMENTS.created_at',
                'REF.TRANSACTION_CODES.id AS id2',
                'REF.TRANSACTION_CODES.description',
                'REF.TRANSACTION_CODES.reverse_trx_id',
                'REF.TRANSACTION_CODES.dr_cr'
            )
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.OTHER_PAYMENTS_STATEMENTS.txn_code')
            ->where('FMS.OTHER_PAYMENTS_STATEMENTS.mbr_no', '=', $this->customer->membership->mbr_no)
            ->where('FMS.OTHER_PAYMENTS_STATEMENTS.client_id', $this->clientID)
            ->where('REF.TRANSACTION_CODES.client_id', $this->clientID)
            ->whereBetween(DB::raw('CAST(txn_date AS DATE)'), [$this->startDT, $this->endDT])
            ->orderBy('FMS.OTHER_PAYMENTS_STATEMENTS.id', 'asc')
            ->get();


        return view('livewire.cif.info.others-payment', [
            'othersPayment' => $othersPayment
        ])->extends('layouts.main');
    }
}
