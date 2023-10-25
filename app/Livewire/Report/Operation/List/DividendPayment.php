<?php

namespace App\Livewire\Report\Operation\List;

use App\Action\StoredProcedure\SpFmsRptListDividendPayment;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class DividendPayment extends Component
{   
    use Actions, WithPagination;
    public $clientId;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    #[Rule('required')]
    public $flag;

    #[Rule('required')]
    public $batchNo;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
    }

    protected function getRawData()
    {
        return SpFmsRptListDividendPayment::getRawData([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'flag'  => $this->flag,
            'batchNo'   => $this->batchNo,
        ], true);
    }

    public function generateExcel()
    {
        $this->validate();
        $rawData = $this->getRawData();

        if(count($rawData) > 0) {
            $formattedData = [];
            foreach ($rawData as $data) {
                $formattedData[] = SpFmsRptListDividendPayment::formatDataForExcel($data);
            }
            return $this->handleExcel($formattedData);
        } else {
            $this->dialog()->success('Process Complete!', 'No Data Found.');
        }
    }

    private function handleDataTable($rawData)
    {
        $data = SpFmsRptListDividendPayment::handleForTable($rawData, true);
        return ReportService::paginateData($data);
    }

    private function handleExcel($rawData)
    {
        $dataGenerator = function () use ($rawData) {
            foreach ($rawData as $data) {
                yield $data;
            }
        };

        $filename = 'ListOfDividendPayment-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($dataGenerator, $filename, $this->startDate);
    }

    public function render()
    {
        $result = null;

        if($this->startDate && $this->endDate) {
            $rawData = $this->getRawData();

            if(count($rawData) <= 1000) {
                $result = $this->handleDataTable($rawData);
            }
        }

        return view('livewire.report.operation.list.dividend-payment', [
            'result' => $result,
            'flag'  => $flag,
            'batchNo' => $batchNo
        ])->extends('layouts.main');
    }
}