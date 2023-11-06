<?php

namespace App\Livewire\Report\Operation\List;

use App\Action\StoredProcedure\SpFmsUpRptListFinancingTrxOnDisb;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class FinTrxBaseOnDisbursement extends Component
{   
    use Actions, WithPagination;

    public $clientId;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
    }

    protected function getRawData()
    {
        return SpFmsUpRptListFinancingTrxOnDisb::getRawData([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ], true);
    }

    public function generateExcel()
    {
        $this->validate();

        $rawData = $this->getRawData();

        if(count($rawData) > 0) {
            $formattedData = [];
            foreach ($rawData as $data) {
                $formattedData[] = SpFmsUpRptListFinancingTrxOnDisb::formatDataForExcel($data);
            }
            return $this->handleExcel($formattedData);
        } else {
            $this->dialog()->success('Process Complete!', 'No Data Found.');
        }
    }

    private function handleDataTable($rawData)
    {
        $data = SpFmsUpRptListFinancingTrxOnDisb::handleForTable($rawData, true);

        return ReportService::paginateData($data);
    }

    private function handleExcel($rawData)
    {
        $dataGenerator = function () use ($rawData) {
            foreach ($rawData as $data) {
                yield $data;
            }
        };

        $filename = 'ListOfFinancingTrxOnDisb-%s.xlsx';
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

        return view('livewire.report.operation.list.fin-trx-base-on-disbursement', [
            'result' => $result
        ])->extends('layouts.main');
    }
}
