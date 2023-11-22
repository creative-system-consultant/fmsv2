<?php

namespace App\Livewire\Finance\Category\Info;

use App\Models\Fms\FmsAccountMaster;
use Livewire\Component;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class RepaymentSchedule extends Component
{
    public $uuid;
    public $clientID, $account;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
        $this->account = FmsAccountMaster::where('uuid', '=', $this->uuid)
            ->where('client_id', $this->clientID)
            ->first();
    }

    public function renderReportList()
    {
        $stmt = $this->account->repayment_schedule($this->clientID)
            ->orderBy('instalment_no')
            ->get();
        foreach ($stmt as $item) {
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
                        'INSTALMENT NO'         => $item->instalment_no,
                        'AMOUNT'                => $item->instal_amt,
                        'DATE'                  => date('d/m/Y', strtotime($item->instal_date)),
                        'BALANCE OUTS'          => $item->bal_outstanding,
                        'PRINCIPAL'             => $item->print_amt,
                        'PRINCIPAL OUTS'        => $item->prin_outstanding,
                        'PROFIT'                => $item->profit_amt,
                        'UEI OUTS'              => $item->uei_outstanding,
                    ];
                });
        }, sprintf('Repayment-Schedules-%s.xlsx', now()->format('Y-m-d')));
    }



    public function render()
    {


        return view('livewire.finance.category.info.repayment-schedule', [
            'schedules' => $this->account->repayment_schedule($this->clientID)
                ->orderBy('instalment_no')
                ->get()
        ]);
    }
}
