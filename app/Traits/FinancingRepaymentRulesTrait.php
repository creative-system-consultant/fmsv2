<?php

namespace App\Traits;

trait FinancingRepaymentRulesTrait
{
    public function getFinancingRepayment()
    {
        if ($this->selectedType == 'cheque') {
            return [
                'chequeDate' => 'required|before_or_equal:today',
                'bankMember' => 'required',
                'txnAmt' => 'required|numeric',
                'txnDate' => 'required|before_or_equal:today'
            ];
        } elseif ($this->selectedType == 'cash/cdm') {
            return [
                'txnAmt' => 'required|numeric',
                'txnDate' => 'required|before_or_equal:today'
            ];
        } elseif ($this->selectedType == 'ibt/si') {
            return [
                'bankClient' => 'required',
                'docNo' => 'required',
                'txnAmt' => 'required|numeric',
                'txnDate' => 'required|before_or_equal:today'
            ];
        } else {
            return [
                'docNo' => 'required',
                'accNo' => 'required',
                'txnAmt' => 'required|numeric|lte:totalContribution',
                'txnDate' => 'required|before_or_equal:today'
            ];
        }
    }
}