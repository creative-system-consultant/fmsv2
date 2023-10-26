<?php

namespace App\Livewire\Reversal;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ReversalList extends Component
{
    public $type_financing = 'Disbursement';
    public $option_financing;

    public $type_general = '';
    public $option_general;

    public function mount()
    {
        $this->option_financing = [
            (object)[
                "value" => "Disbursement"
            ],
            (object)[
                "value" => "Financing Repayment"
            ],
            (object)[
                "value" => "Early Settlement"
            ],
        ];

        $this->option_general = [
            (object)[
                "value" => 'Share'
            ],
            (object)[
                "value" => 'Contribution'
            ],
            (object)[
                "value" => 'Other Payment'
            ],
            (object)[
                "value" => 'Miscellaneous'
            ],
            (object)[
                "value" => 'Third Party'
            ],
            (object)[
                "value" => 'Dividend'
            ],
            (object)[
                "value" => 'Refund Advance'
            ],
        ];
    }

    public function clearFinancing()
    {
        $this->type_financing = '';
    }

    public function clearGeneral()
    {
        $this->type_general = '';
    }
    
    public function render()
    {
        return view('livewire.reversal.reversal-list')->extends('layouts.main');
    }
}
