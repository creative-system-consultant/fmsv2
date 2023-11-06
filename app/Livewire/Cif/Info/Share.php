<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use DB;
use Livewire\Component;

class Share extends Component
{
    public $customer, $uuid, $startDateShare, $endDateShare;

    public $totalShare, $lastPurchaseAmt, $lastPurchaseDate, $monthly, $lastSellAmt, $lastSellDate;

    public function mount()
    {
        $this->startDateShare    =  '2021-12-31';
        $this->endDateShare      =  now()->format('Y-m-d');
        $this->customer = CifCustomer::where('uuid', $this->uuid)->first();
        $membershipInfo = $this->customer->membership;

        $this->totalShare = number_format($membershipInfo->total_share, 2);
        $this->lastPurchaseAmt = number_format($membershipInfo->last_purchase_amount, 2);
        $this->lastPurchaseDate = date('d/m/Y', strtotime($membershipInfo->last_purchase_date));
        $this->monthly = number_format($membershipInfo->monthly_share, 2);
        $this->lastSellAmt = number_format($membershipInfo->last_selling_amount, 2);
        $this->lastSellDate = date('d/m/Y', strtotime($membershipInfo->last_selling_date));
    }
    public function render()
    {
        $shares = DB::table('FMS.MEMBERSHIP_STATEMENTS')
            ->select(
                'FMS.MEMBERSHIP_STATEMENTS.id',
                'FMS.MEMBERSHIP_STATEMENTS.transaction_date',
                'FMS.MEMBERSHIP_STATEMENTS.remarks',
                'FMS.MEMBERSHIP_STATEMENTS.transaction_code_id',
                'FMS.MEMBERSHIP_STATEMENTS.amount',
                'FMS.MEMBERSHIP_STATEMENTS.total_amount',
                DB::raw('created_by = 1'),
                'FMS.MEMBERSHIP_STATEMENTS.created_at',
                'REF.TRANSACTION_CODES.description',
                'REF.TRANSACTION_CODES.reverse_trx_id',
                'REF.TRANSACTION_CODES.trx_group',
                'REF.TRANSACTION_CODES.dr_cr',
                'REF.TRANSACTION_CODES.id AS id2',
                'FMS.MEMBERSHIP_STATEMENTS.doc_no'
            )
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.MEMBERSHIP_STATEMENTS.transaction_code_id')
            ->where('FMS.MEMBERSHIP_STATEMENTS.mbr_no', '=', $this->customer->membership->mbr_no)
            // ->where('FMS.MEMBERSHIP_STATEMENTS.id', '=', $this->customer->id)
            ->whereIn('REF.TRANSACTION_CODES.trx_group', array('SHARES', 'SHARES - Balance C/F', 'SHARES (REVERSAL)'))
            ->whereBetween(DB::raw('cast(FMS.MEMBERSHIP_STATEMENTS.transaction_date as date)'), [$this->startDateShare, $this->endDateShare])
            ->orderBy('FMS.MEMBERSHIP_STATEMENTS.id', 'asc')
            ->paginate(10);


        return view('livewire.cif.info.share', [
            'shares' => $shares,
        ]);
    }
}
