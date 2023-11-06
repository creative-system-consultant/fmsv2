<?php

namespace App\Livewire\Report\Operation\List;

use App\Action\StoredProcedure\SpFmsUpRptListTakafulPayment;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class TakafulPayment extends Component
{
    use Actions, WithPagination;
    public $clientId;

    #[Rule('required')]
    public $reportDate;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
    }
    
    protected function getRawData()
    {
        return SpFmsUpRptListTakafulPayment::getRawData([
            'clientId' => $this->clientId,
            'reportDate' => $this->reportDate
        ], true);
    }

    public function generateExcel()
    {
        $this->validate();

        $rawData = $this->getRawData();

        if(count($rawData) > 0) {
            $formattedData = [];
            foreach ($rawData as $data) {
                $formattedData[] = SpFmsUpRptListTakafulPayment::formatDataForExcel($data);
            }
            return $this->handleExcel($formattedData);
        } else {
            $this->dialog()->success('Process Complete!', 'No Data Found.');
        }
    }

    private function handleDataTable($rawData)
    {
        $data = SpFmsUpRptListTakafulPayment::handleForTable($rawData, true);

        return ReportService::paginateData($data);
    }

    private function handleExcel($rawData)
    {
        $dataGenerator = function () use ($rawData) {
            foreach ($rawData as $data) {
                yield $data;
            }
        };

        $filename = 'ListOfTakafulPayment-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($dataGenerator, $filename, $this->reportDate);
    }

    public function render()
    {
        $result = null;

        if($this->reportDate) {
            $rawData = $this->getRawData();

            if(count($rawData) <= 1000) {
                $result = $this->handleDataTable($rawData);
            }
        }

        return view('livewire.report.operation.list.takaful-payment', [
            'result' => $result
        ])->extends('layouts.main');
    }
}