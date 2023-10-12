<?php

namespace App\Livewire\Report\Operation\List;

use App\Action\StoredProcedure\SpFmsUpRptListFinancingTrxOnDisb;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;

class FinTrxBaseOnDisbursement extends Component
{
    public $clientId = 1;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    public function generateExcel()
    {
        $this->validate();

        $data = SpFmsUpRptListFinancingTrxOnDisb::handle([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);
        $filename = 'List Of Financing base on disbursement-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($data, $filename, $this->startDate);
    }

    public function render()
    {
        return view('livewire.report.operation.list.fin-trx-base-on-disbursement')->extends('layouts.main');
    }
}
