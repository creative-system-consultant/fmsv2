<?php

namespace App\Traits;

trait EarlySettlementPaymentTrait
{
    public function getEarlySettlementPayment()
    {
        if ($this->selectedType == 'cheque') {
            return [
                'chequeDate' => 'required|before_or_equal:today',
                'bankMember' => 'required',
                'txnDate' => 'required|before_or_equal:today'
            ];
        } elseif ($this->selectedType == 'cash/cdm') {
            return [
                'txnDate' => 'required|before_or_equal:today'
            ];
        } else {
            return [
                'docNo' => 'required',
                'txnDate' => 'required|before_or_equal:today'
            ];
        }
    }
}