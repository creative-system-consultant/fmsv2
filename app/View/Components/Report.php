<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Report extends Component
{
    public $title;
    public $startDate;
    public $endDate;
    public $reportDate;
    public $result;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $startDate = false, $endDate = false, $reportDate = false, $result = null)
    {
        $this->title = $title;
        $this->startDate = (bool) $startDate;
        $this->endDate = (bool) $endDate;
        $this->reportDate = (bool) $reportDate;
        $this->result = $result;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report');
    }
}
