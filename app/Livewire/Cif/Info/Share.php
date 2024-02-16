<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsMembershipStatement;
use Carbon\Carbon;
use DB;
use Livewire\Component;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class Share extends Component
{
    use WithPagination;

    public $customer, $uuid, $startDateShare, $endDateShare, $clientID;
    public $totalShare, $sharePaymentMethod, $totalPurchaseShare, $totalSellShare, $lastPurchaseAmt, $lastPurchaseDate, $monthly, $lastSellAmt, $numWithdraw, $lastSellDate;

    public function mount()
    {
        $this->startDateShare    =  '2021-12-31';
        $this->endDateShare      =  now()->format('Y-m-d');
        $this->clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $membershipInfo = $this->customer->membership;

        $this->totalShare = number_format($membershipInfo->total_share, 2);
        $this->sharePaymentMethod = number_format($membershipInfo->share_pmt_mode_flag);
        $this->totalPurchaseShare = number_format($membershipInfo->total_share_purchase_amt, 2);
        $this->totalSellShare = number_format($membershipInfo->total_share_selling_amt, 2);
        $this->numWithdraw = number_format($membershipInfo->no_of_shares_withdrawal);
        $this->lastPurchaseAmt = number_format($membershipInfo->last_purchase_amount, 2);
        $this->lastPurchaseDate = ($membershipInfo->last_purchase_date) ? Carbon::parse($membershipInfo->last_purchase_date)->format('d-m-Y') : 'dd-mm-yyyy';
        $this->monthly = number_format($membershipInfo->monthly_share, 2);
        $this->lastSellAmt = number_format($membershipInfo->last_selling_amount, 2);
        $this->lastSellDate = ($membershipInfo->last_selling_date) ? Carbon::parse($membershipInfo->last_selling_date)->format('d-m-Y') : 'dd-mm-yyyy';
    }

    public function renderReportList()
    {
        $shares = FmsMembershipStatement::with(['transactionCode' => function($query) {
            $query->select(['id', 'description', 'reverse_trx_id', 'trx_group', 'dr_cr']);
        }])
        ->select('FMS.MEMBERSHIP_STATEMENTS.*', DB::raw('1 AS created_by'))
        ->where('mbr_no', '=', $this->customer->membership->mbr_no)
        ->where('client_id', $this->clientID)
        ->whereIn('transaction_code_id', function($query) {
            $query->select('id')
                ->from('REF.TRANSACTION_CODES')
                ->where('client_id', $this->clientID)
                ->whereIn('trx_group', ['SHARES', 'SHARES - Balance C/F', 'SHARES (REVERSAL)']);
        })
        ->whereBetween(DB::raw('CAST(transaction_date AS DATE)'), [$this->startDateShare, $this->endDateShare])
        ->orderBy('id', 'asc')
        ->get();

        foreach ($shares as $item) {
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
                        'Doc No'                    => ($item->doc_no ? $item->doc_no : 'N/A'),
                        'Transaction Description'   => $item->description,
                        'Remark'                    => ($item->remarks ? $item->remarks : 'N/A'),
                        'Amount'                    => ($item->dr_cr == 'D' ? '-' : number_format($item->amount, 2)),
                        'Total Amount'              => number_format($item->total_amount, 2),
                        'Created By'                => ($item->created_by ? $item->created_by : 'N/A'),
                        'Created At'                => ($item->created_at ? date('d/m/Y/h:m:s', strtotime($item->created_at)) : 'N/A'),
                    ];
                });
        }, sprintf('Shares-%s.xlsx', now()->format('Y-m-d')));
    }

    public function render()
    {
        $shares = FmsMembershipStatement::with(['transactionCode' => function($query) {
            $query->select(['id', 'description', 'reverse_trx_id', 'trx_group', 'dr_cr']);
        }])
        ->select('FMS.MEMBERSHIP_STATEMENTS.*', DB::raw('1 AS created_by'))
        ->where('mbr_no', '=', $this->customer->membership->mbr_no)
        ->where('client_id', $this->clientID)
        ->whereIn('transaction_code_id', function($query) {
            $query->select('id')
                ->from('REF.TRANSACTION_CODES')
                ->where('client_id', $this->clientID)
                ->whereIn('trx_group', ['SHARES', 'SHARES - Balance C/F', 'SHARES (REVERSAL)']);
        })
        ->whereBetween(DB::raw('CAST(transaction_date AS DATE)'), [$this->startDateShare, $this->endDateShare])
        ->orderBy('id', 'asc')
        ->paginate(10);

        return view('livewire.cif.info.share', [
            'shares' => $shares
        ]);
    }
}
