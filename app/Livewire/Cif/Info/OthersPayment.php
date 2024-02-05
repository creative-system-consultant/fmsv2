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
        $clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $clientID)->first();

        $othersPayment = DB::table('FMS.MEMBERSHIP_STATEMENTS')
            ->select(
                'FMS.MEMBERSHIP_STATEMENTS.id',
                'FMS.MEMBERSHIP_STATEMENTS.mbr_no',
                'FMS.MEMBERSHIP_STATEMENTS.doc_no',
                'FMS.MEMBERSHIP_STATEMENTS.transaction_date',
                'FMS.MEMBERSHIP_STATEMENTS.remarks',
                'FMS.MEMBERSHIP_STATEMENTS.transaction_code_id',
                'FMS.MEMBERSHIP_STATEMENTS.amount',
                DB::raw('created_by = 1'),
                'FMS.MEMBERSHIP_STATEMENTS.created_at',
                'REF.TRANSACTION_CODES.id AS id2',
                'REF.TRANSACTION_CODES.description',
                'REF.TRANSACTION_CODES.reverse_trx_id',
                'REF.TRANSACTION_CODES.dr_cr'
            )
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.MEMBERSHIP_STATEMENTS.transaction_code_id')
            ->where('FMS.MEMBERSHIP_STATEMENTS.mbr_no', '=', $this->customer->membership->mbr_no)
            ->where('FMS.MEMBERSHIP_STATEMENTS.client_id',$this->clientID)
            ->where('REF.TRANSACTION_CODES.client_id',$this->clientID)
            ->whereIn('REF.TRANSACTION_CODES.trx_group', array('OTHER PMT - INTRODUCER', 'TABUNG', 'OTHER PMT - INTRODUCER (REVERSAL)', 'TABUNG (REVERSAL)'))
            ->orderBy('FMS.MEMBERSHIP_STATEMENTS.id', 'asc')
            ->get();
        // dd($this->customer->membership->mbr_no);
        // ->paginate(10);


        return view('livewire.cif.info.others-payment', [
            'othersPayment' => $othersPayment
        ])->extends('layouts.main');
    }
}
