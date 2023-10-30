<?php

namespace App\Livewire\Report\Operation\GL;

use App\Action\StoredProcedure\SpFmsUpRptGlBankRecon;
use App\Models\Ref\RefBankIbt;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class GlBankRecon extends Component
{
    use Actions, WithPagination;

    public $clientId;

    #[Rule('required')]
    public $reportDate;

    #[Rule('required')]
    public $bank_koputra;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
    }

    protected function getRawData()
    {
        return SpFmsUpRptGlBankRecon::getRawData([
            'clientId' => $this->clientId,
            'reportDate' => $this->reportDate,
            'bank_koputra' => $this->bank_koputra,
        ], true);
    }

    public function generateExcel()
    {
        $this->validate();
        $rawData = $this->getRawData();

        if (count($rawData) > 0) {
            $formattedData = [];
            foreach ($rawData as $data) {
                $formattedData[] = SpFmsUpRptGlBankRecon::formatDataForExcel($data);
            }
            return $this->handleExcel($formattedData);
        } else {
            $this->dialog()->success('Process Complete!', 'No Data Found.');
        }
    }

    private function handleDataTable($rawData)
    {
        $data = SpFmsUpRptGlBankRecon::handleForTable($rawData, true);
        return ReportService::paginateData($data);
    }

    private function handleExcel($rawData)
    {
        $dataGenerator = function () use ($rawData) {
            foreach ($rawData as $data) {
                yield $data;
            }
        };

        $filename = 'GlBankRecon-%s.xlsx';
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

        $bank_koputra = RefBankIbt::all();

        return view('livewire.report.operation.g-l.gl-bank-recon', [
            'result' => $result,
            'bank_koputras' => $bank_koputra
        ])->extends('layouts.main');
    }
}