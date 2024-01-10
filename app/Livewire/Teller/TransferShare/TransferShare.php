<?php

namespace App\Livewire\Teller\TransferShare;

use App\Models\Siskop\SiskopTransferShare;
use DB;
use Livewire\Component;

class TransferShare extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $exchangeMbrNameSub = DB::table('cif.customers as d')
            ->select('d.name')
            ->whereColumn('d.client_id', 'a.client_id')
            ->whereColumn('d.id', 'a.exc_cust_id')
            ->limit(1);

        $buyerMbrNameSub = DB::table('cif.customers as e')
            ->select('e.name')
            ->whereColumn('e.client_id', 'a.client_id')
            ->whereColumn('e.mbr_no', 'a.buyer_no')
            ->limit(1);

        $clientId = auth()->user()->client_id;

        $datas = DB::table('FMS.SHARES_REQ_HISTORY as a')
            ->join('FMS.MEMBERSHIP as b', function ($join) use ($clientId) {
                $join->on('a.mbr_no', '=', 'b.mbr_no')
                    ->where('b.client_id', '=', $clientId);
            })
            ->join('cif.customers as c', function ($join) use ($clientId) {
                $join->on('b.cif_id', '=', 'c.id')
                    ->where('c.client_id', '=', $clientId);
            })
            ->select(
                'a.mbr_no',
                'c.name',
                'a.approved_amt',
                'a.method',
                'c.email',
                'a.seller_no',
                'a.buyer_no',
                'a.exc_cust_id',
                'a.bank_code',
                'a.bank_account',
                'a.cheque_no',
                'a.cheque_date',
                'a.cheque_clear',
                'a.cdm_date',
                'a.online_date',
                'a.transferred_flag',
                'a.transferred_date',
                DB::raw('(' . $exchangeMbrNameSub->toSql() . ') as exchange_mbr_name'),
                DB::raw('(' . $buyerMbrNameSub->toSql() . ') as buyer_mbr_name')
            )
            ->where('a.req_status', '1')
            ->where('b.mbr_status', 'A')
            ->where('a.direction', 'exchange')
            ->where('a.client_id', $clientId)
            ->addBinding($exchangeMbrNameSub->getBindings(), 'select')
            ->addBinding($buyerMbrNameSub->getBindings(), 'select')
            ->get();

        dd($datas);

        return view('livewire.teller.transfer-share.transfer-share', [
            'datas' => $datas,
        ])->extends('layouts.main');
    }
}
