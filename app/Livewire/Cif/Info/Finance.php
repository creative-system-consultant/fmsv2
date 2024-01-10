<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\Membership;
use DB;
use Livewire\Component;

class Finance extends Component
{
    public $customer, $uuid, $accounts;
    public $selling_price = 0, $disbursed_amount = 0;

    public function mount()
    {
        $clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $clientID)->first();
        $MembershipInfo = Membership::where('cif_id', $this->customer->id)->first();
        $clientID = auth()->user()->client_id;

        $this->accounts = DB::table('FMS.ACCOUNT_MASTERS as a')
            ->select([
                'a.account_no',
                'c.description as status',
                'c.id as status_id',
                'a.approved_limit',
                'a.selling_price',
                'b.disbursed_amount',
                'a.customer_id',
                'a.uuid',
                'a.instal_amount',
                'a.start_disbursed_date',
                'b.bal_outstanding',
                DB::raw('(SELECT description FROM REF.PAYMENT_TYPE WHERE id = a.payment_type) AS payment_type'),
                DB::raw('ISNULL(b.advance_payment, 0.00) AS advance_payment'),
                DB::raw('FMS.uf_get_product(a.client_id, a.product_id) AS product')
            ])
            ->join('FMS.ACCOUNT_POSITIONS as b', 'a.account_no', '=', 'b.account_no')
            ->join('CIF.ACCOUNT_STATUSES as c', 'a.account_status', '=', 'c.id')
            ->whereNotNull('b.disbursed_amount')
            ->where('a.mbr_no', $MembershipInfo->mbr_no)
            ->where('b.client_id', $clientID)
            ->where('c.client_id', $clientID)
            ->where('a.client_id', $clientID)
            ->orderBy('a.account_status')
            ->orderBy('a.start_disbursed_date', 'desc')
            ->get();
        // $jointAccount = DB::table('FMS.joined_account')->select('mbr_no', 'main_mbr_no', 'account_no')->where('mbr_no', $this->customer->ref_no)->get();


        // foreach ($jointAccount as $item) {

        //     $accounts_add = DB::table('FMS.ACCOUNT_MASTERS as a')
        //         ->select([
        //             'a.account_no',
        //             'c.description as status',
        //             'c.id as status_id',
        //             'a.approved_limit',
        //             'a.selling_price',
        //             'b.disbursed_amount',
        //             'a.customer_id',
        //             'a.uuid',
        //             'a.instal_amount',
        //             'a.start_disbursed_date',
        //             'b.bal_outstanding',
        //             DB::raw('(SELECT description FROM ref_payment_type WHERE id = a.payment_type) AS payment_type'),
        //             DB::raw('ISNULL(b.advance_payment, 0.00) AS advance_payment'),
        //             DB::raw('FMS.uf_get_product(a.client_id, a.product_id) AS prod_name')
        //         ])
        //         ->join('FMS.ACCOUNT_POSITIONS as b', 'a.account_no', '=', 'b.account_no')
        //         ->join('CIF.ACCOUNT_STATUSES as c', 'a.account_status', '=', 'c.id')
        //         ->whereNotNull('b.disbursed_amount')
        //         ->where('a.account_no', $item->account_no)
        //         ->orderBy('a.account_status')
        //         ->orderBy('a.start_disbursed_date', 'desc')
        //         ->first();


        //     $this->accounts->push($accounts_add);
        // }
    }
    public function render()
    {
        return view('livewire.cif.info.finance');
    }
}
