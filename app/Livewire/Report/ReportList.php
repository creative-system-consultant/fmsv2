<?php

namespace App\Livewire\Report;

use Livewire\Component;

class ReportList extends Component
{
    public function render()
    {
        return view('livewire.report.report-list')->extends('layouts.main');
    }
}
