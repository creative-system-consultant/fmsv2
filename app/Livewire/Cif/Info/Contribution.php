<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Cif\CustomerStatement;
use App\Models\Fms\ChangeMonthlyContribution;
use Carbon\Carbon;
use DB;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

use Livewire\Component;

class Contribution extends Component
{

    use WithPagination;
    public $customer, $uuid, $changedMonthlyCon;
    public $startDateContribution, $endDateContribution;
    public $ChangedMonthlyCon, $clientID;
    public $totalBalContribution, $totalAddContribution, $totalWithdrawContribution, $lastPaymentAmt, $lastWithdrawAmt, $lastPaymentDate, $monthlyContribution,  $lastWithdrawDate, $numWithdraw, $contributions;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $membershipInfo = $this->customer->membership;

        $this->totalBalContribution = number_format($membershipInfo->total_contribution, 2);
        $this->totalAddContribution = number_format($membershipInfo->total_cont_add_amt, 2);
        $this->totalWithdrawContribution = number_format($membershipInfo->total_cont_withdraw_amt, 2);
        $this->lastPaymentAmt = number_format($membershipInfo->last_cont_add_amt, 2);
        $this->lastPaymentDate = ($membershipInfo->last_cont_add_date) ? Carbon::parse($membershipInfo->last_cont_add_date)->format('d-m-Y') : 'dd-mm-yyyy';
        $this->monthlyContribution = number_format($membershipInfo->monthly_contribution, 2);
        $this->lastWithdrawDate = ($membershipInfo->last_cont_withdraw_date) ? Carbon::parse($membershipInfo->last_cont_withdraw_date)->format('d-m-Y') : 'dd-mm-yyyy';
        $this->lastWithdrawAmt = number_format($membershipInfo->last_cont_withdraw_amt, 2);
        $this->numWithdraw = number_format($membershipInfo->no_of_cont_withdrawal);
        $this->startDateContribution = '2021-12-31';
        $this->endDateContribution = now()->format('Y-m-d');
        $this->changedMonthlyCon = ChangeMonthlyContribution::where('mbr_no', $this->customer->membership->mbr_no)->get();
    }

    public function renderReportList()
    {
        foreach ($this->contributions as $item) {
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
                        'Date'                      => date('d/m/Y', strtotime($item->transaction_date)),
                        'Transaction Description'   => $item->description,
                        'Remark'                    => ($item->remarks ? $item->remarks : 'N/A'),
                        'Amount'                    => ($item->dr_cr == 'D' ? '-' : number_format($item->amount, 2)),
                        'Total Amount'              => number_format($item->total_amount, 2),
                        'Created By'                => ($item->created_by ? $item->created_by : 'N/A'),
                        'Created At'                => ($item->created_at ? date('d/m/Y/h:m:s', strtotime($item->created_at)) : 'N/A'),
                    ];
                });
        }, sprintf('Contributions-%s.xlsx', now()->format('Y-m-d')));
    }

    public function render()
    {
        $this->contributions = DB::table('FMS.MEMBERSHIP_STATEMENTS')
            ->select(
                'FMS.MEMBERSHIP_STATEMENTS.id',
                'FMS.MEMBERSHIP_STATEMENTS.transaction_date',
                'FMS.MEMBERSHIP_STATEMENTS.remarks',
                'FMS.MEMBERSHIP_STATEMENTS.transaction_code_id',
                'FMS.MEMBERSHIP_STATEMENTS.amount',
                'FMS.MEMBERSHIP_STATEMENTS.total_amount',
                DB::raw('created_by = FMS.uf_get_users_name(1,FMS.MEMBERSHIP_STATEMENTS.created_by)'),
                'FMS.MEMBERSHIP_STATEMENTS.created_at',
                'REF.TRANSACTION_CODES.description',
                'REF.TRANSACTION_CODES.reverse_trx_id',
                'REF.TRANSACTION_CODES.trx_group',
                'REF.TRANSACTION_CODES.dr_cr',
                'REF.TRANSACTION_CODES.id AS id2'
            )
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.MEMBERSHIP_STATEMENTS.transaction_code_id')
            ->where('FMS.MEMBERSHIP_STATEMENTS.mbr_no', '=', $this->customer->membership->mbr_no)
            ->where('FMS.MEMBERSHIP_STATEMENTS.client_id', $this->clientID)
            ->where('REF.TRANSACTION_CODES.client_id', $this->clientID)
            ->whereIn('REF.TRANSACTION_CODES.trx_group', array('CONTRIBUTION', 'CONTRIBUTION - Balance C/F', 'CONTRIBUTION (REVERSAL)'))
            ->whereBetween(DB::raw('cast(FMS.MEMBERSHIP_STATEMENTS.transaction_date as date)'), [$this->startDateContribution, $this->endDateContribution])
            ->orderBy('FMS.MEMBERSHIP_STATEMENTS.id', 'asc')
            ->get();

        return view('livewire.cif.info.contribution', [
            'changedMonthlyCon' => $this->changedMonthlyCon,
            'contributions' => $this->contributions,
        ])->extends('layouts.main');
    }
}
