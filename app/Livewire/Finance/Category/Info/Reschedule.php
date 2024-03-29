<?php

namespace App\Livewire\Finance\Category\Info;

use App\Models\Fms\FmsAccountMaster;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DB;
use Hash;
use Livewire\Component;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;
use WireUi\Traits\Actions;


class Reschedule extends Component
{
    use Actions;

    public $uuid, $account, $account_no, $user_id, $password;
    public $financeInfo, $reschedule, $min_repayment, $min_dur;
    public $view_minamt_dur;
    public $newInstalAmt, $financeInfoNew, $newSPInstalAmt;
    public $processed, $bal_outs, $acc_status, $reschedule_flag, $rptDate;
    public $number_reschedule;
    public $search_no, $ctr;



    public function instalmentRes()
    {

        //validation instalment amount/durations
        $this->validate(
            [
                'newInstalAmt' => 'required|numeric',
            ],
            [
                'newInstalAmt.required' => 'New instalment amount is required!',
                'newInstalAmt.numeric' => 'New instalment amount must numeric!'
            ]
        );

        $errorMsg = 1;
        $datetime = now();
        $result = DB::select("EXEC FMS.up_cal_min_rechedamt '$this->account_no' ");
        $resultN = false;
        $client_id = auth()->user()->client_id;
        $this->min_repayment = $result[0]->min_amt;
        $this->min_dur = $result[0]->max_dur;



        if ($this->reschedule == 'ins' && ($this->newInstalAmt >= $this->min_repayment)) {


            $$resultN = up_insert_repay_sched_rescdule(
                $client_id,
                $this->account_no,
                $this->user_id,
                $this->newInstalAmt,
                $datetime,
            );

            $this->newSPInstalAmt = $this->newInstalAmt;
            $errorMsg = 0;
        } elseif ($this->reschedule == 'dur') {
            $durationReschedule = DB::table('FMS.ACCOUNT_POSITIONS')
                ->select(
                    DB::raw('new_install_amt2 = cast(FMS.ACCOUNT_POSITIONS.bal_outstanding / ( isnull(FMS.ACCOUNT_MASTERS.duration,0) - isnull(FMS.ACCOUNT_POSITIONS.instalment_no,0) - isnull(FMS.ACCOUNT_POSITIONS.month_arrears,0) + ' . $this->newInstalAmt . ') as numeric(16,2))'),
                    DB::raw('new_install_amt3 = cast(FMS.ACCOUNT_POSITIONS.bal_outstanding / ((60 - (year(getdate()) - year( CIF.CUSTOMERS.birth_date))) * 12) as numeric(16,2))'),
                    DB::raw('new_install_amt4 = cast(FMS.ACCOUNT_POSITIONS.bal_outstanding / ' . $this->newInstalAmt . ' as numeric(16,2)) ')
                )
                ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_POSITIONS.account_no', '=', 'FMS.ACCOUNT_MASTERS.account_no')
                ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'FMS.ACCOUNT_MASTERS.mbr_no')
                ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
                ->where('FMS.ACCOUNT_POSITIONS.account_no', $this->account_no)
                ->first();
            if ($durationReschedule->new_install_amt4 >= $this->min_repayment) {

                $resultN = up_insert_repay_sched_rescdule(
                    $client_id,
                    $this->account_no,
                    $this->user_id,
                    $durationReschedule->new_install_amt4,
                    $datetime,
                );

                $this->newSPInstalAmt = $durationReschedule->new_install_amt4;
                $errorMsg = 0;
            }
        }

        if ($errorMsg == 1) {
            if ($this->reschedule == 'ins') {
                // $this->dispatchBrowserEvent('swal', [
                //     'title' => 'Not Allowed!',
                //     'html'  => 'The instalment requested (RM' . $this->newInstalAmt . ') <br> must not be lowered than allowable amount (RM' . $this->min_repayment . ').',
                //     'icon'  => 'info',
                //     'showConfirmButton' => true,

                // ]);
            } elseif ($this->reschedule == 'dur') {
                // $this->dispatchBrowserEvent('swal', [
                //     'title' => 'Not Allowed!',
                //     'html'  => 'Duration requested are not allowed as expected minimum instalment does not meet the criteria.',
                //     'icon'  => 'info',
                //     'showConfirmButton' => true,

                // ]);
            }
        } elseif ($errorMsg == 0) {
            $this->dialog()->success('Success', 'The requested amount/duration is allowable.');

            $this->processed = 1;
            $this->financeInfoNew = DB::table('FMS.REPAYMENT_SCHEDULES_RESC')
                ->select([
                    'account_no',
                    'instalment_no',
                    'instal_date',
                    'instal_amt',
                    'bal_outstanding',
                    'print_amt',
                    'prin_outstanding',
                    'profit_amt',
                    'uei_outstanding',
                    'total_instal_amount',
                    'created_at',
                    'created_by',
                    'status'
                ])
                ->where('account_no', $this->account_no)
                ->get();
        }
    }

    public function confirmResched()
    {
        // $this->validate(['password' => ['required', function ($attribute, $value, $fail) {
        //     $user = User::where('id', auth()->user()->id)->first();
        //     if (!$user || !Hash::check($this->password, $user->password)) {
        //         $fail('Password is incorrect');
        //     }
        // }]]);
        $client_id = auth()->user()->client_id;

        $result2 = up_upd_reschedule(
            $client_id,
            $this->account_no,
            $this->user_id,
            $this->newSPInstalAmt
        );


        // $this->dispatchBrowserEvent('verify-password');
        // $this->dispatchBrowserEvent('swal', [
        //     'title' => 'Success!',
        //     'text'  => 'Financing has been rescheduled',
        //     'icon'  => 'success',
        //     'showConfirmButton' => false,
        //     'timer' => 1500,
        // ]);
        // $this->password = null;
        // return redirect()->to("/finance/list_account");
        // return redirect()->route('user.finance.account', ['uuid' => $this->uuid]);
        $this->dialog()->success('Success', 'Financing has been rescheduled');
    }

    public function renderReportList()
    {
        foreach (DB::select("
                            SELECT
                                instalment_no,instal_date,
                                instal_amt,bal_outstanding,
                                print_amt,prin_outstanding,
                                profit_amt,uei_outstanding,
                                total_instal_amount,account_no,
                                created_at,created_by,status
                            FROM FMS.REPAYMENT_SCHEDULES_RESC
                            WHERE account_no = '$this->account_no'
                            order by instalment_no asc
                            ")
            as $item) {
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
                        'No.' => $item->instalment_no,
                        'Instalment Date'         => date('d-m-Y', strtotime($item->instal_date)),
                        'Instalment Amount'       => number_format($item->instal_amt, 2),
                        'Balance Oustanding'      => number_format($item->bal_outstanding, 2),
                        'Principal Amount'        => number_format($item->print_amt, 2),
                        'Profit Amount'           => number_format($item->profit_amt, 2),
                        'UEI-Oustanding'          => number_format($item->uei_outstanding, 2)
                    ];
                });
        }, sprintf('Repayment-%s.xlsx', now()->format('Y-m-d')));
    }

    public function renderRescheHisReportList()
    {
        foreach (DB::select("select
                        Instalment_No = instalment_no,
                        Instal_Date = instal_date,
                        Instal_Amount = instal_amt,
                        Balanace_Outstanding = bal_outstanding,
                        Principal_Amount = print_amt,
                        Principal_Outstanding = prin_outstanding,
                        Profit_Amount = profit_amt,
                        Unearn_Income_Outstanding = uei_outstanding,
                        reschedule_no,
                        reschedule_date
                        from fms.REPAYMENT_SCHEDULES_HISTORY where  reschedule_date = (select  max(reschedule_date) from fms.REPAYMENT_SCHEDULES_HISTORY where account_no = '$this->account_no' )
                        and account_no =  '$this->account_no'
                        order by instalment_no,reschedule_date asc
                ")
            as $item) {
            yield $item;
        }
    }


    public function mount()
    {
        $this->processed = 0;
        $this->account = FmsAccountMaster::where('uuid', '=', $this->uuid)->first();
        $this->account_no = $this->account->account_no;
        $this->user_id = auth()->user()->id;
        $this->rptDate = now()->format('d/m/Y');

        //script to check bal outs > 0 and status <> 2
        $fin_info = DB::table('FMS.ACCOUNT_POSITIONS')
            ->select(DB::raw('FMS.ACCOUNT_MASTERS.reschedule_flag,FMS.ACCOUNT_POSITIONS.bal_outstanding,FMS.ACCOUNT_MASTERS.account_status'))
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_POSITIONS.account_no', '=', 'FMS.ACCOUNT_MASTERS.account_no')
            ->where('FMS.ACCOUNT_POSITIONS.account_no', $this->account_no)
            ->first();
        $this->bal_outs = $fin_info->bal_outstanding;
        $this->acc_status = $fin_info->account_status;
        $this->ctr = 0;
        $this->reschedule_flag =  $fin_info->reschedule_flag;
        // dd($this->reschedule_flag);
    }

    public function render()
    {

        // dump($this->ctr);
        // $this->ctr++;
        $this->financeInfo = DB::table('FMS.ACCOUNT_POSITIONS')
            ->select(DB::raw("FMS.ACCOUNT_MASTERS.reschedule_flag,FMS.ACCOUNT_POSITIONS.bal_outstanding, FMS.ACCOUNT_POSITIONS.prin_outstanding, FMS.ACCOUNT_POSITIONS.uei_outstanding, FMS.ACCOUNT_POSITIONS.month_arrears, FMS.ACCOUNT_POSITIONS.instalment_no, FMS.ACCOUNT_MASTERS.duration, FMS.ACCOUNT_MASTERS.instal_amount, balance_duration = isnull(FMS.ACCOUNT_MASTERS.duration,0) - isnull(FMS.ACCOUNT_POSITIONS.instalment_no,0) - isnull(FMS.ACCOUNT_POSITIONS.month_arrears,0),birth_date = format(birth_date,'dd-MM-yyyy')"))
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_POSITIONS.account_no', '=', 'FMS.ACCOUNT_MASTERS.account_no')
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'FMS.ACCOUNT_MASTERS.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->where('FMS.ACCOUNT_POSITIONS.account_no', $this->account_no)
            ->first();

        $this->view_minamt_dur = DB::select("EXEC FMS.up_cal_min_rechedamt '$this->account_no' ");

        //query show history rescheduled
        $search_no = '%' . $this->search_no . '%';
        $this->number_reschedule = DB::select("
                                              select distinct reschedule_no,reschedule_date,account_no
                                              from FMS.REPAYMENT_SCHEDULES_HISTORY 
                                              where account_no = '$this->account_no'
                                              and reschedule_no like '$search_no'
                                              union all
                                              select distinct reschedule_no = 0,reschedule_date = getdate(),account_no
                                              from FMS.REPAYMENT_SCHEDULES
                                              where account_no = '$this->account_no'
                                            ");

        if ($this->processed == 1) {
            $this->financeInfoNew = DB::table('FMS.REPAYMENT_SCHEDULES_RESC')
                ->select([
                    'account_no',
                    'instalment_no',
                    'instal_date',
                    'instal_amt',
                    'bal_outstanding',
                    'print_amt',
                    'prin_outstanding',
                    'profit_amt',
                    'uei_outstanding',
                    'total_instal_amount',
                    'created_at',
                    'created_by',
                    'status'
                ])
                ->where('account_no', $this->account_no)
                ->get();
        }


        return view('livewire.finance.category.info.reschedule');
    }
}
