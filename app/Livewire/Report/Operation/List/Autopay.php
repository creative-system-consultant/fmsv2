<?php

namespace App\Livewire\Report\Operation\List;

use App\Action\StoredProcedure\SpFmsUpRptAutopayList;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Autopay extends Component
{
    public $clientId = 1;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    private function getDataFromSp()
    {
        $input = [
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ];

        return SpFmsUpRptAutopayList::handle($input);
    }

    public function generateExcel()
    {
        $this->validate();

        $data = $this->getDataFromSp();
        $filename = 'ListOfAutopay-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($data, $filename, $this->startDate);
    }

    public function render()
    {
        return view('livewire.report.operation.list.autopay')->extends('layouts.main');
    }
}
