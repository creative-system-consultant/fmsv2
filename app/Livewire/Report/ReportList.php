<?php

namespace App\Livewire\Report;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ReportList extends Component
{
    public function render()
    {
        $reportsManagement = collect(config('module.report.management.index'))->groupBy('group');
        $reportsOperation = collect(config('module.report.operation.index'))->groupBy('group');

        return view('livewire.report.report-list',[
            'reportsManagement' => $reportsManagement,
            'reportsOperation' => $reportsOperation,
        ])->extends('layouts.main');
    }
}
