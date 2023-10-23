<?php

namespace App\Traits;

trait MiscellaneousOutRulesTrait
{
    public function getMiscellaneousOutRules()
    {
        if ($this->selectedType == 'contribution') {
            return [
                'txnAmt' => 'required|numeric|lte:miscAmt',
                'txnDate' => 'required|before_or_equal:today'
            ];
        } elseif ($this->selectedType == 'members') {
            return [
                'bankMember' => 'required',
                'bankClient' => 'required',
                'docNo' => 'required',
                'txnAmt' => 'required|numeric|lte:miscAmt',
                'txnDate' => 'required|before_or_equal:today'
            ];
        } elseif ($this->selectedType == 'financing') {
            return [
                'txnAmt' => 'required|numeric|lte:miscAmt|gte:instalAmt',
                'txnDate' => 'required|before_or_equal:today'
            ];
        } else {
            return [
                    'txnAmt' => 'required|numeric|lte:miscAmt',
                    'txnDate' => 'required|before_or_equal:today'
                ];
        }
    }
}