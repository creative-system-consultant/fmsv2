<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Cif\CustomerStatement;
use App\Models\Fms\ChangeMonthlyContribution;
use DB;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

use Livewire\Component;

class Contribution extends Component
{

    use WithPagination;
    public $customer, $uuid, $changedMonthlyCon, $contributions_out;
    public $startDateContribution, $endDateContribution;
    public $startDateContributionOut, $endDateContributionOut;
    public $ChangedMonthlyCon, $clientID;
    public $totalContribution, $lastPaymentAmt, $monthlyContribution, $lastWithdrawAmt, $lastWithdrawDate, $numWithdraw, $totalWithdraw, $contributions;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->first();
        $membershipInfo = $this->customer->membership;

        $this->totalContribution = number_format($membershipInfo->total_contribution, 2);
        $this->lastPaymentAmt = number_format($membershipInfo->last_payment_amount, 2);
        $this->monthlyContribution = number_format($membershipInfo->monthly_contribution, 2);
        $this->lastWithdrawAmt = number_format($membershipInfo->last_withdraw_amount, 2);
        $this->lastWithdrawDate = date('d/m/Y', strtotime($membershipInfo->last_withdraw_date));
        $this->numWithdraw = number_format($membershipInfo->no_of_withdrawal, 2);
        $this->totalWithdraw = number_format($membershipInfo->total_withdraw_amount, 2);

        $this->ChangedMonthlyCon        = ChangeMonthlyContribution::where('mbrID', '=', $membershipInfo->mbr_no)->first();

        $this->startDateContribution    =  '2021-12-31';
        $this->endDateContribution      =  now()->format('Y-m-d');

        $this->startDateContributionOut = '2021-12-31';
        $this->endDateContributionOut   =  now()->format('Y-m-d');

        $this->changedMonthlyCon =  ChangeMonthlyContribution::where('mbrID', $this->customer->membership->mbr_no)->get();


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
            ->whereIn('REF.TRANSACTION_CODES.trx_group', array('CONTRIBUTION', 'CONTRIBUTION - Balance C/F', 'CONTRIBUTION (REVERSAL)'))
            ->whereBetween(DB::raw('cast(FMS.MEMBERSHIP_STATEMENTS.transaction_date as date)'), [$this->startDateContribution, $this->endDateContribution])
            ->orderBy('FMS.MEMBERSHIP_STATEMENTS.id', 'asc')
            ->get();

        $this->contributions_out = CustomerStatement::where('mbr_no', $this->customer->membership->mbr_no)
            ->where('transaction_code_id', 'like', '4%')
            ->whereIn('transaction_code_id', array('4101', '4102', '4103', '4104', '4105'))
            ->whereBetween(DB::raw('cast(FMS.MEMBERSHIP_STATEMENTS.transaction_date as date)'), [$this->startDateContribution, $this->endDateContribution])
            ->orderBy('id', 'asc')->get();
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


        return view('livewire.cif.info.contribution', [
            'changedMonthlyCon' => $this->changedMonthlyCon,
            'contributions' => $this->contributions,
        ])->extends('layouts.main');
    }
}
