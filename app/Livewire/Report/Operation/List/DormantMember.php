<?php

namespace App\Livewire\Report\Operation\List;

use App\Action\StoredProcedure\SpFmsUpRptMembersDormant;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;

class DormantMember extends Component
{
    public $clientId = 1;

    #[Rule('required')]
    public $reportDate;

    public function generateExcel()
    {
        $this->validate();

        $data = SpFmsUpRptMembersDormant::handle([
            'clientId' => $this->clientId,
            'reportDate' => $this->reportDate
        ]);
        $filename = 'ListOfDormantMembers-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($data, $filename, $this->reportDate);
    }

    public function render()
    {
        return view('livewire.report.operation.list.dormant-member')->extends('layouts.main');
    }
}
