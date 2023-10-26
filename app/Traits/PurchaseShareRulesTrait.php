<?php

namespace App\Traits;

trait PurchaseShareRulesTrait
{
    public function getPurchaseShareRules()
    {
        if ($this->selectedType == 'cheque') {
            return [
                'chequeDate' => 'required|before_or_equal:today',
                'bankMember' => 'required',
                'txnAmt' => 'required|numeric|gte:minShare',
                'txnDate' => 'required|before_or_equal:today'
            ];
        } elseif ($this->selectedType == 'cash/cdm') {
            return [
                'txnAmt' => 'required|numeric|gte:minShare',
                'txnDate' => 'required|before_or_equal:today'
            ];
        } else {
            return [
                'bankMember' => 'required',
                'txnAmt' => 'required|numeric|gte:minShare',
                'txnDate' => 'required|before_or_equal:today'
            ];
        }
    }
}