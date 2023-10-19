<?php

namespace App\Livewire\Report\Operation\Summary;

use App\Action\StoredProcedure\SpUpRptSummaryTotalshare;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;


class sumtotalshare extends Component
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
        $data = SpUpRptSummaryTotalshare::handleForTable([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ], true);

        return ReportService::paginateData($data);
    }

    private function handleExcel()
    {
        $dataGenerator = function () {
            $rawData = SpUpRptSummaryTotalshare::handleForExcel([
                'clientId' => $this->clientId,
                'startDate' => $this->startDate,
                'endDate' => $this->endDate,
            ], true);

            foreach ($rawData as $data) {
                yield $data;
            }
        };

        $filename = 'SummaryTotalShare-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($dataGenerator, $filename, $this->startDate);
    }

    public function render()
    {
        $result = null;
        $rawData = $this->getRawData();

        if($this->startDate && $this->endDate && count($rawData) <= 1000){
            $result = $this->handleDataTable($rawData);

        }

        return view('livewire.report.operation.summary.sumtotalshare', [
            'result' => $result
        ])->extends('layouts.main');
    }
}