<?php

namespace App\Livewire\Report\Operation\Contribution;

use App\Action\StoredProcedure\SpFmsContributionWithdrawal;
use App\Services\General\ReportService;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Withdrawal extends Component
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
        return SpFmsContributionWithdrawal::getRawData([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ], true);
    }

    public function generateExcel()
    {
        $this->validate();

        $rawData = $this->getRawData();

        if (count($rawData) > 0) {
            $formattedData = [];
            foreach ($rawData as $data) {
                $formattedData[] = SpFmsContributionWithdrawal::formatDataForExcel($data);
            }

            return $this->handleExcel($formattedData);
        } else {
            $this->dialog()->success('Process Complete!', 'No Data Found.');
        }
    }

    private function handleDataTable($rawData)
    {
        $data = SpFmsContributionWithdrawal::handleForTable($rawData, true);

        return ReportService::paginateData($data);
    }

    private function handleExcel($rawData)
    {
        $dataGenerator = function () use ($rawData) {
            foreach ($rawData as $data) {
                yield $data;
            }
        };

        $filename = 'ContributionWithdrawal-%s.xlsx';
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
        
        return view('livewire.report.operation.contribution.withdrawal', [
            'result' => $result
        ])->extends('layouts.main');
    }
}
