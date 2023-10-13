<?php

namespace App\Livewire\Report\Operation\DailyTransaction;

use App\Action\StoredProcedure\SpFmsDailyTransactionProduct;
use App\Services\General\ReportService;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;

    public $clientId = 1;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    public function generateExcel()
    {
        $this->validate();

        return $this->handleExcel();
    }

    private function handleDataTable()
    {
        $data = SpFmsDailyTransactionProduct::handleForTable([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ], true);

        return ReportService::paginateData($data);
    }

    private function handleExcel()
    {
        $data = iterator_to_array(SpFmsDailyTransactionProduct::handleForExcel([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ], true));

        $filename = 'DailyTrxByProduct-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($data, $filename, $this->startDate);
    }

    public function render()
    {
        $result = null;

        if ($this->startDate && $this->endDate) {
            $result = $this->handleDataTable();
        }

        return view('livewire.report.operation.dailytransaction.product', [
            'result' => $result
        ])->extends('layouts.main');
    }
}
