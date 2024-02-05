<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use DB;
use Livewire\Component;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class Share extends Component
{
    public $customer, $uuid, $startDateShare, $endDateShare, $clientID;

    public $totalShare, $lastPurchaseAmt, $lastPurchaseDate, $monthly, $lastSellAmt, $lastSellDate;
    public $shares;

    public function mount()
    {
        $this->startDateShare    =  '2021-12-31';
        $this->endDateShare      =  now()->format('Y-m-d');
        $this->clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $membershipInfo = $this->customer->membership;

        $this->totalShare = number_format($membershipInfo->total_share, 2);
        $this->lastPurchaseAmt = number_format($membershipInfo->last_purchase_amount, 2);
        $this->lastPurchaseDate = date('d/m/Y', strtotime($membershipInfo->last_purchase_date));
        $this->monthly = number_format($membershipInfo->monthly_share, 2);
        $this->lastSellAmt = number_format($membershipInfo->last_selling_amount, 2);
        $this->lastSellDate = date('d/m/Y', strtotime($membershipInfo->last_selling_date));
    }

    public function renderReportList()
    {
        foreach ($this->shares as $item) {
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
        $this->shares = DB::table('FMS.MEMBERSHIP_STATEMENTS')
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
            ->where('FMS.MEMBERSHIP_STATEMENTS.client_id', $this->clientID)
            ->where('REF.TRANSACTION_CODES.client_id', $this->clientID)
            ->whereIn('REF.TRANSACTION_CODES.trx_group', array('SHARES', 'SHARES - Balance C/F', 'SHARES (REVERSAL)'))
            ->whereBetween(DB::raw('cast(FMS.MEMBERSHIP_STATEMENTS.transaction_date as date)'), [$this->startDateShare, $this->endDateShare])
            ->orderBy('FMS.MEMBERSHIP_STATEMENTS.id', 'asc')
            ->get();

        return view('livewire.cif.info.share', [
            'shares' => $this->shares
        ]);
    }
}
