<?php

namespace App\Traits;

trait DividendWithdrawalRulesTrait
{
    public function getDividendWithdrawalRules()
    {
        return [
            'bankClient' => 'required',
            'txnAmt' => 'required|lte:balDividen|numeric',
            'txnDate' => 'required|before_or_equal:today',
        ];
    }
}