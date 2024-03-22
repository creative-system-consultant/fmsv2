<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Ref\RefBank;
use App\Models\User;
use App\Models\Fms\FmsMembership;
use App\Models\Fms\FmsShareReqHistory;
use App\Models\Siskop\SiskopApplyDividend;
use App\Models\Siskop\SiskopContribution;
use App\Models\Siskop\SiskopTransferShare;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Home extends Component
{
    use WithPagination;
    use Actions;

    public $selectClientModal = false;
    public $currentIndex = 1;

    public $chartId;
    public $athlete;
    public $years;
    public $distances;
    public $total;
    public $summary_status;

    #[Rule('required')]
    public $client;

    public function mount()
    {
        if (session('just_logged_in') && auth()->user()->clients->count() > 1) {
            $this->selectClientModal = true;
            session()->forget('just_logged_in');
        } else {
            $this->selectClientModal = false;
        }
    }

    public function saveClient()
    {
        $this->validate();

        User::whereId(auth()->id())->update(['client_id' => $this->client]);
        $this->selectClientModal = false;

        // dispatch an event
        $this->dispatch('clientUpdated');
        return $this->redirect(Home::class);
    }

    public function changeIndex($newIndex)
    {
        $this->currentIndex = $newIndex;
    }

    // public function currentdate()
    // {
    //     $currentDate = Carbon::now()->toDateString();
    //     return  $currentDate;
    // }

    public function render()
    {
        $clientType = User::where('client_id', auth()->user()->client_id)
            ->where('user_type', 2)
            ->first();

        $disb =  DB::table('FMS.ACCOUNT_MASTERS AS A')
                    ->join('FMS.ACCOUNT_POSITIONS AS B', 'A.account_no', '=', 'B.account_no')
                    ->join('FMS.MEMBERSHIP AS C', 'A.mbr_no', '=', 'C.mbr_no')
                    ->join('CIF.CUSTOMERS AS D', 'C.cif_id', '=', 'D.ID')
                    ->select(
                        'C.mbr_no',
                        'D.name',
                        'A.ACCOUNT_NO',
                        'B.disbursed_amount',
                        'B.prin_outstanding',
                        'B.uei_outstanding'
                    )
                    ->whereNotNull('A.pre_disbursement_flag')
                    ->where('C.status_id', '=', 1)
                    ->where('A.account_status', '=', 1)
                    ->where('B.client_id', '=', auth()->user()->client_id)
                    ->where('C.client_id', '=', auth()->user()->client_id)
                    // ->where('D.client_id', '=', auth()->user()->client_id)
                    ->paginate(3);

        $preDisb  =  DB::table('FMS.ACCOUNT_MASTERS AS A')
                        ->join('FMS.ACCOUNT_POSITIONS AS B', 'A.account_no', '=', 'B.account_no')
                        ->join('FMS.MEMBERSHIP AS C', 'A.mbr_no', '=', 'C.mbr_no')
                        ->join('CIF.CUSTOMERS AS D', 'C.cif_id', '=', 'D.ID')
                        ->select(
                            'C.mbr_no',
                            'D.name',
                            'A.ACCOUNT_NO',
                            'B.disbursed_amount',
                            'B.prin_outstanding',
                            'B.uei_outstanding'
                        )
                        ->whereNull('A.pre_disbursement_flag')
                        ->where('C.status_id', '=', 1)
                        ->where('A.account_status', '=', 1)
                        ->where('B.client_id', '=', auth()->user()->client_id)
                        ->where('C.client_id', '=', auth()->user()->client_id)
                        // ->where('D.client_id', '=', auth()->user()->client_id)
                        ->paginate(3);

        $activeMember = FmsMembership::where('client_id' , auth()->user()->client_id)->where('status_id' , 1)->paginate(3);
        $closeMember  = FmsMembership::where('client_id' , auth()->user()->client_id)->where('status_id' , 4)->paginate(3);

        // graph pie chart 
        $withdrawShareCount = DB::table('FMS.SHARES_REQ_HISTORY AS A')
            ->join('CIF.CUSTOMERS AS B', 'A.cif_id', '=', 'B.id')
            ->select(
                'A.mbr_no',
                'B.name',
                'A.apply_amt',
                'A.approved_amt',
            )
            ->whereIn('A.req_status', array(4, 5, 6, 7))
            ->where('A.direction', '=', 'sell')
            ->where('A.client_id', '=', auth()->user()->client_id)
            ->where('B.client_id', '=', auth()->user()->client_id)
            ->count();

        $withdrawContributionCount = DB::table('FMS.CONTRIBUTION_REQ_HISTORY AS A')
            ->join('CIF.CUSTOMERS AS B', 'A.cif_id', '=', 'B.id')
            ->select(
                'A.mbr_no',
                'B.name',
                'A.apply_amt',
                'A.approved_amt',
            )
            ->whereIn('A.req_status', array(4, 5, 6, 7))
            ->where('A.client_id', '=', auth()->user()->client_id)
            ->where('B.client_id', '=', auth()->user()->client_id)
            ->count();

        $dividendWithdrawalCount = DB::table('FMS.DIVIDEND_REQ AS A')
            ->join('CIF.CUSTOMERS AS B', 'A.cif_id', '=', 'B.id')
            ->select(
                'A.mbr_no',
                'B.name',
                'A.dividend_total',
                'A.div_cash_approved',
            )
            ->whereIn('A.req_status', array(4, 5, 6, 7))
            ->where('A.client_id', '=', auth()->user()->client_id)
            ->where('B.client_id', '=', auth()->user()->client_id)
            ->count();

        //tab_dividen_req
        $dividen_req = DB::table('FMS.DIVIDEND_REQ AS A')
            ->join('CIF.CUSTOMERS AS B', 'A.cif_id', '=', 'B.id')
            ->select(
                'A.mbr_no',
                'B.name',
                'A.dividend_total',
                'A.div_cash_approved',
            )
            ->whereIn('A.req_status', array(4, 5, 6, 7))
            ->where('A.client_id', '=', auth()->user()->client_id)
            ->where('B.client_id', '=', auth()->user()->client_id)
            // ->whereRaw('CAST(A.updated_at AS DATE) = ?', [Carbon::today()->toDateString()])
            ->paginate(3);
        
        //tab_share_req
        $share_req = DB::table('FMS.SHARES_REQ_HISTORY AS A')
            ->join('CIF.CUSTOMERS AS B', 'A.cif_id', '=', 'B.id')
            ->join('FMS.MEMBERSHIP AS C', 'A.mbr_no', '=', 'C.mbr_no')
            ->select(
                'A.mbr_no',
                'B.name',
                'C.total_share',
                'A.approved_amt',
            )
            ->whereIn('A.req_status', array(4, 5, 6, 7))
            ->where('A.direction', '=', 'sell')
            ->where('A.client_id', '=', auth()->user()->client_id)
            ->where('B.client_id', '=', auth()->user()->client_id)
            ->where('C.client_id', '=', auth()->user()->client_id)
            // ->whereRaw('CAST(A.updated_at AS DATE) = ?', [Carbon::today()->toDateString()])
            ->paginate(3);

        
        //tab_contribution_req
        $contribution_req = DB::table('FMS.CONTRIBUTION_REQ_HISTORY AS A')
            ->join('CIF.CUSTOMERS AS B', 'A.cif_id', '=', 'B.id')
            ->join('FMS.MEMBERSHIP AS C', 'A.mbr_no', '=', 'C.mbr_no')
            ->select(
                'A.mbr_no',
                'B.name',
                'C.total_contribution',
                'A.approved_amt',
            )
            ->whereIn('A.req_status', array(4, 5, 6, 7))
            ->where('A.client_id', '=', auth()->user()->client_id)
            ->where('B.client_id', '=', auth()->user()->client_id)
            ->where('C.client_id', '=', auth()->user()->client_id)
            // ->whereRaw('CAST(A.updated_at AS DATE) = ?', [Carbon::today()->toDateString()])
            ->paginate(3);

        //graph barchart contribution 
        $summary_status = DB ::select ("
                            SELECT CAST(updated_at AS DATE) AS contribution_date,
                            COUNT(*) AS total_rows
                            FROM FMS.CONTRIBUTION_REQ_HISTORY
                            WHERE client_id = ".auth()->user()->client_id."
                            AND CAST(updated_at AS DATE) >= DATEADD(MONTH, -1, GETDATE())
                            GROUP BY CAST(updated_at AS DATE)
        ");        
        $summary_status = json_encode($summary_status);

        // //graph barchart dividen 
        $summ_share = DB ::select ("
                            SELECT CAST(updated_at AS DATE) AS share_date,
                            COUNT(*) AS total_rows
                            FROM FMS.SHARES_REQ_HISTORY
                            WHERE client_id = ".auth()->user()->client_id."
                            AND CAST(updated_at AS DATE) >= DATEADD(MONTH, -1, GETDATE())
                            GROUP BY CAST(updated_at AS DATE)
        ");        
        $summ_share = json_encode($summ_share);
        
        // //graph barchart dividen 
        $summ_div = DB ::select ("
                            SELECT CAST(approved_date AS DATE) AS div_date,
                            COUNT(*) AS total_rows
                            FROM FMS.DIVIDEND_REQ
                            WHERE client_id = ".auth()->user()->client_id."
                            AND CAST(approved_date AS DATE) >= DATEADD(MONTH, -1, GETDATE())
                            GROUP BY CAST(approved_date AS DATE)
        ");        
        $summ_div = json_encode($summ_div);


        $currentDate = Carbon::now()->format('d-m');

        return view('livewire.home.home', [
            'activeMember' => $activeMember,
            'closeMember' => $closeMember,
            'disb' => $disb,
            'preDisb' => $preDisb,
            'clients' => auth()->user()->clients,
            'clientType' => $clientType->roles->first()->name,

            //dashboard chart
            'withdrawContributionCount' => $withdrawContributionCount,
            'withdrawShareCount' => $withdrawShareCount,
            'dividendWithdrawalCount' => $dividendWithdrawalCount,
            'dividen_req' => $dividen_req,
            'share_req' => $share_req,
            'contribution_req'=> $contribution_req,
            'barchartcont' => $summary_status,
            'barchartshare' => $summ_share,
            'barchartdiv' => $summ_div,
            'currentDate' => $currentDate,
        
        ])->extends('layouts.main');
    }
}
