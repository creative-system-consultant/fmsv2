<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use DB;
use Livewire\Component;
use Livewire\WithPagination;

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
            //->whereIn('REF.TRANSACTION_CODES.trx_group', array('OTHER PMT - INTRODUCER', 'TABUNG', 'OTHER PMT - INTRODUCER (REVERSAL)', 'TABUNG (REVERSAL)'))
            ->orderBy('FMS.OTHER_PAYMENTS_STATEMENTS.id', 'asc')
            ->get();
        // ->paginate(10);


        return view('livewire.cif.info.others-payment', [
            'othersPayment' => $othersPayment
        ])->extends('layouts.main');
    }
}
