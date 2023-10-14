<?php

namespace App\Livewire\Report;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ReportList extends Component
{
    public function render()
    {
        return view('livewire.report.report-list')->extends('layouts.main');
    }
}
