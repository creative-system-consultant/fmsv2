<?php

namespace App\Livewire\Report\Operation\Contribution;

use App\Action\StoredProcedure\SpFmsContributionWithdrawal;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Withdrawal extends Component
{ 
    public $clientId = 1;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    public function generateExcel()
    {
        $this->validate();

        $data = SpFmsContributionWithdrawal::handle([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);

        $filename = 'ContributionWithdrawal-%s.xlsx';
        $report = new ReportService(); 

        return $report->generateExcelReport($data, $filename, $this->startDate);
    }
    public function render()
    {
        return view('livewire.report.operation.contribution.withdrawal')->extends('layouts.main');
    }
}
