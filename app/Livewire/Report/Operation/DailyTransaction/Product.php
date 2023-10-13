<?php

namespace App\Livewire\Report\Operation\DailyTransaction;

use App\Action\StoredProcedure\SpFmsDailyTransactionProduct;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Product extends Component
{
    public $clientId = 1;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    public function generateExcel()
    {
        $this->validate();

        $data = SpFmsDailyTransactionProduct::handle([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);

        $filename = 'DailyTrxByProduct-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($data, $filename, $this->startDate);
    }

    public function render()
    {
        return view('livewire.report.operation.dailytransaction.product')->extends('layouts.main');
    }
}
