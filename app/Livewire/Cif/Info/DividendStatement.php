<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsDividendStatement;
use DB;
use Livewire\Component;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class DividendStatement extends Component
{
    public $customer, $uuid, $clientId;
    public $startDateDividen, $endDateDividen, $clientID, $bal_div, $dividendstmt;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
        $this->startDateDividen    =  '2021-12-31';
        $this->endDateDividen       =  now()->format('Y-m-d');
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $this->bal_div = DB::table('fms.dividend_final')
            ->select('bal_dividen', DB::raw('bal_div_withdrawal = isnull(bal_div_withdrawal,0.00)'))
            ->where('mbr_no', $this->customer->membership->mbr_no)
            ->where('client_id', $this->clientID)
            ->first();
    }

    public function renderReportList()
    {

        foreach ($this->dividendstmt as $item) {
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
                        'MEMBERSHIP NO'                => $item->mbr_no,
                        'TRANSACTION DATE'             => date('d/m/Y', strtotime($item->txn_date)),
                        'TRANSACTION DESCRIPTION'      => $item->description,
                        'DOCUMENT NO'                  => $item->doc_no,
                        'AMOUNT'                       => $item->txn_amt,
                        'TOTAL AMOUNT'                 => $item->total_amt,
                        'REMARKS'                      => $item->remarks,
                    ];
                });
        }, sprintf('DividendStatement-%s.xlsx', now()->format('Y-m-d')));
    }

    public function render()
    {

        $this->dividendstmt = FmsDividendStatement::with('TxnCode')
            ->where('mbr_no', $this->customer->membership->mbr_no)
            ->whereBetween(DB::raw('cast(txn_date as date)'), [$this->startDateDividen, $this->endDateDividen])
            ->where('client_id', $this->clientID)
            ->orderby('id', 'asc')
            ->get();

        return view('livewire.cif.info.dividend-statement')->extends('layouts.main');
    }
}
