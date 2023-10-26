<?php

namespace App\Traits;

trait BulkPaymentRulesTrait
{
    public function getBulkPaymentRules()
    {
        if ($this->selectedType == 'cheque') {
            return [
                'chequeDate' => 'required|before_or_equal:today',
                'bankMember' => 'required',
                'txnAmt' => 'required|numeric',
                'txnDate' => 'required'
            ];
        } elseif ($this->selectedType == 'cash/cdm') {
            return [
                'txnAmt' => 'required|numeric',
                'txnDate' => 'required'
            ];
        } else {
            return [
                'bankMember' => 'required',
                'docNo' => 'required',
                'txnAmt' => 'required|numeric',
                'txnDate' => 'required'
            ];
        }
    }
}
