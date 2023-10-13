<?php

namespace App\Livewire\Report\Operation\Member;

use App\Action\StoredProcedure\SpFmsMemberIncome;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Byincome extends Component
{
    public $clientId = 1;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    public function generateExcel()
    {
        $this->validate();

        $data = SpFmsMemberIncome::handle([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);

        $filename = 'MemberByIncome-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($data, $filename, $this->startDate);
    }

    public function render()
    {
        return view('livewire.report.operation.member.byincome')->extends('layouts.main');
    }
}
