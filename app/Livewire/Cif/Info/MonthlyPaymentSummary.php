<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use DB;
use Livewire\Component;

class MonthlyPaymentSummary extends Component
{
    public $customer, $uuid, $clientID;

    public function render()
    {
        $this->clientID = auth()->user()->client_id;

        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();

        $PaySummary = DB::select("
        select
            c.mbr_no,
            c.monthly_contribution,
            0.00 as monthly_saving,
            m.instal_amount as financing_installment,
            v.monthly_payble as monthly_payble,
            t.monthly_thirdparty
        from FMS.MEMBERSHIP c left join
            (select m.mbr_no,sum(m.instal_amount) as instal_amount
            from FMS.ACCOUNT_MASTERS m,FMS.ACCOUNT_POSITIONS p
			where m.account_no = p.account_no
			and isnull(p.disbursed_amount,0) > 0
            and m.account_status in (1,10)
            group by mbr_no
            ) m
            on c.mbr_no = m.mbr_no
            left join
            (
            select mbr_no,sum(transaction_amt) as monthly_thirdparty
            from FMS.THIRDPARTY_LIST
            where mode <> 1 and status = 1
            group by mbr_no
            ) t
            on c.mbr_no = t.mbr_no
            left join
            (
            select mbr_no,sum(isnull(transaction_amt,0)) as monthly_payble
            from FMS.THIRDPARTY_LIST
            where mode = 1 and status = 1
            group by mbr_no
            ) v
        on c.mbr_no = v.mbr_no
        where c.mbr_no = '" . $this->customer->membership->mbr_no . "'
        and c.client_id= '" . $this->clientID . "'
        ");

        return view('livewire.cif.info.monthly-payment-summary', [
            'PaySummary' => $PaySummary
        ])->extends('layouts.main');
    }
}
