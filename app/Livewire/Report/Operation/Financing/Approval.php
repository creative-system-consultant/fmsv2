<?php

namespace App\Livewire\Report\Operation\Financing;

use App\Action\StoredProcedure\SpFmsFinancingApproval;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Approval extends Component
{
    public $clientId = 1;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    public function generateExcel()
    {
        $this->validate();

        $data = SpFmsFinancingApproval::handle([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);

        $filename = 'DailyTransaction-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($data, $filename, $this->startDate);
    }
    public function render()
    {
        return view('livewire.report.operation.financing.approval')->extends('layouts.main');
    }
}
