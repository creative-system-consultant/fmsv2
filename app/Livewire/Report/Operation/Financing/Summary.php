<?php

namespace App\Livewire\Report\Operation\Financing;

use App\Action\StoredProcedure\SpFmsFinancingSummary;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Summary extends Component
{
    public $clientId = 1;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    public function generateExcel()
    {
        $this->validate();

        $data = SpFmsFinancingSummary::handle([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);

        $filename = 'FinancingSummary-%s.xlsx';
        $report = new ReportService(); 

        return $report->generateExcelReport($data, $filename, $this->startDate);
    }
    public function render()
    {
        return view('livewire.report.operation.financing.summary')->extends('layouts.main');
    }
}
