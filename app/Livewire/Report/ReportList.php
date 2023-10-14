<?php

namespace App\Livewire\Report;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ReportList extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.report.report-list');
    }
}
