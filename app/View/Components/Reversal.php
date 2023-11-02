<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Reversal extends Component
{
    public $title;
    public $dataTable;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $dataTable = null)
    {
        $this->title = $title;
        $this->dataTable = $dataTable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reversal');
    }
}
