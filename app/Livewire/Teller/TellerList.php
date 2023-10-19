<?php

namespace App\Livewire\Teller;

use Livewire\Component;

class TellerList extends Component
{
    public $type_payment_in = '';
    public $option_payment_in;

    public $type_payment_out = '';
    public $option_payment_out;

    public function mount()
    {
        $this->option_payment_in = [
            (object)[
                "value" => "Payment Contribution"
            ],
            (object)[
                "value" => "Purchase Share"
            ],
            (object)[
                "value" => "Financing Repayment"
            ],
            (object)[
                "value" => "Early Settlement Payment"
            ],
            (object)[
                "value" => "Third Party"
            ],
            (object)[
                "value" => "Miscellaneous in"
            ],
            (object)[
                "value" => "Autopay"
            ],
            (object)[
                "value" => "Early Settlement Overlap"
            ],
            (object)[
                "value" => "Bulk Payment"
            ],
        ];

        $this->option_payment_out = [
            (object)[
                "value" => 'Withdraw Contribution'
            ],
            (object)[
                "value" => "Withdraw Share"
            ],
            (object)[
                "value" => "Close Membership"
            ],
            (object)[
                "value" => "Payment to Members"
            ],
            (object)[
                "value" => "Dividend Withdrawal"
            ],
            (object)[
                "value" => "Disbursement"
            ],
            (object)[
                "value" => "Miscellaneous Out"
            ],
            (object)[
                "value" => "Refund Advance"
            ],
            (object)[
                "value" => "Dividen Batch Widthdrawal"
            ],
        ];
    }

    public function clearPaymentIn()
    {
        $this->type_payment_in = '';
    }

    public function clearPaymentOut()
    {
        $this->type_payment_out = '';
    }

    public function render()
    {
        return view('livewire.teller.teller-list')->extends('layouts.main');
    }
}
